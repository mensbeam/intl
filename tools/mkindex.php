<?php
declare(strict_types=1);
// This script produces the index lookup tables
//  for a given encoding from the source data at WHATWG

$labels = [
    'big5'                => "big5",
    'euc-jp'              => "eucjp",
    'euc-kr'              => "euckr",
    'gb18030'             => "gb18030",
    'ibm866'              => "single_byte",
    'iso-2022-jp'         => "iso2022jp",
    'iso-8859-10'         => "single_byte",
    'iso-8859-13'         => "single_byte",
    'iso-8859-14'         => "single_byte",
    'iso-8859-15'         => "single_byte",
    'iso-8859-16'         => "single_byte",
    'iso-8859-2'          => "single_byte",
    'iso-8859-3'          => "single_byte",
    'iso-8859-4'          => "single_byte",
    'iso-8859-5'          => "single_byte",
    'iso-8859-6'          => "single_byte",
    'iso-8859-7'          => "single_byte",
    'iso-8859-8'          => "single_byte",
    'koi8-r'              => "single_byte",
    'koi8-u'              => "single_byte",
    'macintosh'           => "single_byte",
    'shift-jis'           => "shiftjis",
    'windows-1250'        => "single_byte",
    'windows-1251'        => "single_byte",
    'windows-1252'        => "single_byte",
    'windows-1253'        => "single_byte",
    'windows-1254'        => "single_byte",
    'windows-1255'        => "single_byte",
    'windows-1256'        => "single_byte",
    'windows-1257'        => "single_byte",
    'windows-1258'        => "single_byte",
    'windows-874'         => "single_byte",
    'x-mac-cyrillic'      => "single_byte",
];
$label = $argv[1] ?? "";
$label = trim(strtolower($label));
if (!isset($labels[$label])) {
    die("Invalid label specified. Must be one of: ".json_encode(array_keys($labels))."\n");
}
($labels[$label])($label);

// encoding-specific output generators

function single_byte(string $label) {
    $table = read_index($label, "https://encoding.spec.whatwg.org/index-$label.txt");
    $dec_char = serialize_char_array($table);
    $dec_code = serialize_point_array($table);
    $enc = serialize_single_byte_array($table);
    echo "const TABLE_DEC_CHAR = $dec_char;\n";
    echo "const TABLE_DEC_CODE = $dec_code;\n";
    echo "const TABLE_ENC      = $enc;\n";
}

function gb18030(string $label) {
    $gbk = read_index($label, "https://encoding.spec.whatwg.org/index-$label.txt");
    $dec_gbk = serialize_point_array($gbk);
    $enc_gbk = serialize_point_array(make_override_array($gbk));
    $ranges = read_index($label, "https://encoding.spec.whatwg.org/index-$label-ranges.txt");
    $dec_max = [];
    $dec_off = [];
    foreach ($ranges as $pointer => $code) {
        // gather the range starts in one array; they will actually be used as range ends
        $dec_max[] = $pointer;
        // gather the starting code points in another array
        $dec_off[] = $code;
    }
    // fudge the top of the ranges
    // see https://encoding.spec.whatwg.org/#index-gb18030-ranges-code-point Step 1
    // we also add 0x110000 (one beyond the top of the Unicode range) to the offsets for encoding
    $penult = array_pop($dec_max);
    $dec_max = array_merge($dec_max, [39420, $penult, 1237576]);
    array_splice($dec_off, -1, 0, "null");
    $dec_off[] = 0x110000;
    $dec_max = "[".implode(",", $dec_max)."]";
    $dec_off = "[".implode(",", $dec_off)."]";
    echo "const TABLE_CODES = $dec_gbk;\n";
    echo "const TABLE_POINTERS = $enc_gbk;\n";
    echo "const TABLE_RANGES = $dec_max;\n";
    echo "const TABLE_OFFSETS = $dec_off;\n";
}

function big5(string $label) {
    // Big5 has unusually complex encoding requirements
    // see https://encoding.spec.whatwg.org/#index-big5-pointer for particulars
    $table = read_index($label, "https://encoding.spec.whatwg.org/index-$label.txt");
    $specials = <<<ARRAY_LITERAL
[
    1133 => [0x00CA, 0x0304],
    1135 => [0x00CA, 0x030C],
    1164 => [0x00EA, 0x0304],
    1166 => [0x00EA, 0x030C],
]
ARRAY_LITERAL;
    // split Hong Kong Supplement code points from the rest of Big5
    $stop = (0xA1 - 0x81) * 157;
    $hk = [];
    $nhk = [];
    foreach ($table as $pointer => $code) {
        if ($pointer < $stop) {
            $hk[$pointer] = $code;
        } else {
            $nhk[$pointer] = $code;
        }
    }
    // search the Big5 rump for duplicates
    $dupes = make_override_array($nhk);
    // remove those duplicates which should use the last code point
    foreach ([0x2550, 0x255E, 0x2561, 0x256A, 0x5341, 0x5345] as $code) {
        unset($dupes[$code]);
    }
    // serialize and print; Hong Kong characters are kept separate as they are not used in encoding
    $codes_tw = serialize_point_array($nhk);
    $codes_hk = serialize_point_array($hk);
    $enc = serialize_point_array($dupes);
    echo "const TABLE_DOUBLES = $specials;\n";
    echo "const TABLE_CODES_TW = $codes_tw;\n";
    echo "const TABLE_CODES_HK = $codes_hk;\n";
    echo "const TABLE_POINTERS = $enc;\n";
}

