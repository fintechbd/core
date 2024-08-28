<?php

namespace Fintech\Core\Supports;

use InvalidArgumentException;

class Currency
{
    public const AED = 'AED';
    public const AFN = 'AFN';
    public const ALL = 'ALL';
    public const AMD = 'AMD';
    public const ANG = 'ANG';
    public const AOA = 'AOA';
    public const ARS = 'ARS';
    public const AUD = 'AUD';
    public const AWG = 'AWG';
    public const AZN = 'AZN';
    public const BAM = 'BAM';
    public const BBD = 'BBD';
    public const BDT = 'BDT';
    public const BGN = 'BGN';
    public const BHD = 'BHD';
    public const BIF = 'BIF';
    public const BMD = 'BMD';
    public const BND = 'BND';
    public const BOB = 'BOB';
    public const BOV = 'BOV';
    public const BRL = 'BRL';
    public const BSD = 'BSD';
    public const BTN = 'BTN';
    public const BWP = 'BWP';
    public const BYN = 'BYN';
    public const BZD = 'BZD';
    public const CAD = 'CAD';
    public const CDF = 'CDF';
    public const CHF = 'CHF';
    public const CLF = 'CLF';
    public const CLP = 'CLP';
    public const CNY = 'CNY';
    public const COP = 'COP';
    public const CRC = 'CRC';
    public const CUC = 'CUC';
    public const CUP = 'CUP';
    public const CVE = 'CVE';
    public const CZK = 'CZK';
    public const DJF = 'DJF';
    public const DKK = 'DKK';
    public const DOP = 'DOP';
    public const DZD = 'DZD';
    public const EGP = 'EGP';
    public const ERN = 'ERN';
    public const ETB = 'ETB';
    public const EUR = 'EUR';
    public const FJD = 'FJD';
    public const FKP = 'FKP';
    public const GBP = 'GBP';
    public const GEL = 'GEL';
    public const GHS = 'GHS';
    public const GIP = 'GIP';
    public const GMD = 'GMD';
    public const GNF = 'GNF';
    public const GTQ = 'GTQ';
    public const GYD = 'GYD';
    public const HKD = 'HKD';
    public const HNL = 'HNL';
    public const HRK = 'HRK';
    public const HTG = 'HTG';
    public const HUF = 'HUF';
    public const IDR = 'IDR';
    public const ILS = 'ILS';
    public const INR = 'INR';
    public const IQD = 'IQD';
    public const IRR = 'IRR';
    public const ISK = 'ISK';
    public const JMD = 'JMD';
    public const JOD = 'JOD';
    public const JPY = 'JPY';
    public const KES = 'KES';
    public const KGS = 'KGS';
    public const KHR = 'KHR';
    public const KMF = 'KMF';
    public const KPW = 'KPW';
    public const KRW = 'KRW';
    public const KWD = 'KWD';
    public const KYD = 'KYD';
    public const KZT = 'KZT';
    public const LAK = 'LAK';
    public const LBP = 'LBP';
    public const LKR = 'LKR';
    public const LRD = 'LRD';
    public const LSL = 'LSL';
    public const LTL = 'LTL';
    public const LVL = 'LVL';
    public const LYD = 'LYD';
    public const MAD = 'MAD';
    public const MDL = 'MDL';
    public const MGA = 'MGA';
    public const MKD = 'MKD';
    public const MMK = 'MMK';
    public const MNT = 'MNT';
    public const MOP = 'MOP';
    public const MRO = 'MRO';
    public const MUR = 'MUR';
    public const MVR = 'MVR';
    public const MWK = 'MWK';
    public const MXN = 'MXN';
    public const MYR = 'MYR';
    public const MZN = 'MZN';
    public const NAD = 'NAD';
    public const NGN = 'NGN';
    public const NIO = 'NIO';
    public const NOK = 'NOK';
    public const NPR = 'NPR';
    public const NZD = 'NZD';
    public const OMR = 'OMR';
    public const PAB = 'PAB';
    public const PEN = 'PEN';
    public const PGK = 'PGK';
    public const PHP = 'PHP';
    public const PKR = 'PKR';
    public const PLN = 'PLN';
    public const PYG = 'PYG';
    public const QAR = 'QAR';
    public const RON = 'RON';
    public const RSD = 'RSD';
    public const RUB = 'RUB';
    public const RWF = 'RWF';
    public const SAR = 'SAR';
    public const SBD = 'SBD';
    public const SCR = 'SCR';
    public const SDG = 'SDG';
    public const SEK = 'SEK';
    public const SGD = 'SGD';
    public const SHP = 'SHP';
    public const SLL = 'SLL';
    public const SOS = 'SOS';
    public const SRD = 'SRD';
    public const SSP = 'SSP';
    public const STD = 'STD';
    public const SVC = 'SVC';
    public const SYP = 'SYP';
    public const SZL = 'SZL';
    public const THB = 'THB';
    public const TJS = 'TJS';
    public const TMT = 'TMT';
    public const TND = 'TND';
    public const TOP = 'TOP';
    public const TRY = 'TRY';
    public const TTD = 'TTD';
    public const TWD = 'TWD';
    public const TZS = 'TZS';
    public const UAH = 'UAH';
    public const UGX = 'UGX';
    public const USD = 'USD';
    public const UYU = 'UYU';
    public const UZS = 'UZS';
    public const VEF = 'VEF';
    public const VND = 'VND';
    public const VUV = 'VUV';
    public const WST = 'WST';
    public const XAF = 'XAF';
    public const XAG = 'XAG';
    public const XAU = 'XAU';
    public const XCD = 'XCD';
    public const XDR = 'XDR';
    public const XOF = 'XOF';
    public const XPF = 'XPF';
    public const YER = 'YER';
    public const ZAR = 'ZAR';
    public const ZMW = 'ZMW';
    public const ZWL = 'ZWL';
    private static array $items = [
        'AED' => [
            'code' => 'AED',
            'name' => 'UAE Dirham',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'د.إ',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#96b6b3',
        ],
        'AFN' => [
            'code' => 'AFN',
            'name' => 'Afghani',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '؋',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#74bd4e',
        ],
        'ALL' => [
            'code' => 'ALL',
            'name' => 'Lek',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'L',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ed8be3',
        ],
        'AMD' => [
            'code' => 'AMD',
            'name' => 'Armenian Dram',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'դր.',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#843736',
        ],
        'ANG' => [
            'code' => 'ANG',
            'name' => 'Netherlands Antillean Guilder',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ƒ',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#4e8535',
        ],
        'AOA' => [
            'code' => 'AOA',
            'name' => 'Kwanza',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Kz',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#96b6d5',
        ],
        'ARS' => [
            'code' => 'ARS',
            'name' => 'Argentine Peso',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#8f095c',
        ],
        'AUD' => [
            'code' => 'AUD',
            'name' => 'Australian Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ' ',
            'color' => '#1050cc',
        ],
        'AWG' => [
            'code' => 'AWG',
            'name' => 'Aruban Florin',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ƒ',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#54a0bd',
        ],
        'AZN' => [
            'code' => 'AZN',
            'name' => 'Azerbaijanian Manat',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₼',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#da38f1',
        ],
        'BAM' => [
            'code' => 'BAM',
            'name' => 'Convertible Mark',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'КМ',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#1759d1',
        ],
        'BBD' => [
            'code' => 'BBD',
            'name' => 'Barbados Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2e7789',
        ],
        'BDT' => [
            'code' => 'BDT',
            'name' => 'Taka',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '৳',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#91fcb2',
        ],
        'BGN' => [
            'code' => 'BGN',
            'name' => 'Bulgarian Lev',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'лв',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => ' ',
            'color' => '#7e261d',
        ],
        'BHD' => [
            'code' => 'BHD',
            'name' => 'Bahraini Dinar',
            'precision' => 3,
            'subunit' => 1000,
            'symbol' => 'ب.د',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#a3954b',
        ],
        'BIF' => [
            'code' => 'BIF',
            'name' => 'Burundi Franc',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#fad6b5',
        ],
        'BMD' => [
            'code' => 'BMD',
            'name' => 'Bermudian Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#9d109e',
        ],
        'BND' => [
            'code' => 'BND',
            'name' => 'Brunei Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#1bb34f',
        ],
        'BOB' => [
            'code' => 'BOB',
            'name' => 'Boliviano',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Bs.',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#769104',
        ],
        'BOV' => [
            'code' => 'BOV',
            'name' => 'Mvdol',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Bs.',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#3f98e3',
        ],
        'BRL' => [
            'code' => 'BRL',
            'name' => 'Brazilian Real',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'R$',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#397efb',
        ],
        'BSD' => [
            'code' => 'BSD',
            'name' => 'Bahamian Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#873967',
        ],
        'BTN' => [
            'code' => 'BTN',
            'name' => 'Ngultrum',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Nu.',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#1f1b0f',
        ],
        'BWP' => [
            'code' => 'BWP',
            'name' => 'Pula',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'P',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#3a5715',
        ],
        'BYN' => [
            'code' => 'BYN',
            'name' => 'Belarussian Ruble',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Br',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => ' ',
            'color' => '#a2ed13',
        ],
        'BZD' => [
            'code' => 'BZD',
            'name' => 'Belize Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#db98a5',
        ],
        'CAD' => [
            'code' => 'CAD',
            'name' => 'Canadian Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#cc9961',
        ],
        'CDF' => [
            'code' => 'CDF',
            'name' => 'Congolese Franc',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#3cc950',
        ],
        'CHF' => [
            'code' => 'CHF',
            'name' => 'Swiss Franc',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'CHF',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#47217f',
        ],
        'CLF' => [
            'code' => 'CLF',
            'name' => 'Unidades de fomento',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'UF',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#868dbf',
        ],
        'CLP' => [
            'code' => 'CLP',
            'name' => 'Chilean Peso',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#f5b0c3',
        ],
        'CNY' => [
            'code' => 'CNY',
            'name' => 'Yuan Renminbi',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '¥',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#059253',
        ],
        'COP' => [
            'code' => 'COP',
            'name' => 'Colombian Peso',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#864427',
        ],
        'CRC' => [
            'code' => 'CRC',
            'name' => 'Costa Rican Colon',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₡',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#ce19a8',
        ],
        'CUC' => [
            'code' => 'CUC',
            'name' => 'Peso Convertible',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#aa4100',
        ],
        'CUP' => [
            'code' => 'CUP',
            'name' => 'Cuban Peso',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#677c1e',
        ],
        'CVE' => [
            'code' => 'CVE',
            'name' => 'Cape Verde Escudo',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#d62c54',
        ],
        'CZK' => [
            'code' => 'CZK',
            'name' => 'Czech Koruna',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Kč',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#01a0de',
        ],
        'DJF' => [
            'code' => 'DJF',
            'name' => 'Djibouti Franc',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fdj',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#396d89',
        ],
        'DKK' => [
            'code' => 'DKK',
            'name' => 'Danish Krone',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'kr',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#d42966',
        ],
        'DOP' => [
            'code' => 'DOP',
            'name' => 'Dominican Peso',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#e50a78',
        ],
        'DZD' => [
            'code' => 'DZD',
            'name' => 'Algerian Dinar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'د.ج',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#976cb9',
        ],
        'EGP' => [
            'code' => 'EGP',
            'name' => 'Egyptian Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ج.م',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#d585fb',
        ],
        'ERN' => [
            'code' => 'ERN',
            'name' => 'Nakfa',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Nfk',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#373590',
        ],
        'ETB' => [
            'code' => 'ETB',
            'name' => 'Ethiopian Birr',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Br',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#d6d6e0',
        ],
        'EUR' => [
            'code' => 'EUR',
            'name' => 'Euro',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '€',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#432eed',
        ],
        'FJD' => [
            'code' => 'FJD',
            'name' => 'Fiji Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#b683bb',
        ],
        'FKP' => [
            'code' => 'FKP',
            'name' => 'Falkland Islands Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2710b4',
        ],
        'GBP' => [
            'code' => 'GBP',
            'name' => 'Pound Sterling',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#bcc4c3',
        ],
        'GEL' => [
            'code' => 'GEL',
            'name' => 'Lari',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ლ',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#016a42',
        ],
        'GHS' => [
            'code' => 'GHS',
            'name' => 'Ghana Cedi',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₵',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#9090dd',
        ],
        'GIP' => [
            'code' => 'GIP',
            'name' => 'Gibraltar Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#a06b9c',
        ],
        'GMD' => [
            'code' => 'GMD',
            'name' => 'Dalasi',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'D',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#82ac98',
        ],
        'GNF' => [
            'code' => 'GNF',
            'name' => 'Guinea Franc',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#41558e',
        ],
        'GTQ' => [
            'code' => 'GTQ',
            'name' => 'Quetzal',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Q',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#336f18',
        ],
        'GYD' => [
            'code' => 'GYD',
            'name' => 'Guyana Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#0c5980',
        ],
        'HKD' => [
            'code' => 'HKD',
            'name' => 'Hong Kong Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#9f7657',
        ],
        'HNL' => [
            'code' => 'HNL',
            'name' => 'Lempira',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'L',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#fd1950',
        ],
        'HRK' => [
            'code' => 'HRK',
            'name' => 'Croatian Kuna',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'kn',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#e0cf04',
        ],
        'HTG' => [
            'code' => 'HTG',
            'name' => 'Gourde',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'G',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#783183',
        ],
        'HUF' => [
            'code' => 'HUF',
            'name' => 'Forint',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Ft',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#9fa2ea',
        ],
        'IDR' => [
            'code' => 'IDR',
            'name' => 'Rupiah',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Rp',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#2f4441',
        ],
        'ILS' => [
            'code' => 'ILS',
            'name' => 'New Israeli Sheqel',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₪',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ca9b16',
        ],
        'INR' => [
            'code' => 'INR',
            'name' => 'Indian Rupee',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₹',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#350644',
        ],
        'IQD' => [
            'code' => 'IQD',
            'name' => 'Iraqi Dinar',
            'precision' => 3,
            'subunit' => 1000,
            'symbol' => 'ع.د',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#57150f',
        ],
        'IRR' => [
            'code' => 'IRR',
            'name' => 'Iranian Rial',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '﷼',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2e89f7',
        ],
        'ISK' => [
            'code' => 'ISK',
            'name' => 'Iceland Krona',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'kr',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#5ab626',
        ],
        'JMD' => [
            'code' => 'JMD',
            'name' => 'Jamaican Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#1f4260',
        ],
        'JOD' => [
            'code' => 'JOD',
            'name' => 'Jordanian Dinar',
            'precision' => 3,
            'subunit' => 100,
            'symbol' => 'د.ا',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#6a9222',
        ],
        'JPY' => [
            'code' => 'JPY',
            'name' => 'Yen',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => '¥',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#98fda0',
        ],
        'KES' => [
            'code' => 'KES',
            'name' => 'Kenyan Shilling',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'KSh',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#d160d0',
        ],
        'KGS' => [
            'code' => 'KGS',
            'name' => 'Som',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'som',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#b84128',
        ],
        'KHR' => [
            'code' => 'KHR',
            'name' => 'Riel',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '៛',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#000a0e',
        ],
        'KMF' => [
            'code' => 'KMF',
            'name' => 'Comoro Franc',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#af7063',
        ],
        'KPW' => [
            'code' => 'KPW',
            'name' => 'North Korean Won',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₩',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#b76596',
        ],
        'KRW' => [
            'code' => 'KRW',
            'name' => 'Won',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => '₩',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#945b99',
        ],
        'KWD' => [
            'code' => 'KWD',
            'name' => 'Kuwaiti Dinar',
            'precision' => 3,
            'subunit' => 1000,
            'symbol' => 'د.ك',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#09fcb7',
        ],
        'KYD' => [
            'code' => 'KYD',
            'name' => 'Cayman Islands Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ab97ef',
        ],
        'KZT' => [
            'code' => 'KZT',
            'name' => 'Tenge',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '〒',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#09577f',
        ],
        'LAK' => [
            'code' => 'LAK',
            'name' => 'Kip',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₭',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#bee4ed',
        ],
        'LBP' => [
            'code' => 'LBP',
            'name' => 'Lebanese Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ل.ل',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2c2f95',
        ],
        'LKR' => [
            'code' => 'LKR',
            'name' => 'Sri Lanka Rupee',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₨',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#6a8eaf',
        ],
        'LRD' => [
            'code' => 'LRD',
            'name' => 'Liberian Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2b2e61',
        ],
        'LSL' => [
            'code' => 'LSL',
            'name' => 'Loti',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'L',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ffd6ea',
        ],
        'LTL' => [
            'code' => 'LTL',
            'name' => 'Lithuanian Litas',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Lt',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#be5402',
        ],
        'LVL' => [
            'code' => 'LVL',
            'name' => 'Latvian Lats',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Ls',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#a7c459',
        ],
        'LYD' => [
            'code' => 'LYD',
            'name' => 'Libyan Dinar',
            'precision' => 3,
            'subunit' => 1000,
            'symbol' => 'ل.د',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#7e5bbd',
        ],
        'MAD' => [
            'code' => 'MAD',
            'name' => 'Moroccan Dirham',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'د.م.',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ce165c',
        ],
        'MDL' => [
            'code' => 'MDL',
            'name' => 'Moldovan Leu',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'L',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#1cf3b4',
        ],
        'MGA' => [
            'code' => 'MGA',
            'name' => 'Malagasy Ariary',
            'precision' => 2,
            'subunit' => 5,
            'symbol' => 'Ar',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2a5f56',
        ],
        'MKD' => [
            'code' => 'MKD',
            'name' => 'Denar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ден',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ab30f8',
        ],
        'MMK' => [
            'code' => 'MMK',
            'name' => 'Kyat',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'K',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#e31030',
        ],
        'MNT' => [
            'code' => 'MNT',
            'name' => 'Tugrik',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₮',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#feed86',
        ],
        'MOP' => [
            'code' => 'MOP',
            'name' => 'Pataca',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'P',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#b66dcf',
        ],
        'MRO' => [
            'code' => 'MRO',
            'name' => 'Ouguiya',
            'precision' => 2,
            'subunit' => 5,
            'symbol' => 'UM',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#558d54',
        ],
        'MUR' => [
            'code' => 'MUR',
            'name' => 'Mauritius Rupee',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₨',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#fe9c62',
        ],
        'MVR' => [
            'code' => 'MVR',
            'name' => 'Rufiyaa',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'MVR',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#882d16',
        ],
        'MWK' => [
            'code' => 'MWK',
            'name' => 'Kwacha',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'MK',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#b280b4',
        ],
        'MXN' => [
            'code' => 'MXN',
            'name' => 'Mexican Peso',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#aac121',
        ],
        'MYR' => [
            'code' => 'MYR',
            'name' => 'Malaysian Ringgit',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'RM',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#e11fcd',
        ],
        'MZN' => [
            'code' => 'MZN',
            'name' => 'Mozambique Metical',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'MTn',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#22eb46',
        ],
        'NAD' => [
            'code' => 'NAD',
            'name' => 'Namibia Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#83142d',
        ],
        'NGN' => [
            'code' => 'NGN',
            'name' => 'Naira',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₦',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#f7c45e',
        ],
        'NIO' => [
            'code' => 'NIO',
            'name' => 'Cordoba Oro',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'C$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#978452',
        ],
        'NOK' => [
            'code' => 'NOK',
            'name' => 'Norwegian Krone',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'kr',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#39fdae',
        ],
        'NPR' => [
            'code' => 'NPR',
            'name' => 'Nepalese Rupee',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₨',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#819068',
        ],
        'NZD' => [
            'code' => 'NZD',
            'name' => 'New Zealand Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#64d480',
        ],
        'OMR' => [
            'code' => 'OMR',
            'name' => 'Rial Omani',
            'precision' => 3,
            'subunit' => 1000,
            'symbol' => 'ر.ع.',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#9d9edb',
        ],
        'PAB' => [
            'code' => 'PAB',
            'name' => 'Balboa',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'B/.',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#fb8deb',
        ],
        'PEN' => [
            'code' => 'PEN',
            'name' => 'Sol',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'S/',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#cc0e74',
        ],
        'PGK' => [
            'code' => 'PGK',
            'name' => 'Kina',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'K',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#72a2c3',
        ],
        'PHP' => [
            'code' => 'PHP',
            'name' => 'Philippine Peso',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₱',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#32c2e0',
        ],
        'PKR' => [
            'code' => 'PKR',
            'name' => 'Pakistan Rupee',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₨',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#47eb4f',
        ],
        'PLN' => [
            'code' => 'PLN',
            'name' => 'Zloty',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'zł',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => ' ',
            'color' => '#e39aaf',
        ],
        'PYG' => [
            'code' => 'PYG',
            'name' => 'Guarani',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => '₲',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#f38040',
        ],
        'QAR' => [
            'code' => 'QAR',
            'name' => 'Qatari Rial',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ر.ق',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#9a5a55',
        ],
        'RON' => [
            'code' => 'RON',
            'name' => 'New Romanian Leu',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Lei',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#259dd0',
        ],
        'RSD' => [
            'code' => 'RSD',
            'name' => 'Serbian Dinar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'РСД',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#61df23',
        ],
        'RUB' => [
            'code' => 'RUB',
            'name' => 'Russian Ruble',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₽',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#0e466e',
        ],
        'RWF' => [
            'code' => 'RWF',
            'name' => 'Rwanda Franc',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'FRw',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#cbfc3d',
        ],
        'SAR' => [
            'code' => 'SAR',
            'name' => 'Saudi Riyal',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ر.س',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#576ec7',
        ],
        'SBD' => [
            'code' => 'SBD',
            'name' => 'Solomon Islands Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#01baed',
        ],
        'SCR' => [
            'code' => 'SCR',
            'name' => 'Seychelles Rupee',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₨',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#006c5b',
        ],
        'SDG' => [
            'code' => 'SDG',
            'name' => 'Sudanese Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#688bb8',
        ],
        'SEK' => [
            'code' => 'SEK',
            'name' => 'Swedish Krona',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'kr',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => ' ',
            'color' => '#07486c',
        ],
        'SGD' => [
            'code' => 'SGD',
            'name' => 'Singapore Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#4985df',
        ],
        'SHP' => [
            'code' => 'SHP',
            'name' => 'Saint Helena Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2b269e',
        ],
        'SLL' => [
            'code' => 'SLL',
            'name' => 'Leone',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Le',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#7dc211',
        ],
        'SOS' => [
            'code' => 'SOS',
            'name' => 'Somali Shilling',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Sh',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#b5fe2a',
        ],
        'SRD' => [
            'code' => 'SRD',
            'name' => 'Surinam Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#9df3c5',
        ],
        'SSP' => [
            'code' => 'SSP',
            'name' => 'South Sudanese Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#648680',
        ],
        'STD' => [
            'code' => 'STD',
            'name' => 'Dobra',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Db',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#356059',
        ],
        'SVC' => [
            'code' => 'SVC',
            'name' => 'El Salvador Colon',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₡',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2a3588',
        ],
        'SYP' => [
            'code' => 'SYP',
            'name' => 'Syrian Pound',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '£S',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#3eb3bd',
        ],
        'SZL' => [
            'code' => 'SZL',
            'name' => 'Lilangeni',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'E',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#a45728',
        ],
        'THB' => [
            'code' => 'THB',
            'name' => 'Baht',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '฿',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#3035b6',
        ],
        'TJS' => [
            'code' => 'TJS',
            'name' => 'Somoni',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ЅМ',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#ccb61c',
        ],
        'TMT' => [
            'code' => 'TMT',
            'name' => 'Turkmenistan New Manat',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'T',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#4dba4f',
        ],
        'TND' => [
            'code' => 'TND',
            'name' => 'Tunisian Dinar',
            'precision' => 3,
            'subunit' => 1000,
            'symbol' => 'د.ت',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#bd83a1',
        ],
        'TOP' => [
            'code' => 'TOP',
            'name' => 'Pa’anga',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'T$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#39b84d',
        ],
        'TRY' => [
            'code' => 'TRY',
            'name' => 'Turkish Lira',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₺',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#d190cf',
        ],
        'TTD' => [
            'code' => 'TTD',
            'name' => 'Trinidad and Tobago Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#487fb0',
        ],
        'TWD' => [
            'code' => 'TWD',
            'name' => 'New Taiwan Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#4f00a4',
        ],
        'TZS' => [
            'code' => 'TZS',
            'name' => 'Tanzanian Shilling',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Sh',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#5f611e',
        ],
        'UAH' => [
            'code' => 'UAH',
            'name' => 'Hryvnia',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '₴',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#2aef3d',
        ],
        'UGX' => [
            'code' => 'UGX',
            'name' => 'Uganda Shilling',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'USh',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#50cfc9',
        ],
        'USD' => [
            'code' => 'USD',
            'name' => 'US Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#6185ee',
        ],
        'UYU' => [
            'code' => 'UYU',
            'name' => 'Peso Uruguayo',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#43a4e5',
        ],
        'UZS' => [
            'code' => 'UZS',
            'name' => 'Uzbekistan Sum',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'лв',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#8f5f2f',
        ],
        'VEF' => [
            'code' => 'VEF',
            'name' => 'Bolivar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'Bs F',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#f53418',
        ],
        'VND' => [
            'code' => 'VND',
            'name' => 'Dong',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => '₫',
            'symbol_first' => true,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'color' => '#13f8b9',
        ],
        'VUV' => [
            'code' => 'VUV',
            'name' => 'Vatu',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Vt',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#c31700',
        ],
        'WST' => [
            'code' => 'WST',
            'name' => 'Tala',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'T',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#034616',
        ],
        'XAF' => [
            'code' => 'XAF',
            'name' => 'CFA Franc BEAC',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#da5658',
        ],
        'XAG' => [
            'code' => 'XAG',
            'name' => 'Silver',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'oz t',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#6fca73',
        ],
        'XAU' => [
            'code' => 'XAU',
            'name' => 'Gold',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'oz t',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#96ab9c',
        ],
        'XCD' => [
            'code' => 'XCD',
            'name' => 'East Caribbean Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#58a9c8',
        ],
        'XDR' => [
            'code' => 'XDR',
            'name' => 'SDR (Special Drawing Right)',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'SDR',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#403156',
        ],
        'XOF' => [
            'code' => 'XOF',
            'name' => 'CFA Franc BCEAO',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#94d2a4',
        ],
        'XPF' => [
            'code' => 'XPF',
            'name' => 'CFP Franc',
            'precision' => 0,
            'subunit' => 1,
            'symbol' => 'Fr',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#c6c767',
        ],
        'YER' => [
            'code' => 'YER',
            'name' => 'Yemeni Rial',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '﷼',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#8cd260',
        ],
        'ZAR' => [
            'code' => 'ZAR',
            'name' => 'Rand',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'R',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#3e5fec',
        ],
        'ZMW' => [
            'code' => 'ZMW',
            'name' => 'Zambian Kwacha',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'ZK',
            'symbol_first' => false,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#5dfbd7',
        ],
        'ZWL' => [
            'code' => 'ZWL',
            'name' => 'Zimbabwe Dollar',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => '$',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'color' => '#4a6863',
        ],
    ];
    public mixed $input;
    public ?int $amount;
    public ?int $subunit;
    public string $code;
    public array $config;

