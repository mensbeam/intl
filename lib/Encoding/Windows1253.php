<?php
/** @license MIT
 * Copyright 2018 J. King et al.
 * See LICENSE and AUTHORS files for details */

declare(strict_types=1);
namespace MensBeam\Intl\Encoding;

class Windows1253 extends SingleByteEncoding {
    public const NAME = "windows-1253";
    public const LABELS = [
        "cp1253",
        "windows-1253",
        "x-cp1253",
    ];

    protected const TABLE_DEC_CHAR = ["\u{20ac}","\u{81}","\u{201a}","\u{192}","\u{201e}","\u{2026}","\u{2020}","\u{2021}","\u{88}","\u{2030}","\u{8a}","\u{2039}","\u{8c}","\u{8d}","\u{8e}","\u{8f}","\u{90}","\u{2018}","\u{2019}","\u{201c}","\u{201d}","\u{2022}","\u{2013}","\u{2014}","\u{98}","\u{2122}","\u{9a}","\u{203a}","\u{9c}","\u{9d}","\u{9e}","\u{9f}","\u{a0}","\u{385}","\u{386}","\u{a3}","\u{a4}","\u{a5}","\u{a6}","\u{a7}","\u{a8}","\u{a9}",43=>"\u{ab}","\u{ac}","\u{ad}","\u{ae}","\u{2015}","\u{b0}","\u{b1}","\u{b2}","\u{b3}","\u{384}","\u{b5}","\u{b6}","\u{b7}","\u{388}","\u{389}","\u{38a}","\u{bb}","\u{38c}","\u{bd}","\u{38e}","\u{38f}","\u{390}","\u{391}","\u{392}","\u{393}","\u{394}","\u{395}","\u{396}","\u{397}","\u{398}","\u{399}","\u{39a}","\u{39b}","\u{39c}","\u{39d}","\u{39e}","\u{39f}","\u{3a0}","\u{3a1}",83=>"\u{3a3}","\u{3a4}","\u{3a5}","\u{3a6}","\u{3a7}","\u{3a8}","\u{3a9}","\u{3aa}","\u{3ab}","\u{3ac}","\u{3ad}","\u{3ae}","\u{3af}","\u{3b0}","\u{3b1}","\u{3b2}","\u{3b3}","\u{3b4}","\u{3b5}","\u{3b6}","\u{3b7}","\u{3b8}","\u{3b9}","\u{3ba}","\u{3bb}","\u{3bc}","\u{3bd}","\u{3be}","\u{3bf}","\u{3c0}","\u{3c1}","\u{3c2}","\u{3c3}","\u{3c4}","\u{3c5}","\u{3c6}","\u{3c7}","\u{3c8}","\u{3c9}","\u{3ca}","\u{3cb}","\u{3cc}","\u{3cd}","\u{3ce}"];
    protected const TABLE_DEC_CODE = [8364,129,8218,402,8222,8230,8224,8225,136,8240,138,8249,140,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,152,8482,154,8250,156,157,158,159,160,901,902,163,164,165,166,167,168,169,43=>171,172,173,174,8213,176,177,178,179,900,181,182,183,904,905,906,187,908,189,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,926,927,928,929,83=>931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974];
    protected const TABLE_ENC      = [129=>"\x81",136=>"\x88",138=>"\x8A",140=>"\x8C","\x8D","\x8E","\x8F","\x90",152=>"\x98",154=>"\x9A",156=>"\x9C","\x9D","\x9E","\x9F","\xA0",163=>"\xA3","\xA4","\xA5","\xA6","\xA7","\xA8","\xA9",171=>"\xAB","\xAC","\xAD","\xAE",176=>"\xB0","\xB1","\xB2","\xB3",181=>"\xB5","\xB6","\xB7",187=>"\xBB",189=>"\xBD",402=>"\x83",900=>"\xB4","\xA1","\xA2",904=>"\xB8","\xB9","\xBA",908=>"\xBC",910=>"\xBE","\xBF","\xC0","\xC1","\xC2","\xC3","\xC4","\xC5","\xC6","\xC7","\xC8","\xC9","\xCA","\xCB","\xCC","\xCD","\xCE","\xCF","\xD0","\xD1",931=>"\xD3","\xD4","\xD5","\xD6","\xD7","\xD8","\xD9","\xDA","\xDB","\xDC","\xDD","\xDE","\xDF","\xE0","\xE1","\xE2","\xE3","\xE4","\xE5","\xE6","\xE7","\xE8","\xE9","\xEA","\xEB","\xEC","\xED","\xEE","\xEF","\xF0","\xF1","\xF2","\xF3","\xF4","\xF5","\xF6","\xF7","\xF8","\xF9","\xFA","\xFB","\xFC","\xFD","\xFE",8211=>"\x96","\x97","\xAF",8216=>"\x91","\x92","\x82",8220=>"\x93","\x94","\x84",8224=>"\x86","\x87","\x95",8230=>"\x85",8240=>"\x89",8249=>"\x8B","\x9B",8364=>"\x80",8482=>"\x99"];
}
