<?php
/** @license MIT
 * Copyright 2018 J. King et al.
 * See LICENSE and AUTHORS files for details */

declare(strict_types=1);
namespace MensBeam\Intl\Encoding;

class Windows1251 extends SingleByteEncoding {
    public const NAME = "windows-1251";
    public const LABELS = [
        "cp1251",
        "windows-1251",
        "x-cp1251",
    ];

    protected const TABLE_DEC_CHAR = ["\u{402}","\u{403}","\u{201a}","\u{453}","\u{201e}","\u{2026}","\u{2020}","\u{2021}","\u{20ac}","\u{2030}","\u{409}","\u{2039}","\u{40a}","\u{40c}","\u{40b}","\u{40f}","\u{452}","\u{2018}","\u{2019}","\u{201c}","\u{201d}","\u{2022}","\u{2013}","\u{2014}","\u{98}","\u{2122}","\u{459}","\u{203a}","\u{45a}","\u{45c}","\u{45b}","\u{45f}","\u{a0}","\u{40e}","\u{45e}","\u{408}","\u{a4}","\u{490}","\u{a6}","\u{a7}","\u{401}","\u{a9}","\u{404}","\u{ab}","\u{ac}","\u{ad}","\u{ae}","\u{407}","\u{b0}","\u{b1}","\u{406}","\u{456}","\u{491}","\u{b5}","\u{b6}","\u{b7}","\u{451}","\u{2116}","\u{454}","\u{bb}","\u{458}","\u{405}","\u{455}","\u{457}","\u{410}","\u{411}","\u{412}","\u{413}","\u{414}","\u{415}","\u{416}","\u{417}","\u{418}","\u{419}","\u{41a}","\u{41b}","\u{41c}","\u{41d}","\u{41e}","\u{41f}","\u{420}","\u{421}","\u{422}","\u{423}","\u{424}","\u{425}","\u{426}","\u{427}","\u{428}","\u{429}","\u{42a}","\u{42b}","\u{42c}","\u{42d}","\u{42e}","\u{42f}","\u{430}","\u{431}","\u{432}","\u{433}","\u{434}","\u{435}","\u{436}","\u{437}","\u{438}","\u{439}","\u{43a}","\u{43b}","\u{43c}","\u{43d}","\u{43e}","\u{43f}","\u{440}","\u{441}","\u{442}","\u{443}","\u{444}","\u{445}","\u{446}","\u{447}","\u{448}","\u{449}","\u{44a}","\u{44b}","\u{44c}","\u{44d}","\u{44e}","\u{44f}"];
    protected const TABLE_DEC_CODE = [1026,1027,8218,1107,8222,8230,8224,8225,8364,8240,1033,8249,1034,1036,1035,1039,1106,8216,8217,8220,8221,8226,8211,8212,152,8482,1113,8250,1114,1116,1115,1119,160,1038,1118,1032,164,1168,166,167,1025,169,1028,171,172,173,174,1031,176,177,1030,1110,1169,181,182,183,1105,8470,1108,187,1112,1029,1109,1111,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,1101,1102,1103];
    protected const TABLE_ENC      = [152=>"\x98",160=>"\xA0",164=>"\xA4",166=>"\xA6","\xA7",169=>"\xA9",171=>"\xAB","\xAC","\xAD","\xAE",176=>"\xB0","\xB1",181=>"\xB5","\xB6","\xB7",187=>"\xBB",1025=>"\xA8","\x80","\x81","\xAA","\xBD","\xB2","\xAF","\xA3","\x8A","\x8C","\x8E","\x8D",1038=>"\xA1","\x8F","\xC0","\xC1","\xC2","\xC3","\xC4","\xC5","\xC6","\xC7","\xC8","\xC9","\xCA","\xCB","\xCC","\xCD","\xCE","\xCF","\xD0","\xD1","\xD2","\xD3","\xD4","\xD5","\xD6","\xD7","\xD8","\xD9","\xDA","\xDB","\xDC","\xDD","\xDE","\xDF","\xE0","\xE1","\xE2","\xE3","\xE4","\xE5","\xE6","\xE7","\xE8","\xE9","\xEA","\xEB","\xEC","\xED","\xEE","\xEF","\xF0","\xF1","\xF2","\xF3","\xF4","\xF5","\xF6","\xF7","\xF8","\xF9","\xFA","\xFB","\xFC","\xFD","\xFE","\xFF",1105=>"\xB8","\x90","\x83","\xBA","\xBE","\xB3","\xBF","\xBC","\x9A","\x9C","\x9E","\x9D",1118=>"\xA2","\x9F",1168=>"\xA5","\xB4",8211=>"\x96","\x97",8216=>"\x91","\x92","\x82",8220=>"\x93","\x94","\x84",8224=>"\x86","\x87","\x95",8230=>"\x85",8240=>"\x89",8249=>"\x8B","\x9B",8364=>"\x88",8470=>"\xB9",8482=>"\x99"];
}
