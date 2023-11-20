<?php

namespace Fintech\Core\Supports;

class Currency
{
    private static $items = [
        'AED' => [
            'code' => 'AED',
            'name' => 'UAE Dirham',
            'precision' => 2,
            'subunit' => 100,
            'symbol' => 'د.إ',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
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
        ],
    ];

    private array $current;

    private $amount;

    public function __construct(string $code = 'USD')
    {
        $this->current = $this->get($code);
    }

    /**
     * @param $amount
     * @param string $code
     * @return self
     */
    public function parse($amount, string $code = 'USD'): self
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException("Invalid amount ($amount) cannot be parsed.");
        }

        $this->amount = floatval($amount);

        $this->current = $this->get($code);

        return $this;
    }

    /**
     * return currency format value as array
     * @param string $code
     * @return array
     */
    public function get(string $code): array
    {
        if (!self::$items[$code]) {
            throw new \InvalidArgumentException("Currency code [$code] is invalid or not present in list.");
        }

        return self::$items[$code];
    }

    /**
     * return currency value as currency formatted string
     *
     * @param $amount
     * @param bool $withSymbol
     * @return string
     */
    public function format($amount, bool $withSymbol = false): string
    {
        if ($this->amount == null || $this->amount == '') {
            throw new \InvalidArgumentException("Amount value is missing or empty. Use parse to set first");
        }

        $strAmount = number_format($amount, $this->current['precision'], $this->current['decimal_mark'], $this->current['thousands_separator']);

        if ($withSymbol) {
            return ($this->current['symbol_first'])
                ? $strAmount . $this->current['symbol']
                : $this->current['symbol'] . $strAmount;
        }

        return $strAmount;
    }
}