    /**
     * @param string|float|int|null $amount
     * @param string|null $code
     */
    public function __construct(string|float|int|null $amount = 0.0, string $code = null)
    {
        $this->loadConfig($code);
        $this->loadAmount($amount);
    }

    /**
     * @param string|null $code
     * @return void
     */
    private function loadConfig(string $code = null): void
    {
        if (!self::$items[$code]) {
            throw new InvalidArgumentException("Currency code [$code] is invalid or not present in list.");
        }

        $this->config = self::$items[$code];

    }

    /**
     * @param string|float|int|null $amount
     * @return void
     */
    private function loadAmount(string|float|int|null $amount = 0.0): void
    {
        $this->input = $amount;

        if ($amount == null || strlen($amount) == '') {
            $this->amount = null;
            $this->subunit = null;
            return;
        }

        $thousandsSeparator = $this->config['thousands_separator'];
        $amount = str_replace($thousandsSeparator, '', $amount);

        $decimalSeparator = $this->config['decimal_mark'];
        $values = explode($decimalSeparator, $amount);

        if ($values[0] == '') {
            $this->amount = 0;
        } else {
            $this->amount = (int)filter_var($values[0], FILTER_SANITIZE_NUMBER_INT);
        }

        if (isset($values[1])) {
            $subunit = filter_var($values[1], FILTER_SANITIZE_NUMBER_INT);
            $this->subunit = (int)str_pad($subunit, $this->config['precision'], "0");
        } else {
            $this->subunit = 0;
        }

    }

