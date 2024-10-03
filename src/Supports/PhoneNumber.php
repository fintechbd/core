<?php

namespace Fintech\Core\Supports;

class PhoneNumber
{
    public const CODES = [
        "1" => [["code" => "CA", "name" => "Canada"], ["code" => "US", "name" => "United States"], ["code" => "UM", "name" => "United States Minor Outlying Islands"]],
        "7" => [["code" => "KZ", "name" => "Kazakhstan"], ["code" => "RU", "name" => "Russia"]],
        "20" => [["code" => "EG", "name" => "Egypt"]],
        "27" => [["code" => "ZA", "name" => "South Africa"]],
        "30" => [["code" => "GR", "name" => "Greece"]],
        "31" => [["code" => "NL", "name" => "Netherlands"]],
        "32" => [["code" => "BE", "name" => "Belgium"]],
        "33" => [["code" => "FR", "name" => "France"]],
        "34" => [["code" => "ES", "name" => "Spain"]],
        "36" => [["code" => "HU", "name" => "Hungary"]],
        "39" => [["code" => "IT", "name" => "Italy"]],
        "40" => [["code" => "RO", "name" => "Romania"]],
        "41" => [["code" => "CH", "name" => "Switzerland"]],
        "43" => [["code" => "AT", "name" => "Austria"]],
        "44" => [["code" => "GB", "name" => "United Kingdom"]],
        "45" => [["code" => "DK", "name" => "Denmark"]],
        "46" => [["code" => "SE", "name" => "Sweden"]],
        "47" => [["code" => "NO", "name" => "Norway"], ["code" => "SJ", "name" => "Svalbard And Jan Mayen Islands"]],
        "48" => [["code" => "PL", "name" => "Poland"]],
        "49" => [["code" => "DE", "name" => "Germany"]],
        "51" => [["code" => "PE", "name" => "Peru"]],
        "52" => [["code" => "MX", "name" => "Mexico"]],
        "53" => [["code" => "CU", "name" => "Cuba"]],
        "54" => [["code" => "AR", "name" => "Argentina"]],
        "0055" => [["code" => "BV", "name" => "Bouvet Island"]],
        "55" => [["code" => "BR", "name" => "Brazil"]],
        "56" => [["code" => "CL", "name" => "Chile"]],
        "57" => [["code" => "CO", "name" => "Colombia"]],
        "58" => [["code" => "VE", "name" => "Venezuela"]],
        "60" => [["code" => "MY", "name" => "Malaysia"]],
        "61" => [["code" => "AU", "name" => "Australia"], ["code" => "CX", "name" => "Christmas Island"], ["code" => "CC", "name" => "Cocos (Keeling) Islands"]],
        "62" => [["code" => "ID", "name" => "Indonesia"]],
        "63" => [["code" => "PH", "name" => "Philippines"]],
        "64" => [["code" => "NZ", "name" => "New Zealand"]],
        "65" => [["code" => "SG", "name" => "Singapore"]],
        "66" => [["code" => "TH", "name" => "Thailand"]],
        "81" => [["code" => "JP", "name" => "Japan"]],
        "82" => [["code" => "KR", "name" => "South Korea"]],
        "84" => [["code" => "VN", "name" => "Vietnam"]],
        "86" => [["code" => "CN", "name" => "China"]],
        "90" => [["code" => "TR", "name" => "Turkey"]],
        "91" => [["code" => "IN", "name" => "India"]],
        "92" => [["code" => "PK", "name" => "Pakistan"]],
        "93" => [["code" => "AF", "name" => "Afghanistan"]],
        "94" => [["code" => "LK", "name" => "Sri Lanka"]],
        "95" => [["code" => "MM", "name" => "Myanmar"]],
        "98" => [["code" => "IR", "name" => "Iran"]],
        "211" => [["code" => "SS", "name" => "South Sudan"]],
        "212" => [["code" => "MA", "name" => "Morocco"], ["code" => "EH", "name" => "Western Sahara"]],
        "213" => [["code" => "DZ", "name" => "Algeria"]],
        "216" => [["code" => "TN", "name" => "Tunisia"]],
        "218" => [["code" => "LY", "name" => "Libya"]],
        "220" => [["code" => "GM", "name" => "Gambia The"]],
        "221" => [["code" => "SN", "name" => "Senegal"]],
        "222" => [["code" => "MR", "name" => "Mauritania"]],
        "223" => [["code" => "ML", "name" => "Mali"]],
        "224" => [["code" => "GN", "name" => "Guinea"]],
        "225" => [["code" => "CI", "name" => "Cote D'Ivoire (Ivory Coast)"]],
        "226" => [["code" => "BF", "name" => "Burkina Faso"]],
        "227" => [["code" => "NE", "name" => "Niger"]],
        "228" => [["code" => "TG", "name" => "Togo"]],
        "229" => [["code" => "BJ", "name" => "Benin"]],
        "230" => [["code" => "MU", "name" => "Mauritius"]],
        "231" => [["code" => "LR", "name" => "Liberia"]],
        "232" => [["code" => "SL", "name" => "Sierra Leone"]],
        "233" => [["code" => "GH", "name" => "Ghana"]],
        "234" => [["code" => "NG", "name" => "Nigeria"]],
        "235" => [["code" => "TD", "name" => "Chad"]],
        "236" => [["code" => "CF", "name" => "Central African Republic"]],
        "237" => [["code" => "CM", "name" => "Cameroon"]],
        "238" => [["code" => "CV", "name" => "Cape Verde"]],
        "239" => [["code" => "ST", "name" => "Sao Tome and Principe"]],
        "240" => [["code" => "GQ", "name" => "Equatorial Guinea"]],
        "241" => [["code" => "GA", "name" => "Gabon"]],
        "242" => [["code" => "CG", "name" => "Congo"]],
        "243" => [["code" => "CD", "name" => "Democratic Republic of the Congo"]],
        "244" => [["code" => "AO", "name" => "Angola"]],
        "245" => [["code" => "GW", "name" => "Guinea-Bissau"]],
        "246" => [["code" => "IO", "name" => "British Indian Ocean Territory"]],
        "248" => [["code" => "SC", "name" => "Seychelles"]],
        "249" => [["code" => "SD", "name" => "Sudan"]],
        "250" => [["code" => "RW", "name" => "Rwanda"]],
        "251" => [["code" => "ET", "name" => "Ethiopia"]],
        "252" => [["code" => "SO", "name" => "Somalia"]],
        "253" => [["code" => "DJ", "name" => "Djibouti"]],
        "254" => [["code" => "KE", "name" => "Kenya"]],
        "255" => [["code" => "TZ", "name" => "Tanzania"]],
        "256" => [["code" => "UG", "name" => "Uganda"]],
        "257" => [["code" => "BI", "name" => "Burundi"]],
        "258" => [["code" => "MZ", "name" => "Mozambique"]],
        "260" => [["code" => "ZM", "name" => "Zambia"]],
        "261" => [["code" => "MG", "name" => "Madagascar"]],
        "262" => [["code" => "TF", "name" => "French Southern Territories"], ["code" => "YT", "name" => "Mayotte"], ["code" => "RE", "name" => "Reunion"]],
        "263" => [["code" => "ZW", "name" => "Zimbabwe"]],
        "264" => [["code" => "NA", "name" => "Namibia"]],
        "265" => [["code" => "MW", "name" => "Malawi"]],
        "266" => [["code" => "LS", "name" => "Lesotho"]],
        "267" => [["code" => "BW", "name" => "Botswana"]],
        "268" => [["code" => "SZ", "name" => "Swaziland"]],
        "269" => [["code" => "KM", "name" => "Comoros"]],
        "290" => [["code" => "SH", "name" => "Saint Helena"]],
        "291" => [["code" => "ER", "name" => "Eritrea"]],
        "297" => [["code" => "AW", "name" => "Aruba"]],
        "298" => [["code" => "FO", "name" => "Faroe Islands"]],
        "299" => [["code" => "GL", "name" => "Greenland"]],
        "350" => [["code" => "GI", "name" => "Gibraltar"]],
        "351" => [["code" => "PT", "name" => "Portugal"]],
        "352" => [["code" => "LU", "name" => "Luxembourg"]],
        "353" => [["code" => "IE", "name" => "Ireland"]],
        "354" => [["code" => "IS", "name" => "Iceland"]],
        "355" => [["code" => "AL", "name" => "Albania"]],
        "356" => [["code" => "MT", "name" => "Malta"]],
        "357" => [["code" => "CY", "name" => "Cyprus"]],
        "358" => [["code" => "FI", "name" => "Finland"]],
        "359" => [["code" => "BG", "name" => "Bulgaria"]],
        "370" => [["code" => "LT", "name" => "Lithuania"]],
        "371" => [["code" => "LV", "name" => "Latvia"]],
        "372" => [["code" => "EE", "name" => "Estonia"]],
        "373" => [["code" => "MD", "name" => "Moldova"]],
        "374" => [["code" => "AM", "name" => "Armenia"]],
        "375" => [["code" => "BY", "name" => "Belarus"]],
        "376" => [["code" => "AD", "name" => "Andorra"]],
        "377" => [["code" => "MC", "name" => "Monaco"]],
        "378" => [["code" => "SM", "name" => "San Marino"]],
        "379" => [["code" => "VA", "name" => "Vatican City State (Holy See)"]],
        "380" => [["code" => "UA", "name" => "Ukraine"]],
        "381" => [["code" => "RS", "name" => "Serbia"]],
        "382" => [["code" => "ME", "name" => "Montenegro"]],
        "383" => [["code" => "XK", "name" => "Kosovo"]],
        "385" => [["code" => "HR", "name" => "Croatia"]],
        "386" => [["code" => "SI", "name" => "Slovenia"]],
        "387" => [["code" => "BA", "name" => "Bosnia and Herzegovina"]],
        "389" => [["code" => "MK", "name" => "North Macedonia"]],
        "420" => [["code" => "CZ", "name" => "Czech Republic"]],
        "421" => [["code" => "SK", "name" => "Slovakia"]],
        "423" => [["code" => "LI", "name" => "Liechtenstein"]],
        "500" => [["code" => "FK", "name" => "Falkland Islands"], ["code" => "GS", "name" => "South Georgia"]],
        "501" => [["code" => "BZ", "name" => "Belize"]],
        "502" => [["code" => "GT", "name" => "Guatemala"]],
        "503" => [["code" => "SV", "name" => "El Salvador"]],
        "504" => [["code" => "HN", "name" => "Honduras"]],
        "505" => [["code" => "NI", "name" => "Nicaragua"]],
        "506" => [["code" => "CR", "name" => "Costa Rica"]],
        "507" => [["code" => "PA", "name" => "Panama"]],
        "508" => [["code" => "PM", "name" => "Saint Pierre and Miquelon"]],
        "509" => [["code" => "HT", "name" => "Haiti"]],
        "590" => [["code" => "GP", "name" => "Guadeloupe"], ["code" => "BL", "name" => "Saint-Barthelemy"], ["code" => "MF", "name" => "Saint-Martin (French part)"]],
        "591" => [["code" => "BO", "name" => "Bolivia"]],
        "592" => [["code" => "GY", "name" => "Guyana"]],
        "593" => [["code" => "EC", "name" => "Ecuador"]],
        "594" => [["code" => "GF", "name" => "French Guiana"]],
        "595" => [["code" => "PY", "name" => "Paraguay"]],
        "596" => [["code" => "MQ", "name" => "Martinique"]],
        "597" => [["code" => "SR", "name" => "Suriname"]],
        "598" => [["code" => "UY", "name" => "Uruguay"]],
        "599" => [["code" => "BQ", "name" => "Bonaire, Sint Eustatius and Saba"], ["code" => "CW", "name" => "Cura\u00e7ao"]],
        "670" => [["code" => "TL", "name" => "East Timor"]],
        "672" => [["code" => "AQ", "name" => "Antarctica"], ["code" => "HM", "name" => "Heard Island and McDonald Islands"], ["code" => "NF", "name" => "Norfolk Island"]],
        "673" => [["code" => "BN", "name" => "Brunei"]],
        "674" => [["code" => "NR", "name" => "Nauru"]],
        "675" => [["code" => "PG", "name" => "Papua new Guinea"]],
        "676" => [["code" => "TO", "name" => "Tonga"]],
        "677" => [["code" => "SB", "name" => "Solomon Islands"]],
        "678" => [["code" => "VU", "name" => "Vanuatu"]],
        "679" => [["code" => "FJ", "name" => "Fiji Islands"]],
        "680" => [["code" => "PW", "name" => "Palau"]],
        "681" => [["code" => "WF", "name" => "Wallis And Futuna Islands"]],
        "682" => [["code" => "CK", "name" => "Cook Islands"]],
        "683" => [["code" => "NU", "name" => "Niue"]],
        "685" => [["code" => "WS", "name" => "Samoa"]],
        "686" => [["code" => "KI", "name" => "Kiribati"]],
        "687" => [["code" => "NC", "name" => "New Caledonia"]],
        "688" => [["code" => "TV", "name" => "Tuvalu"]],
        "689" => [["code" => "PF", "name" => "French Polynesia"]],
        "690" => [["code" => "TK", "name" => "Tokelau"]],
        "691" => [["code" => "FM", "name" => "Micronesia"]],
        "692" => [["code" => "MH", "name" => "Marshall Islands"]],
        "850" => [["code" => "KP", "name" => "North Korea"]],
        "852" => [["code" => "HK", "name" => "Hong Kong S.A.R."]],
        "853" => [["code" => "MO", "name" => "Macau S.A.R."]],
        "855" => [["code" => "KH", "name" => "Cambodia"]],
        "856" => [["code" => "LA", "name" => "Laos"]],
        "870" => [["code" => "PN", "name" => "Pitcairn Island"]],
        "880" => [["code" => "BD", "name" => "Bangladesh"]],
        "886" => [["code" => "TW", "name" => "Taiwan"]],
        "960" => [["code" => "MV", "name" => "Maldives"]],
        "961" => [["code" => "LB", "name" => "Lebanon"]],
        "962" => [["code" => "JO", "name" => "Jordan"]],
        "963" => [["code" => "SY", "name" => "Syria"]],
        "964" => [["code" => "IQ", "name" => "Iraq"]],
        "965" => [["code" => "KW", "name" => "Kuwait"]],
        "966" => [["code" => "SA", "name" => "Saudi Arabia"]],
        "967" => [["code" => "YE", "name" => "Yemen"]],
        "968" => [["code" => "OM", "name" => "Oman"]],
        "970" => [["code" => "PS", "name" => "Palestinian Territory Occupied"]],
        "971" => [["code" => "AE", "name" => "United Arab Emirates"]],
        "972" => [["code" => "IL", "name" => "Israel"]],
        "973" => [["code" => "BH", "name" => "Bahrain"]],
        "974" => [["code" => "QA", "name" => "Qatar"]],
        "975" => [["code" => "BT", "name" => "Bhutan"]],
        "976" => [["code" => "MN", "name" => "Mongolia"]],
        "977" => [["code" => "NP", "name" => "Nepal"]],
        "992" => [["code" => "TJ", "name" => "Tajikistan"]],
        "993" => [["code" => "TM", "name" => "Turkmenistan"]],
        "994" => [["code" => "AZ", "name" => "Azerbaijan"]],
        "995" => [["code" => "GE", "name" => "Georgia"]],
        "996" => [["code" => "KG", "name" => "Kyrgyzstan"]],
        "998" => [["code" => "UZ", "name" => "Uzbekistan"]],
        "1242" => [["code" => "BS", "name" => "The Bahamas"]],
        "1246" => [["code" => "BB", "name" => "Barbados"]],
        "1264" => [["code" => "AI", "name" => "Anguilla"]],
        "1268" => [["code" => "AG", "name" => "Antigua And Barbuda"]],
        "1284" => [["code" => "VG", "name" => "Virgin Islands (British)"]],
        "1340" => [["code" => "VI", "name" => "Virgin Islands (US)"]],
        "1345" => [["code" => "KY", "name" => "Cayman Islands"]],
        "1441" => [["code" => "BM", "name" => "Bermuda"]],
        "1473" => [["code" => "GD", "name" => "Grenada"]],
        "1649" => [["code" => "TC", "name" => "Turks And Caicos Islands"]],
        "1664" => [["code" => "MS", "name" => "Montserrat"]],
        "1670" => [["code" => "MP", "name" => "Northern Mariana Islands"]],
        "1671" => [["code" => "GU", "name" => "Guam"]],
        "1684" => [["code" => "AS", "name" => "American Samoa"]],
        "1721" => [["code" => "SX", "name" => "Sint Maarten (Dutch part)"]],
        "1758" => [["code" => "LC", "name" => "Saint Lucia"]],
        "1767" => [["code" => "DM", "name" => "Dominica"]],
        "1784" => [["code" => "VC", "name" => "Saint Vincent And The Grenadines"]],
        "1787" => [["code" => "PR", "name" => "Puerto Rico"]],
        "1939" => [["code" => "PR", "name" => "Puerto Rico"]],
        "1809" => [["code" => "DO", "name" => "Dominican Republic"]],
        "1829" => [["code" => "DO", "name" => "Dominican Republic"]],
        "1868" => [["code" => "TT", "name" => "Trinidad And Tobago"]],
        "1869" => [["code" => "KN", "name" => "Saint Kitts And Nevis"]],
        "1876" => [["code" => "JM", "name" => "Jamaica"]],
        "35818" => [["code" => "AX", "name" => "Aland Islands"]],
        "441481" => [["code" => "GG", "name" => "Guernsey and Alderney"]],
        "441534" => [["code" => "JE", "name" => "Jersey"]],
        "441624" => [["code" => "IM", "name" => "Man (Isle of)"]]
    ];

    public static function detect(string $phoneNumber, bool $onlyFirst = true): array
    {
        $phoneNumber = "+" . str_replace(["+", "-"], "", $phoneNumber);

        $matches = [['code' => '--', 'name' => 'Unknown Phone Number']];

        foreach (self::CODES as $code => $countries) {
            if (preg_match("/^\+{$code}\d+$/iu", $phoneNumber)) {
                $matches = $countries;
                break;
            }
        }

        return $onlyFirst ? array_shift($matches) : $matches;
    }
}
