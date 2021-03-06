<?php
/** @license MIT
 * Copyright 2018 J. King et al.
 * See LICENSE and AUTHORS files for details */

declare(strict_types=1);
namespace MensBeam\Intl\Encoding;

class Windows1250 extends SingleByteEncoding {
    public const NAME = "windows-1250";
    public const LABELS = [
        "cp1250",
        "windows-1250",
        "x-cp1250",
    ];

    protected const TABLE_DEC_CHAR = ["\u{20ac}","\u{81}","\u{201a}","\u{83}","\u{201e}","\u{2026}","\u{2020}","\u{2021}","\u{88}","\u{2030}","\u{160}","\u{2039}","\u{15a}","\u{164}","\u{17d}","\u{179}","\u{90}","\u{2018}","\u{2019}","\u{201c}","\u{201d}","\u{2022}","\u{2013}","\u{2014}","\u{98}","\u{2122}","\u{161}","\u{203a}","\u{15b}","\u{165}","\u{17e}","\u{17a}","\u{a0}","\u{2c7}","\u{2d8}","\u{141}","\u{a4}","\u{104}","\u{a6}","\u{a7}","\u{a8}","\u{a9}","\u{15e}","\u{ab}","\u{ac}","\u{ad}","\u{ae}","\u{17b}","\u{b0}","\u{b1}","\u{2db}","\u{142}","\u{b4}","\u{b5}","\u{b6}","\u{b7}","\u{b8}","\u{105}","\u{15f}","\u{bb}","\u{13d}","\u{2dd}","\u{13e}","\u{17c}","\u{154}","\u{c1}","\u{c2}","\u{102}","\u{c4}","\u{139}","\u{106}","\u{c7}","\u{10c}","\u{c9}","\u{118}","\u{cb}","\u{11a}","\u{cd}","\u{ce}","\u{10e}","\u{110}","\u{143}","\u{147}","\u{d3}","\u{d4}","\u{150}","\u{d6}","\u{d7}","\u{158}","\u{16e}","\u{da}","\u{170}","\u{dc}","\u{dd}","\u{162}","\u{df}","\u{155}","\u{e1}","\u{e2}","\u{103}","\u{e4}","\u{13a}","\u{107}","\u{e7}","\u{10d}","\u{e9}","\u{119}","\u{eb}","\u{11b}","\u{ed}","\u{ee}","\u{10f}","\u{111}","\u{144}","\u{148}","\u{f3}","\u{f4}","\u{151}","\u{f6}","\u{f7}","\u{159}","\u{16f}","\u{fa}","\u{171}","\u{fc}","\u{fd}","\u{163}","\u{2d9}"];
    protected const TABLE_DEC_CODE = [8364,129,8218,131,8222,8230,8224,8225,136,8240,352,8249,346,356,381,377,144,8216,8217,8220,8221,8226,8211,8212,152,8482,353,8250,347,357,382,378,160,711,728,321,164,260,166,167,168,169,350,171,172,173,174,379,176,177,731,322,180,181,182,183,184,261,351,187,317,733,318,380,340,193,194,258,196,313,262,199,268,201,280,203,282,205,206,270,272,323,327,211,212,336,214,215,344,366,218,368,220,221,354,223,341,225,226,259,228,314,263,231,269,233,281,235,283,237,238,271,273,324,328,243,244,337,246,247,345,367,250,369,252,253,355,729];
    protected const TABLE_ENC      = [129=>"\x81",131=>"\x83",136=>"\x88",144=>"\x90",152=>"\x98",160=>"\xA0",164=>"\xA4",166=>"\xA6","\xA7","\xA8","\xA9",171=>"\xAB","\xAC","\xAD","\xAE",176=>"\xB0","\xB1",180=>"\xB4","\xB5","\xB6","\xB7","\xB8",187=>"\xBB",193=>"\xC1","\xC2",196=>"\xC4",199=>"\xC7",201=>"\xC9",203=>"\xCB",205=>"\xCD","\xCE",211=>"\xD3","\xD4",214=>"\xD6","\xD7",218=>"\xDA",220=>"\xDC","\xDD",223=>"\xDF",225=>"\xE1","\xE2",228=>"\xE4",231=>"\xE7",233=>"\xE9",235=>"\xEB",237=>"\xED","\xEE",243=>"\xF3","\xF4",246=>"\xF6","\xF7",250=>"\xFA",252=>"\xFC","\xFD",258=>"\xC3","\xE3","\xA5","\xB9","\xC6","\xE6",268=>"\xC8","\xE8","\xCF","\xEF","\xD0","\xF0",280=>"\xCA","\xEA","\xCC","\xEC",313=>"\xC5","\xE5",317=>"\xBC","\xBE",321=>"\xA3","\xB3","\xD1","\xF1",327=>"\xD2","\xF2",336=>"\xD5","\xF5",340=>"\xC0","\xE0",344=>"\xD8","\xF8","\x8C","\x9C",350=>"\xAA","\xBA","\x8A","\x9A","\xDE","\xFE","\x8D","\x9D",366=>"\xD9","\xF9","\xDB","\xFB",377=>"\x8F","\x9F","\xAF","\xBF","\x8E","\x9E",711=>"\xA1",728=>"\xA2","\xFF",731=>"\xB2",733=>"\xBD",8211=>"\x96","\x97",8216=>"\x91","\x92","\x82",8220=>"\x93","\x94","\x84",8224=>"\x86","\x87","\x95",8230=>"\x85",8240=>"\x89",8249=>"\x8B","\x9B",8364=>"\x80",8482=>"\x99"];
}
