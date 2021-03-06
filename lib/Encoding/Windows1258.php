<?php
/** @license MIT
 * Copyright 2018 J. King et al.
 * See LICENSE and AUTHORS files for details */

declare(strict_types=1);
namespace MensBeam\Intl\Encoding;

class Windows1258 extends SingleByteEncoding {
    public const NAME = "windows-1258";
    public const LABELS = [
        "cp1258",
        "windows-1258",
        "x-cp1258",
    ];

    protected const TABLE_DEC_CHAR = ["\u{20ac}","\u{81}","\u{201a}","\u{192}","\u{201e}","\u{2026}","\u{2020}","\u{2021}","\u{2c6}","\u{2030}","\u{8a}","\u{2039}","\u{152}","\u{8d}","\u{8e}","\u{8f}","\u{90}","\u{2018}","\u{2019}","\u{201c}","\u{201d}","\u{2022}","\u{2013}","\u{2014}","\u{2dc}","\u{2122}","\u{9a}","\u{203a}","\u{153}","\u{9d}","\u{9e}","\u{178}","\u{a0}","\u{a1}","\u{a2}","\u{a3}","\u{a4}","\u{a5}","\u{a6}","\u{a7}","\u{a8}","\u{a9}","\u{aa}","\u{ab}","\u{ac}","\u{ad}","\u{ae}","\u{af}","\u{b0}","\u{b1}","\u{b2}","\u{b3}","\u{b4}","\u{b5}","\u{b6}","\u{b7}","\u{b8}","\u{b9}","\u{ba}","\u{bb}","\u{bc}","\u{bd}","\u{be}","\u{bf}","\u{c0}","\u{c1}","\u{c2}","\u{102}","\u{c4}","\u{c5}","\u{c6}","\u{c7}","\u{c8}","\u{c9}","\u{ca}","\u{cb}","\u{300}","\u{cd}","\u{ce}","\u{cf}","\u{110}","\u{d1}","\u{309}","\u{d3}","\u{d4}","\u{1a0}","\u{d6}","\u{d7}","\u{d8}","\u{d9}","\u{da}","\u{db}","\u{dc}","\u{1af}","\u{303}","\u{df}","\u{e0}","\u{e1}","\u{e2}","\u{103}","\u{e4}","\u{e5}","\u{e6}","\u{e7}","\u{e8}","\u{e9}","\u{ea}","\u{eb}","\u{301}","\u{ed}","\u{ee}","\u{ef}","\u{111}","\u{f1}","\u{323}","\u{f3}","\u{f4}","\u{1a1}","\u{f6}","\u{f7}","\u{f8}","\u{f9}","\u{fa}","\u{fb}","\u{fc}","\u{1b0}","\u{20ab}","\u{ff}"];
    protected const TABLE_DEC_CODE = [8364,129,8218,402,8222,8230,8224,8225,710,8240,138,8249,338,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,732,8482,154,8250,339,157,158,376,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,258,196,197,198,199,200,201,202,203,768,205,206,207,272,209,777,211,212,416,214,215,216,217,218,219,220,431,771,223,224,225,226,259,228,229,230,231,232,233,234,235,769,237,238,239,273,241,803,243,244,417,246,247,248,249,250,251,252,432,8363,255];
    protected const TABLE_ENC      = [129=>"\x81",138=>"\x8A",141=>"\x8D","\x8E","\x8F","\x90",154=>"\x9A",157=>"\x9D","\x9E",160=>"\xA0","\xA1","\xA2","\xA3","\xA4","\xA5","\xA6","\xA7","\xA8","\xA9","\xAA","\xAB","\xAC","\xAD","\xAE","\xAF","\xB0","\xB1","\xB2","\xB3","\xB4","\xB5","\xB6","\xB7","\xB8","\xB9","\xBA","\xBB","\xBC","\xBD","\xBE","\xBF","\xC0","\xC1","\xC2",196=>"\xC4","\xC5","\xC6","\xC7","\xC8","\xC9","\xCA","\xCB",205=>"\xCD","\xCE","\xCF",209=>"\xD1",211=>"\xD3","\xD4",214=>"\xD6","\xD7","\xD8","\xD9","\xDA","\xDB","\xDC",223=>"\xDF","\xE0","\xE1","\xE2",228=>"\xE4","\xE5","\xE6","\xE7","\xE8","\xE9","\xEA","\xEB",237=>"\xED","\xEE","\xEF",241=>"\xF1",243=>"\xF3","\xF4",246=>"\xF6","\xF7","\xF8","\xF9","\xFA","\xFB","\xFC",255=>"\xFF",258=>"\xC3","\xE3",272=>"\xD0","\xF0",338=>"\x8C","\x9C",376=>"\x9F",402=>"\x83",416=>"\xD5","\xF5",431=>"\xDD","\xFD",710=>"\x88",732=>"\x98",768=>"\xCC","\xEC",771=>"\xDE",777=>"\xD2",803=>"\xF2",8211=>"\x96","\x97",8216=>"\x91","\x92","\x82",8220=>"\x93","\x94","\x84",8224=>"\x86","\x87","\x95",8230=>"\x85",8240=>"\x89",8249=>"\x8B","\x9B",8363=>"\xFE","\x80",8482=>"\x99"];
}
