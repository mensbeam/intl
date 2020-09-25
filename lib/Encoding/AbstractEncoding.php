<?php
/** @license MIT
 * Copyright 2018 J. King et al.
 * See LICENSE and AUTHORS files for details */

declare(strict_types=1);
namespace MensBeam\Intl\Encoding;

abstract class AbstractEncoding implements Encoding {
    protected $string;
    protected $posByte = 0;
    protected $posChar = 0;
    protected $lenByte = null;
    protected $lenChar = null;
    protected $dirtyEOF = 0;
    protected $errMode = self::MODE_REPLACE;
    protected $allowSurrogates = false;
    protected $selfSynchronizing = false;

    public $posErr = 0;

    public function __construct(string $string, bool $fatal = false, bool $allowSurrogates = false) {
        $this->string = $string;
        $this->lenByte = strlen($string);
        $this->errMode = $fatal ? self::MODE_FATAL : self::MODE_REPLACE;
        $this->allowSurrogates = $allowSurrogates;
    }

    public function posByte(): int {
        return $this->posByte;
    }

    public function posChar(): int {
        return $this->posChar;
    }

    public function rewind() {
        $this->posByte = 0;
        $this->posChar = 0;
    }

    public function nextChar(): string {
        // get the byte at the current position
        $b = @$this->string[$this->posByte];
        if ($b === "") {
            // if the byte is end of input, simply return it
            return "";
        } elseif (ord($b) < 0x80) {
            // if the byte is an ASCII character, simply return it
            $this->posChar++;
            $this->posByte++;
            return $b;
        } else {
            // otherwise return the serialization of the code point at the current position
            return UTF8::encode($this->nextCode());
        }
    }

    public function seek(int $distance): int {
        if ($distance > 0) {
            if ($this->posByte == strlen($this->string)) {
                return $distance;
            }
            do {
                $p = $this->nextCode();
            } while (--$distance && $p !== false);
            return $distance;
        } elseif ($distance < 0) {
            $distance = abs($distance);
            if (!$this->posChar) {
                return $distance;
            }
            if ($this->dirtyEOF > 0) {
                // if we are at the end of the string and it did not terminate cleanly, go back the correct number of dirty bytes to seek through the last character
                $this->posByte -= $this->dirtyEOF;
                $this->dirtyEOF = 0;
                $distance--;
                $this->posChar--;
            }
            $mode = $this->errMode;
            $this->errMode = self::MODE_NULL;
            $out = $this->seekBack($distance);
            $this->errMode = $mode;
            return $out;
        } else {
            return 0;
        }
    }

    public function peekChar(int $num = 1): string {
        $out = "";
        $state = $this->stateSave();
        try {
            while ($num-- > 0 && ($b = $this->nextChar()) !== "") {
                $out .= $b;
            }
        } finally {
            $this->stateApply($state);
        }
        return $out;
    }

    public function peekCode(int $num = 1): array {
        $out = [];
        $state = $this->stateSave();
        try {
            while ($num-- > 0 && ($b = $this->nextCode()) !== false) {
                $out[] = $b;
            }
        } finally {
            $this->stateApply($state);
        }
        return $out;
    }

    public function lenByte(): int {
        return $this->lenByte;
    }

    public function lenChar(): int {
        return $this->lenChar ?? (function() {
            $state = $this->stateSave();
            while ($this->nextCode() !== false);
            $this->lenChar = $this->posChar;
            $this->stateApply($state);
            return $this->lenChar;
        })();
    }

    public function eof(): bool {
        return $this->posByte >= $this->lenByte;
    }

    public function chars(): \Generator {
        while (($c = $this->nextChar()) !== "") {
            yield ($this->posChar - 1) => $c;
        }
    }

    public function codes(): \Generator {
        while (($c = $this->nextCode()) !== false) {
            yield ($this->posChar - 1) => $c;
        }
    }

    /** Returns a copy of the decoder's state to keep in memory */
    protected function stateSave(): array {
        return [
            'posChar' => $this->posChar,
            'posByte' => $this->posByte,
            'posErr'  => $this->posErr,
        ];
    }

    /** Sets the decoder's state to the values specified */
    protected function stateApply(array $state) {
        foreach ($state as $key => $value) {
            $this->$key = $value;
        }
    }

    /** Handles decoding errors */
    protected function errDec(int $mode, int $charOffset, int $byteOffset) {
        assert(in_array($mode, [self::MODE_NULL, self::MODE_REPLACE, self::MODE_FATAL]), "Invalid error mode $mode");
        $this->posErr = $this->posChar;
        switch ($mode) {
            case self::MODE_NULL:
                // used internally during backward seeking for some encodings
                return null; // @codeCoverageIgnore
            case self::MODE_REPLACE:
                return 0xFFFD;
            case self::MODE_FATAL:
                throw new DecoderException("Invalid code sequence at character offset $charOffset (byte offset $byteOffset)", self::E_INVALID_BYTE);
        }
    }

    /** Handles encoding errors */
    protected static function errEnc(bool $htmlMode, $data = null) {
        if ($htmlMode) {
            return "&#".(string) $data.";";
        } else {
            // fatal replacement mode for encoders; not applicable to Unicode transformation formats
            throw new EncoderException("Code point $data not available in target encoding", self::E_UNAVAILABLE_CODE_POINT);
        }
    }
}