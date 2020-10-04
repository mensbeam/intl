<?php
/** @license MIT
 * Copyright 2018 J. King et al.
 * See LICENSE and AUTHORS files for details */

declare(strict_types=1);
namespace MensBeam\Intl\TestCase\Encoding;

use MensBeam\Intl\Encoding\SingleByteEncoding;
use MensBeam\Intl\Encoding\EncoderException;

class TestSingleByte extends \MensBeam\Intl\Test\CoderDecoderTest {
    // maps taken from https://github.com/web-platform-tests/wpt/blob/d6c29bef8d4bcdfe4f689defca73360b07647d71/encoding/single-byte-decoder.html
    // ISO-8859-8 was duplicated for ISO-8859-8-I
    protected static $maps = [
        "IBM866"         => [1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,9617,9618,9619,9474,9508,9569,9570,9558,9557,9571,9553,9559,9565,9564,9563,9488,9492,9524,9516,9500,9472,9532,9566,9567,9562,9556,9577,9574,9568,9552,9580,9575,9576,9572,9573,9561,9560,9554,9555,9579,9578,9496,9484,9608,9604,9612,9616,9600,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,1101,1102,1103,1025,1105,1028,1108,1031,1111,1038,1118,176,8729,183,8730,8470,164,9632,160],
        "ISO-8859-2"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,260,728,321,164,317,346,167,168,352,350,356,377,173,381,379,176,261,731,322,180,318,347,711,184,353,351,357,378,733,382,380,340,193,194,258,196,313,262,199,268,201,280,203,282,205,206,270,272,323,327,211,212,336,214,215,344,366,218,368,220,221,354,223,341,225,226,259,228,314,263,231,269,233,281,235,283,237,238,271,273,324,328,243,244,337,246,247,345,367,250,369,252,253,355,729],
        "ISO-8859-3"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,294,728,163,164,null,292,167,168,304,350,286,308,173,null,379,176,295,178,179,180,181,293,183,184,305,351,287,309,189,null,380,192,193,194,null,196,266,264,199,200,201,202,203,204,205,206,207,null,209,210,211,212,288,214,215,284,217,218,219,220,364,348,223,224,225,226,null,228,267,265,231,232,233,234,235,236,237,238,239,null,241,242,243,244,289,246,247,285,249,250,251,252,365,349,729],
        "ISO-8859-4"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,260,312,342,164,296,315,167,168,352,274,290,358,173,381,175,176,261,731,343,180,297,316,711,184,353,275,291,359,330,382,331,256,193,194,195,196,197,198,302,268,201,280,203,278,205,206,298,272,325,332,310,212,213,214,215,216,370,218,219,220,360,362,223,257,225,226,227,228,229,230,303,269,233,281,235,279,237,238,299,273,326,333,311,244,245,246,247,248,371,250,251,252,361,363,729],
        "ISO-8859-5"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,173,1038,1039,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,1101,1102,1103,8470,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,167,1118,1119],
        "ISO-8859-6"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,null,null,null,164,null,null,null,null,null,null,null,1548,173,null,null,null,null,null,null,null,null,null,null,null,null,null,1563,null,null,null,1567,null,1569,1570,1571,1572,1573,1574,1575,1576,1577,1578,1579,1580,1581,1582,1583,1584,1585,1586,1587,1588,1589,1590,1591,1592,1593,1594,null,null,null,null,null,1600,1601,1602,1603,1604,1605,1606,1607,1608,1609,1610,1611,1612,1613,1614,1615,1616,1617,1618,null,null,null,null,null,null,null,null,null,null,null,null,null],
        "ISO-8859-7"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,8216,8217,163,8364,8367,166,167,168,169,890,171,172,173,null,8213,176,177,178,179,900,901,902,183,904,905,906,187,908,189,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,926,927,928,929,null,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,null],
        "ISO-8859-8"     => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,null,162,163,164,165,166,167,168,169,215,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,247,187,188,189,190,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,8215,1488,1489,1490,1491,1492,1493,1494,1495,1496,1497,1498,1499,1500,1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,null,null,8206,8207,null],
        "ISO-8859-8-I"   => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,null,162,163,164,165,166,167,168,169,215,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,247,187,188,189,190,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,8215,1488,1489,1490,1491,1492,1493,1494,1495,1496,1497,1498,1499,1500,1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,null,null,8206,8207,null],
        "ISO-8859-10"    => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,260,274,290,298,296,310,167,315,272,352,358,381,173,362,330,176,261,275,291,299,297,311,183,316,273,353,359,382,8213,363,331,256,193,194,195,196,197,198,302,268,201,280,203,278,205,206,207,208,325,332,211,212,213,214,360,216,370,218,219,220,221,222,223,257,225,226,227,228,229,230,303,269,233,281,235,279,237,238,239,240,326,333,243,244,245,246,361,248,371,250,251,252,253,254,312],
        "ISO-8859-13"    => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,8221,162,163,164,8222,166,167,216,169,342,171,172,173,174,198,176,177,178,179,8220,181,182,183,248,185,343,187,188,189,190,230,260,302,256,262,196,197,280,274,268,201,377,278,290,310,298,315,352,323,325,211,332,213,214,215,370,321,346,362,220,379,381,223,261,303,257,263,228,229,281,275,269,233,378,279,291,311,299,316,353,324,326,243,333,245,246,247,371,322,347,363,252,380,382,8217],
        "ISO-8859-14"    => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,7682,7683,163,266,267,7690,167,7808,169,7810,7691,7922,173,174,376,7710,7711,288,289,7744,7745,182,7766,7809,7767,7811,7776,7923,7812,7813,7777,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,372,209,210,211,212,213,214,7786,216,217,218,219,220,221,374,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,373,241,242,243,244,245,246,7787,248,249,250,251,252,253,375,255],
        "ISO-8859-15"    => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,8364,165,352,167,353,169,170,171,172,173,174,175,176,177,178,179,381,181,182,183,382,185,186,187,338,339,376,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255],
        "ISO-8859-16"    => [128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,260,261,321,8364,8222,352,167,353,169,536,171,377,173,378,379,176,177,268,322,381,8221,182,183,382,269,537,187,338,339,376,380,192,193,194,258,196,262,198,199,200,201,202,203,204,205,206,207,272,323,210,211,212,336,214,346,368,217,218,219,220,280,538,223,224,225,226,259,228,263,230,231,232,233,234,235,236,237,238,239,273,324,242,243,244,337,246,347,369,249,250,251,252,281,539,255],
        "KOI8-R"         => [9472,9474,9484,9488,9492,9496,9500,9508,9516,9524,9532,9600,9604,9608,9612,9616,9617,9618,9619,8992,9632,8729,8730,8776,8804,8805,160,8993,176,178,183,247,9552,9553,9554,1105,9555,9556,9557,9558,9559,9560,9561,9562,9563,9564,9565,9566,9567,9568,9569,1025,9570,9571,9572,9573,9574,9575,9576,9577,9578,9579,9580,169,1102,1072,1073,1094,1076,1077,1092,1075,1093,1080,1081,1082,1083,1084,1085,1086,1087,1103,1088,1089,1090,1091,1078,1074,1100,1099,1079,1096,1101,1097,1095,1098,1070,1040,1041,1062,1044,1045,1060,1043,1061,1048,1049,1050,1051,1052,1053,1054,1055,1071,1056,1057,1058,1059,1046,1042,1068,1067,1047,1064,1069,1065,1063,1066],
        "KOI8-U"         => [9472,9474,9484,9488,9492,9496,9500,9508,9516,9524,9532,9600,9604,9608,9612,9616,9617,9618,9619,8992,9632,8729,8730,8776,8804,8805,160,8993,176,178,183,247,9552,9553,9554,1105,1108,9556,1110,1111,9559,9560,9561,9562,9563,1169,1118,9566,9567,9568,9569,1025,1028,9571,1030,1031,9574,9575,9576,9577,9578,1168,1038,169,1102,1072,1073,1094,1076,1077,1092,1075,1093,1080,1081,1082,1083,1084,1085,1086,1087,1103,1088,1089,1090,1091,1078,1074,1100,1099,1079,1096,1101,1097,1095,1098,1070,1040,1041,1062,1044,1045,1060,1043,1061,1048,1049,1050,1051,1052,1053,1054,1055,1071,1056,1057,1058,1059,1046,1042,1068,1067,1047,1064,1069,1065,1063,1066],
        "macintosh"      => [196,197,199,201,209,214,220,225,224,226,228,227,229,231,233,232,234,235,237,236,238,239,241,243,242,244,246,245,250,249,251,252,8224,176,162,163,167,8226,182,223,174,169,8482,180,168,8800,198,216,8734,177,8804,8805,165,181,8706,8721,8719,960,8747,170,186,937,230,248,191,161,172,8730,402,8776,8710,171,187,8230,160,192,195,213,338,339,8211,8212,8220,8221,8216,8217,247,9674,255,376,8260,8364,8249,8250,64257,64258,8225,183,8218,8222,8240,194,202,193,203,200,205,206,207,204,211,212,63743,210,218,219,217,305,710,732,175,728,729,730,184,733,731,711],
        "windows-874"    => [8364,129,130,131,132,8230,134,135,136,137,138,139,140,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,152,153,154,155,156,157,158,159,160,3585,3586,3587,3588,3589,3590,3591,3592,3593,3594,3595,3596,3597,3598,3599,3600,3601,3602,3603,3604,3605,3606,3607,3608,3609,3610,3611,3612,3613,3614,3615,3616,3617,3618,3619,3620,3621,3622,3623,3624,3625,3626,3627,3628,3629,3630,3631,3632,3633,3634,3635,3636,3637,3638,3639,3640,3641,3642,null,null,null,null,3647,3648,3649,3650,3651,3652,3653,3654,3655,3656,3657,3658,3659,3660,3661,3662,3663,3664,3665,3666,3667,3668,3669,3670,3671,3672,3673,3674,3675,null,null,null,null],
        "windows-1250"   => [8364,129,8218,131,8222,8230,8224,8225,136,8240,352,8249,346,356,381,377,144,8216,8217,8220,8221,8226,8211,8212,152,8482,353,8250,347,357,382,378,160,711,728,321,164,260,166,167,168,169,350,171,172,173,174,379,176,177,731,322,180,181,182,183,184,261,351,187,317,733,318,380,340,193,194,258,196,313,262,199,268,201,280,203,282,205,206,270,272,323,327,211,212,336,214,215,344,366,218,368,220,221,354,223,341,225,226,259,228,314,263,231,269,233,281,235,283,237,238,271,273,324,328,243,244,337,246,247,345,367,250,369,252,253,355,729],
        "windows-1251"   => [1026,1027,8218,1107,8222,8230,8224,8225,8364,8240,1033,8249,1034,1036,1035,1039,1106,8216,8217,8220,8221,8226,8211,8212,152,8482,1113,8250,1114,1116,1115,1119,160,1038,1118,1032,164,1168,166,167,1025,169,1028,171,172,173,174,1031,176,177,1030,1110,1169,181,182,183,1105,8470,1108,187,1112,1029,1109,1111,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,1101,1102,1103],
        "windows-1252"   => [8364,129,8218,402,8222,8230,8224,8225,710,8240,352,8249,338,141,381,143,144,8216,8217,8220,8221,8226,8211,8212,732,8482,353,8250,339,157,382,376,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255],
        "windows-1253"   => [8364,129,8218,402,8222,8230,8224,8225,136,8240,138,8249,140,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,152,8482,154,8250,156,157,158,159,160,901,902,163,164,165,166,167,168,169,null,171,172,173,174,8213,176,177,178,179,900,181,182,183,904,905,906,187,908,189,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,926,927,928,929,null,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,null],
        "windows-1254"   => [8364,129,8218,402,8222,8230,8224,8225,710,8240,352,8249,338,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,732,8482,353,8250,339,157,158,376,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,286,209,210,211,212,213,214,215,216,217,218,219,220,304,350,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,287,241,242,243,244,245,246,247,248,249,250,251,252,305,351,255],
        "windows-1255"   => [8364,129,8218,402,8222,8230,8224,8225,710,8240,138,8249,140,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,732,8482,154,8250,156,157,158,159,160,161,162,163,8362,165,166,167,168,169,215,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,247,187,188,189,190,191,1456,1457,1458,1459,1460,1461,1462,1463,1464,1465,1466,1467,1468,1469,1470,1471,1472,1473,1474,1475,1520,1521,1522,1523,1524,null,null,null,null,null,null,null,1488,1489,1490,1491,1492,1493,1494,1495,1496,1497,1498,1499,1500,1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,null,null,8206,8207,null],
        "windows-1256"   => [8364,1662,8218,402,8222,8230,8224,8225,710,8240,1657,8249,338,1670,1688,1672,1711,8216,8217,8220,8221,8226,8211,8212,1705,8482,1681,8250,339,8204,8205,1722,160,1548,162,163,164,165,166,167,168,169,1726,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,1563,187,188,189,190,1567,1729,1569,1570,1571,1572,1573,1574,1575,1576,1577,1578,1579,1580,1581,1582,1583,1584,1585,1586,1587,1588,1589,1590,215,1591,1592,1593,1594,1600,1601,1602,1603,224,1604,226,1605,1606,1607,1608,231,232,233,234,235,1609,1610,238,239,1611,1612,1613,1614,244,1615,1616,247,1617,249,1618,251,252,8206,8207,1746],
        "windows-1257"   => [8364,129,8218,131,8222,8230,8224,8225,136,8240,138,8249,140,168,711,184,144,8216,8217,8220,8221,8226,8211,8212,152,8482,154,8250,156,175,731,159,160,null,162,163,164,null,166,167,216,169,342,171,172,173,174,198,176,177,178,179,180,181,182,183,248,185,343,187,188,189,190,230,260,302,256,262,196,197,280,274,268,201,377,278,290,310,298,315,352,323,325,211,332,213,214,215,370,321,346,362,220,379,381,223,261,303,257,263,228,229,281,275,269,233,378,279,291,311,299,316,353,324,326,243,333,245,246,247,371,322,347,363,252,380,382,729],
        "windows-1258"   => [8364,129,8218,402,8222,8230,8224,8225,710,8240,138,8249,338,141,142,143,144,8216,8217,8220,8221,8226,8211,8212,732,8482,154,8250,339,157,158,376,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,258,196,197,198,199,200,201,202,203,768,205,206,207,272,209,777,211,212,416,214,215,216,217,218,219,220,431,771,223,224,225,226,259,228,229,230,231,232,233,234,235,769,237,238,239,273,241,803,243,244,417,246,247,248,249,250,251,252,432,8363,255],
        "x-mac-cyrillic" => [1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,8224,176,1168,163,167,8226,182,1030,174,169,8482,1026,1106,8800,1027,1107,8734,177,8804,8805,1110,181,1169,1032,1028,1108,1031,1111,1033,1113,1034,1114,1112,1029,172,8730,402,8776,8710,171,187,8230,160,1035,1115,1036,1116,1109,8211,8212,8220,8221,8216,8217,247,8222,1038,1118,1039,1119,8470,1025,1105,1103,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,1101,1102,8364],
    ];
    protected static $classes = [
        'IBM866'         => \MensBeam\Intl\Encoding\IBM866::class,
        'ISO-8859-2'     => \MensBeam\Intl\Encoding\ISO88592::class,
        'ISO-8859-3'     => \MensBeam\Intl\Encoding\ISO88593::class,
        'ISO-8859-4'     => \MensBeam\Intl\Encoding\ISO88594::class,
        'ISO-8859-5'     => \MensBeam\Intl\Encoding\ISO88595::class,
        'ISO-8859-6'     => \MensBeam\Intl\Encoding\ISO88596::class,
        'ISO-8859-7'     => \MensBeam\Intl\Encoding\ISO88597::class,
        'ISO-8859-8'     => \MensBeam\Intl\Encoding\ISO88598::class,
        'ISO-8859-8-I'   => \MensBeam\Intl\Encoding\ISO88598I::class,
        'ISO-8859-10'    => \MensBeam\Intl\Encoding\ISO885910::class,
        'ISO-8859-13'    => \MensBeam\Intl\Encoding\ISO885913::class,
        'ISO-8859-14'    => \MensBeam\Intl\Encoding\ISO885914::class,
        'ISO-8859-15'    => \MensBeam\Intl\Encoding\ISO885915::class,
        'ISO-8859-16'    => \MensBeam\Intl\Encoding\ISO885916::class,
        'KOI8-R'         => \MensBeam\Intl\Encoding\KOI8R::class,
        'KOI8-U'         => \MensBeam\Intl\Encoding\KOI8U::class,
        'macintosh'      => \MensBeam\Intl\Encoding\Macintosh::class,
        'windows-874'    => \MensBeam\Intl\Encoding\Windows874::class,
        'windows-1250'   => \MensBeam\Intl\Encoding\Windows1250::class,
        'windows-1251'   => \MensBeam\Intl\Encoding\Windows1251::class,
        'windows-1252'   => \MensBeam\Intl\Encoding\Windows1252::class,
        'windows-1253'   => \MensBeam\Intl\Encoding\Windows1253::class,
        'windows-1254'   => \MensBeam\Intl\Encoding\Windows1254::class,
        'windows-1255'   => \MensBeam\Intl\Encoding\Windows1255::class,
        'windows-1256'   => \MensBeam\Intl\Encoding\Windows1256::class,
        'windows-1257'   => \MensBeam\Intl\Encoding\Windows1257::class,
        'windows-1258'   => \MensBeam\Intl\Encoding\Windows1258::class,
        'x-mac-cyrillic' => \MensBeam\Intl\Encoding\XMacCyrillic::class,
    ];

    protected $testedClass = SingleByteEncoding::class;
    /* Single-byte encodings don't have complex seeking, so this string is generic */
    protected $seekString = "30 31 32 33 34 35 36";
    protected $seekCodes = [0x30, 0x31, 0x32, 0x33, 0x34, 0x35, 0x36];
    protected $seekOffsets = [0, 1, 2, 3, 4, 5, 6, 7];
    /* This string is supposed to contain an invalid character sequence sandwiched between two null characters; this is different for each single-byte encoding (and many do not have invalid characters) */
    protected $brokenChar = "";

    /**
     * @dataProvider provideCodePoints
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::encode
     */
    public function testEncodeCodePoints(bool $fatal, $input, $exp, string $class = SingleByteEncoding::class) {
        $out = "";
        foreach ($input as $code) {
            $out .= $class::encode($code, $fatal);
        }
        $this->assertSame(bin2hex($exp), bin2hex($out));
    }

    /**
     * @dataProvider provideStrings
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::__construct
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::nextCode
     */
    public function testDecodeMultipleCharactersAsCodePoints(string $input, array $exp, string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testDecodeMultipleCharactersAsCodePoints($input, $exp);
    }

    /**
     * @dataProvider provideStrings
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::__construct
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::nextChar
     */
    public function testDecodeMultipleCharactersAsStrings(string $input, array $exp, string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testDecodeMultipleCharactersAsStrings($input, $exp);
    }

    /**
     * @dataProvider provideStrings
     * @coversNothing
     */
    public function testSTepBackThroughAString(string $input, array $exp, string $class = SingleByteEncoding::class) {
        // this test has no meaning for single-byte encodings
        $this->testedClass = $class;
        return parent::testSTepBackThroughAString($input, $exp);
    }

    /**
     * @dataProvider provideClasses
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::seek
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posChar
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posByte
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::rewind
     */
    public function testSeekThroughAString(string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testSeekThroughAString();
    }

    /**
     * @dataProvider provideClasses
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posChar
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posByte
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::eof
     */
    public function testTraversePastTheEndOfAString(string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testTraversePastTheEndOfAString();
    }

    /**
     * @dataProvider provideClasses
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::peekChar
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posChar
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posByte
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::stateSave
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::stateApply
     */
    public function testPeekAtCharacters(string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testPeekAtCharacters();
    }

    /**
     * @dataProvider provideClasses
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::peekCode
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posChar
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::posByte
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::stateSave
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::stateApply
     */
    public function testPeekAtCodePoints(string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testPeekAtCodePoints();
    }

    /**
     * @dataProvider provideStrings
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::lenChar
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::lenByte
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::stateSave
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::stateApply
     */
    public function testGetStringLength(string $input, array $points, string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testGetStringLength($input, $points);
    }

    /**
     * @dataProvider provideBrokenStrings
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::errDec
     */
    public function testReplacementModes(string $input = "", string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        $this->brokenChar = $input;
        return parent::testReplacementModes();
    }

    /**
     * @dataProvider provideStrings
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::rewind
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::chars
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::codes
     */
    public function testIterateThroughAString(string $input, array $exp, string $class = SingleByteEncoding::class) {
        $this->testedClass = $class;
        return parent::testIterateThroughAString($input, $exp);
    }

    /**
     * @dataProvider provideStrings
     * @coversNothing
     */
    public function testIterateThroughAStringAllowingSurrogates(string $input, array $exp, $class = null) {
        $this->testedClass = $class;
        return parent::testIterateThroughAStringAllowingSurrogates($input, $exp, $exp);
    }


    /**
     * @dataProvider provideClasses
     * @coversNothing
     */
    public function testSeekBackOverRandomData($class =  null) {
        $this->testedClass = $class;
        return parent::testSeekBackOverRandomData();
    }

    public function provideClasses() {
        foreach (self::$classes as $name => $class) {
            yield $name => [$class];
        }
    }

    public function provideInvalids() {
        $exc1 = new EncoderException("", SingleByteEncoding::E_INVALID_CODE_POINT);
        $exc2 = new EncoderException("", SingleByteEncoding::E_UNAVAILABLE_CODE_POINT);
        foreach (self::$classes as $name => $class) {
            yield "$name point < 0 (fatal mode)"         => [$class, true, -1, $exc1];
            yield "$name point > 0x10FFFF (fatal mode)"  => [$class, true, 0x110000, $exc1];
            yield "$name point unavailable (fatal mode)" => [$class, true, 0xFFFD, $exc2];
            yield "$name point < 0 (HTML mode)"          => [$class, false, -1, $exc1];
            yield "$name point > 0x10FFFF (HTML mode)"   => [$class, false, 0x110000, $exc1];
            yield "$name point unavailable (HTML mode)"  => [$class, false, 0xFFFD, "&#65533;"];
        }
    }

    public function provideCodePoints() {
        foreach (self::$classes as $name => $class) {
            $bytes = "";
            $codes = [];
            for ($a = 0; $a < 128; $a++) {
                $bytes .= chr($a);
                $codes[] = $a;
            }
            for ($a = 0; $a < 128; $a++) {
                if (is_null(self::$maps[$name][$a])) {
                    continue;
                }
                $bytes .= chr($a + 128);
                $codes[] = self::$maps[$name][$a];
            }
            yield "$name (fatal)" => [true,  $codes, $bytes, $class];
            yield "$name (HTML)"  => [false, $codes, $bytes, $class];
        }
    }

    public function provideStrings() {
        $bytes = (function() {
            $out = "";
            for ($a = 0; $a < 256; $a++) {
                $out .= bin2hex(chr($a));
            }
            return $out;
        })();
        foreach (self::$classes as $name => $class) {
            $codes = array_merge(range(0, 127), array_map(function($v) {
                return $v ?? 0xFFFD;
            }, self::$maps[$name]));
            yield $name => [$bytes, $codes, $class];
        }
    }

    public function provideBrokenStrings() {
        foreach ($this->provideStrings() as $name => $test) {
            $codes = $test[1];
            $class = $test[2];
            if (($bump = array_search(0xFFFD, $codes, true)) === false) {
                // if the encoding uses all 128 high byte values, this test is non-operative
                yield $name => ["", $class];
            } else {
                $byte = strtoupper(bin2hex(chr($bump)));
                yield $name => ["00 $byte 00", $class];
            }
        }
    }

    /**
     * @dataProvider provideInvalids
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::encode
     * @covers MensBeam\Intl\Encoding\SingleByteEncoding::errEnc
     */
    public function testEncodeInvalidCodePoints(string $class, bool $mode, int $input, $exp) {
        if ($exp instanceof \Throwable) {
            $this->expectException(get_class($exp));
            $this->expectExceptionCode($exp->getCode());
        }
        $out = $class::encode($input, $mode);
        $this->assertSame($exp, $out);
    }
}