function euckr(string $label) {
    $codes = serialize_point_array(read_index($label, "https://encoding.spec.whatwg.org/index-$label.txt"));
    echo "const TABLE_CODES = $codes;\n";
}

function eucjp(string $label) {
    $jis0212 = serialize_point_array(read_index("jis0212", "https://encoding.spec.whatwg.org/index-jis0212.txt"));
    $table = read_index("jis0208", "https://encoding.spec.whatwg.org/index-jis0208.txt");
    $dupes = serialize_point_array(make_override_array($table));
    $jis0208 = serialize_point_array($table);
    echo "const TABLE_JIS0208 = $jis0208;\n";
    echo "const TABLE_JIS0212 = $jis0212;\n";
    echo "const TABLE_POINTERS = $dupes;\n";
}

function iso2022jp(string $label) {
    $kana = serialize_point_array(read_index("jis0208", "https://encoding.spec.whatwg.org/index-iso-2022-jp-katakana.txt"));
    $table = read_index("jis0208", "https://encoding.spec.whatwg.org/index-jis0208.txt");
    $dupes = serialize_point_array(make_override_array($table));
    $jis0208 = serialize_point_array($table);
    echo "const TABLE_JIS0208 = $jis0208;\n";
    echo "const TABLE_KATAKANA = $kana;\n";
    echo "const TABLE_POINTERS = $dupes;\n";
}

function shiftjis(string $label) {
    $table = read_index($label, "https://encoding.spec.whatwg.org/index-jis0208.txt");
    // exclude a range of pointers from encoding consideration
    $dec = [];
    $shared = [];
    foreach ($table as $pointer => $code) {
        if ($pointer < 8272 || $pointer > 8835) {
            $shared[$pointer] = $code;
        } else {
            $dec[$pointer] = $code;
        }
    }
    // search the encoder set for duplicates
    $dupes = make_override_array($shared);
    // serialize and print; the $shared set is used for both encoding and decoding; the $dec set is used only for decoding
    $codes = serialize_point_array($shared);
    $codes_extra = serialize_point_array($dec);
    $enc = serialize_point_array($dupes);
    echo "const TABLE_CODES = $codes;\n";
    echo "const TABLE_CODES_EXTRA = $codes_extra;\n";
    echo "const TABLE_POINTERS = $enc;\n";
}

// generic helper functions

function read_index(string $label, string $url): array {
    $data = file_get_contents($url) or die("index file for '$label' could not be retrieved from network.");
    // find lines that contain data
    preg_match_all("/^\s*(\d+)\s+0x([0-9A-Z]+)/m", $data, $matches, \PREG_SET_ORDER);
    $out = [];
    foreach ($matches as list($match, $index, $code)) {
        $out[(int) $index] = (int) hexdec($code);
    }
    return $out;
}

function serialize_point_array(array $table): string {
    $out = [];
    $i = 0;
    foreach ($table as $index => $code) {
        // non-sequential indices must be printed, but others can be omitted
        if ($index === $i) {
            $key = "";
        } else {
            $key = "$index=>";
            $i = $index;
        }
        $out[] = $key.$code;
        $i++;
    }
    return "[".implode(",", $out)."]";
}

function serialize_char_array(array $table): string {
    $out = [];
    $i = 0;
    foreach ($table as $index => $code) {
        // non-sequential indices must be printed, but others can be omitted
        if ($index === $i) {
            $key = "";
        } else {
            $key = "$index=>";
            $i = $index;
        }
        $out[] = $key."\"\\u{".$code."}\"";
        $i++;
    }
    return "[".implode(",", $out)."]";
}

// this is only used for single-byte encoders; other encoders instead flip their decoder arrays with overrides for duplicates or special cases
function serialize_single_byte_array(array $table): string {
    $out = [];
    foreach ($table as $index => $code) {
        $byte = strtoupper(str_pad(dechex($index + 128), 2, "0", \STR_PAD_LEFT));
        $out[$code] = "\"\\x$byte\"";
    }
    ksort($out);
    $i = 0;
    foreach ($out as $index => $value) {
        if ($index == $i) {
            $key = "";
        } else {
            $key = "$index=>";
            $i = $index;
        }
        $out[$index] = "$key$value";
        $i++;
    }
    return "[".implode(",", $out)."]";
}

// indexes with duplicate code points by default need to match the lowest pointer when encoding
// PHP's array_flip() function retains the last duplicate rather than the first, so we have to find duplicates
function make_override_array(array $table): array {
    $out = [];
    $dupes = array_keys(array_filter(array_count_values($table), function($v) {
        return $v > 1;
    }));
    foreach ($dupes as $code_point) {
        $out[$code_point] = array_search($code_point, $table);
    }
    ksort($out);
    return $out;
}