    /**
     * @param string|float|int|null $amount
     * @param string|null $code
     * @return static
     */
    public static function parse(string|float|int|null $amount, string $code = null): static
    {
        return new static($amount, $code);
    }

    /**
     * get currency attributes using a currency code
     *
     * @param string|null $code
     * @return array|mixed
     */
    public static function config(string $code = null): mixed
    {
        if (!self::$items[$code]) {
            throw new InvalidArgumentException("Currency code [$code] is invalid or not present in list.");
        }

        return self::$items[$code];

    }

    /**
     * verify the code of currency exists in the list
     *
     * @param string|null $code
     * @return bool
     */
    public static function exists(string $code = null): bool
    {
        return isset(self::$items[$code]);
    }

    /**
     * return currency value as currency formatted string
     *
     * @param string|null $code
     * @return string
     */
    public function format(string $code = null): string
    {
        if ($code != null) {
            $this->loadConfig($code);
        }

        return (string)$this;
    }

    /**
     * @return float|null
     */
    public function float(): ?float
    {
        if ($this->amount === null) {
            return null;
        }

        return round(floatval($this->amount . '.' . $this->subunit), $this->config['precision'] ?? 2);

    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->amount === null) {
            return '-';
        }

        $mergedValue = floatval($this->amount . '.' . $this->subunit);

        //@TODO PHP INTL Extension R&D
        //        if (extension_loaded('intl')) {
        //            $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        //            $formatter->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, self::$items[$this->config['code']]['symbol']);
        //            return str_replace([$this->config['code'], 'CA'], "", $formatter->formatCurrency($mergedValue, $this->config['code']));
        //        }

        $money = number_format(
            $mergedValue,
            ($this->config['precision'] ?? 2),
            ($this->config['decimal_mark'] ?? '.'),
            ($this->config['thousands_separator'] ?? ',')
        );

        return "{$this->config['code']} {$money}";

        //        return ($this->config['symbol_first'])
        //            ? "{$this->config['symbol']} {$money}"
        //            : "{$money} {$this->config['symbol']}";
    }
}
