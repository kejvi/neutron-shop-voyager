<?php

use Illuminate\Database\Seeder;

class NjesiteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('njesite')->delete();
        
        \DB::table('njesite')->insert(array (
            0 => 
            array (
                'id' => 1,
                'city_id' => 1,
                'name' => 'Berat',
            ),
            1 => 
            array (
                'id' => 2,
                'city_id' => 1,
                'name' => 'Velabisht',
            ),
            2 => 
            array (
                'id' => 3,
                'city_id' => 1,
                'name' => 'Otllak',
            ),
            3 => 
            array (
                'id' => 4,
                'city_id' => 1,
                'name' => 'Sinjë',
            ),
            4 => 
            array (
                'id' => 5,
                'city_id' => 1,
                'name' => 'Roshnik',
            ),
            5 => 
            array (
                'id' => 6,
                'city_id' => 2,
                'name' => 'Ura-Vajgurore',
            ),
            6 => 
            array (
                'id' => 7,
                'city_id' => 2,
                'name' => 'Poshnje',
            ),
            7 => 
            array (
                'id' => 8,
                'city_id' => 2,
                'name' => 'Kutalli',
            ),
            8 => 
            array (
                'id' => 9,
                'city_id' => 2,
                'name' => 'Cukalat',
            ),
            9 => 
            array (
                'id' => 10,
                'city_id' => 3,
                'name' => 'Kuçovë',
            ),
            10 => 
            array (
                'id' => 11,
                'city_id' => 3,
                'name' => 'Kozare',
            ),
            11 => 
            array (
                'id' => 12,
                'city_id' => 3,
                'name' => 'Perondi',
            ),
            12 => 
            array (
                'id' => 13,
                'city_id' => 3,
                'name' => 'Lumas',
            ),
            13 => 
            array (
                'id' => 14,
                'city_id' => 4,
                'name' => 'Çorovodë',
            ),
            14 => 
            array (
                'id' => 15,
                'city_id' => 4,
                'name' => 'Qendër Skrapar',
            ),
            15 => 
            array (
                'id' => 16,
                'city_id' => 4,
                'name' => 'Bogovë',
            ),
            16 => 
            array (
                'id' => 17,
                'city_id' => 4,
                'name' => 'Vëndreshë',
            ),
            17 => 
            array (
                'id' => 18,
                'city_id' => 4,
                'name' => 'Çepan',
            ),
            18 => 
            array (
                'id' => 19,
                'city_id' => 4,
                'name' => 'Potom',
            ),
            19 => 
            array (
                'id' => 20,
                'city_id' => 4,
                'name' => 'Leshnje',
            ),
            20 => 
            array (
                'id' => 21,
                'city_id' => 4,
                'name' => 'Gjerbës',
            ),
            21 => 
            array (
                'id' => 22,
                'city_id' => 4,
                'name' => 'Zhepë',
            ),
            22 => 
            array (
                'id' => 23,
                'city_id' => 5,
                'name' => 'Poliçan',
            ),
            23 => 
            array (
                'id' => 24,
                'city_id' => 5,
                'name' => 'Tërpan',
            ),
            24 => 
            array (
                'id' => 25,
                'city_id' => 5,
                'name' => 'Vërtop',
            ),
            25 => 
            array (
                'id' => 26,
                'city_id' => 6,
                'name' => 'Peshkopi',
            ),
            26 => 
            array (
                'id' => 27,
                'city_id' => 6,
                'name' => 'Tomin',
            ),
            27 => 
            array (
                'id' => 28,
                'city_id' => 6,
                'name' => 'Melan',
            ),
            28 => 
            array (
                'id' => 29,
                'city_id' => 6,
                'name' => 'Kastriot',
            ),
            29 => 
            array (
                'id' => 30,
                'city_id' => 6,
                'name' => 'Lurë',
            ),
            30 => 
            array (
                'id' => 31,
                'city_id' => 6,
                'name' => 'Maqellarë',
            ),
            31 => 
            array (
                'id' => 32,
                'city_id' => 6,
                'name' => 'Muhurr',
            ),
            32 => 
            array (
                'id' => 33,
                'city_id' => 6,
                'name' => 'Luzni',
            ),
            33 => 
            array (
                'id' => 34,
                'city_id' => 6,
                'name' => 'Selishtë',
            ),
            34 => 
            array (
                'id' => 35,
                'city_id' => 6,
                'name' => 'Sllovë',
            ),
            35 => 
            array (
                'id' => 36,
                'city_id' => 6,
                'name' => 'Kala e Dodës',
            ),
            36 => 
            array (
                'id' => 37,
                'city_id' => 6,
                'name' => 'Zall - Dardhë',
            ),
            37 => 
            array (
                'id' => 38,
                'city_id' => 6,
                'name' => 'Zall - Reç',
            ),
            38 => 
            array (
                'id' => 39,
                'city_id' => 6,
                'name' => 'Fushë Çidhën',
            ),
            39 => 
            array (
                'id' => 40,
                'city_id' => 6,
                'name' => 'Arras',
            ),
            40 => 
            array (
                'id' => 41,
                'city_id' => 7,
                'name' => 'Bulqizë',
            ),
            41 => 
            array (
                'id' => 42,
                'city_id' => 7,
                'name' => 'Martanesh',
            ),
            42 => 
            array (
                'id' => 43,
                'city_id' => 7,
                'name' => 'Fushë-Bulqizë',
            ),
            43 => 
            array (
                'id' => 44,
                'city_id' => 7,
                'name' => 'Zerqan',
            ),
            44 => 
            array (
                'id' => 45,
                'city_id' => 7,
                'name' => 'Shupenzë',
            ),
            45 => 
            array (
                'id' => 46,
                'city_id' => 7,
                'name' => 'Gjoricë',
            ),
            46 => 
            array (
                'id' => 47,
                'city_id' => 7,
                'name' => 'Ostren',
            ),
            47 => 
            array (
                'id' => 48,
                'city_id' => 7,
                'name' => 'Trebisht',
            ),
            48 => 
            array (
                'id' => 49,
                'city_id' => 8,
                'name' => 'Burrel',
            ),
            49 => 
            array (
                'id' => 50,
                'city_id' => 8,
                'name' => 'Baz',
            ),
            50 => 
            array (
                'id' => 51,
                'city_id' => 8,
                'name' => 'Derjan',
            ),
            51 => 
            array (
                'id' => 52,
                'city_id' => 8,
                'name' => 'Rukaj',
            ),
            52 => 
            array (
                'id' => 53,
                'city_id' => 8,
                'name' => 'Macukull',
            ),
            53 => 
            array (
                'id' => 54,
                'city_id' => 8,
                'name' => 'Komsi',
            ),
            54 => 
            array (
                'id' => 55,
                'city_id' => 8,
                'name' => 'Lis',
            ),
            55 => 
            array (
                'id' => 56,
                'city_id' => 8,
                'name' => 'Ulëz',
            ),
            56 => 
            array (
                'id' => 57,
                'city_id' => 9,
                'name' => 'Klos',
            ),
            57 => 
            array (
                'id' => 58,
                'city_id' => 9,
                'name' => 'Xibër',
            ),
            58 => 
            array (
                'id' => 59,
                'city_id' => 9,
                'name' => 'Suç',
            ),
            59 => 
            array (
                'id' => 60,
                'city_id' => 9,
                'name' => 'Gurrë',
            ),
            60 => 
            array (
                'id' => 61,
                'city_id' => 10,
                'name' => 'Durrës',
            ),
            61 => 
            array (
                'id' => 62,
                'city_id' => 10,
                'name' => 'Sukth',
            ),
            62 => 
            array (
                'id' => 63,
                'city_id' => 10,
                'name' => 'Ishëm',
            ),
            63 => 
            array (
                'id' => 64,
                'city_id' => 10,
                'name' => 'Katundi i Ri',
            ),
            64 => 
            array (
                'id' => 65,
                'city_id' => 10,
                'name' => 'Rrashbull',
            ),
            65 => 
            array (
                'id' => 66,
                'city_id' => 10,
                'name' => 'Manëz',
            ),
            66 => 
            array (
                'id' => 67,
                'city_id' => 11,
                'name' => 'Shijak',
            ),
            67 => 
            array (
                'id' => 68,
                'city_id' => 11,
                'name' => 'Maminas',
            ),
            68 => 
            array (
                'id' => 69,
                'city_id' => 11,
                'name' => 'Xhafzotaj',
            ),
            69 => 
            array (
                'id' => 70,
                'city_id' => 11,
                'name' => 'Gjepalaj',
            ),
            70 => 
            array (
                'id' => 71,
                'city_id' => 12,
                'name' => 'Krujë',
            ),
            71 => 
            array (
                'id' => 72,
                'city_id' => 12,
                'name' => 'Fushë - Krujë',
            ),
            72 => 
            array (
                'id' => 73,
                'city_id' => 12,
                'name' => 'Bubq',
            ),
            73 => 
            array (
                'id' => 74,
                'city_id' => 12,
                'name' => 'Nikël',
            ),
            74 => 
            array (
                'id' => 75,
                'city_id' => 12,
                'name' => 'Thumanë',
            ),
            75 => 
            array (
                'id' => 76,
                'city_id' => 12,
                'name' => 'Cudhi',
            ),
            76 => 
            array (
                'id' => 77,
                'city_id' => 13,
                'name' => 'Elbasan',
            ),
            77 => 
            array (
                'id' => 78,
                'city_id' => 13,
                'name' => 'Labinot - Fushë',
            ),
            78 => 
            array (
                'id' => 79,
                'city_id' => 13,
                'name' => 'Labinot - Mal',
            ),
            79 => 
            array (
                'id' => 80,
                'city_id' => 13,
                'name' => 'Gjinar',
            ),
            80 => 
            array (
                'id' => 81,
                'city_id' => 13,
                'name' => 'Shushicë',
            ),
            81 => 
            array (
                'id' => 82,
                'city_id' => 13,
                'name' => 'Gjergjan',
            ),
            82 => 
            array (
                'id' => 83,
                'city_id' => 13,
                'name' => 'Funar',
            ),
            83 => 
            array (
                'id' => 84,
                'city_id' => 13,
                'name' => 'Shirgjan',
            ),
            84 => 
            array (
                'id' => 85,
                'city_id' => 13,
                'name' => 'Tregan',
            ),
            85 => 
            array (
                'id' => 86,
                'city_id' => 13,
                'name' => 'Gracen',
            ),
            86 => 
            array (
                'id' => 87,
                'city_id' => 13,
                'name' => 'Bradashesh',
            ),
            87 => 
            array (
                'id' => 88,
                'city_id' => 13,
                'name' => 'Zavalinë',
            ),
            88 => 
            array (
                'id' => 89,
                'city_id' => 13,
                'name' => 'Papër',
            ),
            89 => 
            array (
                'id' => 90,
                'city_id' => 14,
                'name' => 'Cërrik',
            ),
            90 => 
            array (
                'id' => 91,
                'city_id' => 14,
                'name' => 'Gostimë',
            ),
            91 => 
            array (
                'id' => 92,
                'city_id' => 14,
                'name' => 'Mollas',
            ),
            92 => 
            array (
                'id' => 93,
                'city_id' => 14,
                'name' => 'Shalës',
            ),
            93 => 
            array (
                'id' => 94,
                'city_id' => 14,
                'name' => 'Klos',
            ),
            94 => 
            array (
                'id' => 95,
                'city_id' => 15,
                'name' => 'Belsh',
            ),
            95 => 
            array (
                'id' => 96,
                'city_id' => 15,
                'name' => 'Grekan',
            ),
            96 => 
            array (
                'id' => 97,
                'city_id' => 15,
                'name' => 'Kajan',
            ),
            97 => 
            array (
                'id' => 98,
                'city_id' => 15,
                'name' => 'Fierzë',
            ),
            98 => 
            array (
                'id' => 99,
                'city_id' => 15,
                'name' => 'Rrasë',
            ),
            99 => 
            array (
                'id' => 100,
                'city_id' => 16,
                'name' => 'Peqin',
            ),
            100 => 
            array (
                'id' => 101,
                'city_id' => 16,
                'name' => 'Pajovë',
            ),
            101 => 
            array (
                'id' => 102,
                'city_id' => 16,
                'name' => 'Karinë',
            ),
            102 => 
            array (
                'id' => 103,
                'city_id' => 16,
                'name' => 'Përparim',
            ),
            103 => 
            array (
                'id' => 104,
                'city_id' => 16,
                'name' => 'Gjocaj',
            ),
            104 => 
            array (
                'id' => 105,
                'city_id' => 16,
                'name' => 'Shezë',
            ),
            105 => 
            array (
                'id' => 106,
                'city_id' => 17,
                'name' => 'Gramsh',
            ),
            106 => 
            array (
                'id' => 107,
                'city_id' => 17,
                'name' => 'Pishaj',
            ),
            107 => 
            array (
                'id' => 108,
                'city_id' => 17,
                'name' => 'Kodovjat',
            ),
            108 => 
            array (
                'id' => 109,
                'city_id' => 17,
                'name' => 'Kukur',
            ),
            109 => 
            array (
                'id' => 110,
                'city_id' => 17,
                'name' => 'Kushovë',
            ),
            110 => 
            array (
                'id' => 111,
                'city_id' => 17,
                'name' => 'Lenie',
            ),
            111 => 
            array (
                'id' => 112,
                'city_id' => 17,
                'name' => 'Poroçan',
            ),
            112 => 
            array (
                'id' => 113,
                'city_id' => 17,
                'name' => 'Skënderbegas',
            ),
            113 => 
            array (
                'id' => 114,
                'city_id' => 17,
                'name' => 'Sult',
            ),
            114 => 
            array (
                'id' => 115,
                'city_id' => 17,
                'name' => 'Tunjë',
            ),
            115 => 
            array (
                'id' => 116,
                'city_id' => 18,
                'name' => 'Librazhd',
            ),
            116 => 
            array (
                'id' => 117,
                'city_id' => 18,
                'name' => 'Qendër Librazhd',
            ),
            117 => 
            array (
                'id' => 118,
                'city_id' => 18,
                'name' => 'Hotolisht',
            ),
            118 => 
            array (
                'id' => 119,
                'city_id' => 18,
                'name' => 'Lunik',
            ),
            119 => 
            array (
                'id' => 120,
                'city_id' => 18,
                'name' => 'Stëblevë',
            ),
            120 => 
            array (
                'id' => 121,
                'city_id' => 18,
                'name' => 'Polis',
            ),
            121 => 
            array (
                'id' => 122,
                'city_id' => 18,
                'name' => 'Orenjë',
            ),
            122 => 
            array (
                'id' => 123,
                'city_id' => 19,
                'name' => 'Prrenjas',
            ),
            123 => 
            array (
                'id' => 124,
                'city_id' => 19,
                'name' => 'Qukës',
            ),
            124 => 
            array (
                'id' => 125,
                'city_id' => 19,
                'name' => 'Rrajcë',
            ),
            125 => 
            array (
                'id' => 126,
                'city_id' => 19,
                'name' => 'Stravaj',
            ),
            126 => 
            array (
                'id' => 127,
                'city_id' => 20,
                'name' => 'Fier',
            ),
            127 => 
            array (
                'id' => 128,
                'city_id' => 20,
                'name' => 'Cakran',
            ),
            128 => 
            array (
                'id' => 129,
                'city_id' => 20,
                'name' => 'Mbrostar Ura',
            ),
            129 => 
            array (
                'id' => 130,
                'city_id' => 20,
                'name' => 'Libofshë',
            ),
            130 => 
            array (
                'id' => 131,
                'city_id' => 20,
                'name' => 'Qendër',
            ),
            131 => 
            array (
                'id' => 132,
                'city_id' => 20,
                'name' => 'Dërmenas',
            ),
            132 => 
            array (
                'id' => 133,
                'city_id' => 20,
                'name' => 'Topojë',
            ),
            133 => 
            array (
                'id' => 134,
                'city_id' => 20,
                'name' => 'Levan',
            ),
            134 => 
            array (
                'id' => 135,
                'city_id' => 20,
                'name' => 'Frakull',
            ),
            135 => 
            array (
                'id' => 136,
                'city_id' => 20,
                'name' => 'Portëz',
            ),
            136 => 
            array (
                'id' => 137,
                'city_id' => 21,
                'name' => 'Patos',
            ),
            137 => 
            array (
                'id' => 138,
                'city_id' => 21,
                'name' => 'Zharëz',
            ),
            138 => 
            array (
                'id' => 139,
                'city_id' => 21,
                'name' => 'Ruzhdie',
            ),
            139 => 
            array (
                'id' => 140,
                'city_id' => 22,
                'name' => 'Roskovec',
            ),
            140 => 
            array (
                'id' => 141,
                'city_id' => 22,
                'name' => 'Kuman',
            ),
            141 => 
            array (
                'id' => 142,
                'city_id' => 22,
                'name' => 'Kurjan',
            ),
            142 => 
            array (
                'id' => 143,
                'city_id' => 22,
                'name' => 'Strum',
            ),
            143 => 
            array (
                'id' => 144,
                'city_id' => 23,
                'name' => 'Lushnje',
            ),
            144 => 
            array (
                'id' => 145,
                'city_id' => 23,
                'name' => 'Allkaj',
            ),
            145 => 
            array (
                'id' => 146,
                'city_id' => 23,
                'name' => 'Bubullimë',
            ),
            146 => 
            array (
                'id' => 147,
                'city_id' => 23,
                'name' => 'Hysgjokaj',
            ),
            147 => 
            array (
                'id' => 148,
                'city_id' => 23,
                'name' => 'Golem',
            ),
            148 => 
            array (
                'id' => 149,
                'city_id' => 23,
                'name' => 'Dushk',
            ),
            149 => 
            array (
                'id' => 150,
                'city_id' => 23,
                'name' => 'Karbunarë',
            ),
            150 => 
            array (
                'id' => 151,
                'city_id' => 23,
                'name' => 'Ballagat',
            ),
            151 => 
            array (
                'id' => 152,
                'city_id' => 23,
                'name' => 'Fier Shegan',
            ),
            152 => 
            array (
                'id' => 153,
                'city_id' => 23,
                'name' => 'Kolonjë',
            ),
            153 => 
            array (
                'id' => 154,
                'city_id' => 23,
                'name' => 'Krutje',
            ),
            154 => 
            array (
                'id' => 155,
                'city_id' => 24,
                'name' => 'Divjakë',
            ),
            155 => 
            array (
                'id' => 156,
                'city_id' => 24,
                'name' => 'Tërbuf',
            ),
            156 => 
            array (
                'id' => 157,
                'city_id' => 24,
                'name' => 'Grabjan',
            ),
            157 => 
            array (
                'id' => 158,
                'city_id' => 24,
                'name' => 'Gradishtë',
            ),
            158 => 
            array (
                'id' => 159,
                'city_id' => 24,
                'name' => 'Remas',
            ),
            159 => 
            array (
                'id' => 160,
                'city_id' => 25,
                'name' => 'Ballsh',
            ),
            160 => 
            array (
                'id' => 161,
                'city_id' => 25,
                'name' => 'Qendër Dukas',
            ),
            161 => 
            array (
                'id' => 162,
                'city_id' => 25,
                'name' => 'Greshicë',
            ),
            162 => 
            array (
                'id' => 163,
                'city_id' => 25,
                'name' => 'Aranitas',
            ),
            163 => 
            array (
                'id' => 164,
                'city_id' => 25,
                'name' => 'Hekal',
            ),
            164 => 
            array (
                'id' => 165,
                'city_id' => 25,
                'name' => 'Ngraçan',
            ),
            165 => 
            array (
                'id' => 166,
                'city_id' => 25,
                'name' => 'Kutë',
            ),
            166 => 
            array (
                'id' => 167,
                'city_id' => 25,
                'name' => 'Fratar',
            ),
            167 => 
            array (
                'id' => 168,
                'city_id' => 25,
                'name' => 'Selitë',
            ),
            168 => 
            array (
                'id' => 169,
                'city_id' => 26,
                'name' => 'Gjirokastër',
            ),
            169 => 
            array (
                'id' => 170,
                'city_id' => 26,
                'name' => 'Cepo',
            ),
            170 => 
            array (
                'id' => 171,
                'city_id' => 26,
                'name' => 'Lazarat',
            ),
            171 => 
            array (
                'id' => 172,
                'city_id' => 26,
                'name' => 'Picar',
            ),
            172 => 
            array (
                'id' => 173,
                'city_id' => 26,
                'name' => 'Lunxhëri',
            ),
            173 => 
            array (
                'id' => 174,
                'city_id' => 26,
                'name' => 'Odrie',
            ),
            174 => 
            array (
                'id' => 175,
                'city_id' => 26,
                'name' => 'Antigonë',
            ),
            175 => 
            array (
                'id' => 176,
                'city_id' => 27,
                'name' => 'Libohovë',
            ),
            176 => 
            array (
                'id' => 177,
                'city_id' => 27,
                'name' => 'Qendër Libohovë',
            ),
            177 => 
            array (
                'id' => 178,
                'city_id' => 27,
                'name' => 'Zagorie',
            ),
            178 => 
            array (
                'id' => 179,
                'city_id' => 28,
                'name' => 'Tepelenë',
            ),
            179 => 
            array (
                'id' => 180,
                'city_id' => 28,
                'name' => 'Qendër Tepelenë',
            ),
            180 => 
            array (
                'id' => 181,
                'city_id' => 28,
                'name' => 'Lopës',
            ),
            181 => 
            array (
                'id' => 182,
                'city_id' => 28,
                'name' => 'Kurvelesh',
            ),
            182 => 
            array (
                'id' => 183,
                'city_id' => 29,
                'name' => 'Memaliaj',
            ),
            183 => 
            array (
                'id' => 184,
                'city_id' => 29,
                'name' => 'Memaliaj Fshat',
            ),
            184 => 
            array (
                'id' => 185,
                'city_id' => 29,
                'name' => 'Luftinjë',
            ),
            185 => 
            array (
                'id' => 186,
                'city_id' => 29,
                'name' => 'Buz',
            ),
            186 => 
            array (
                'id' => 187,
                'city_id' => 29,
                'name' => 'Krahës',
            ),
            187 => 
            array (
                'id' => 188,
                'city_id' => 29,
                'name' => 'Qesarat',
            ),
            188 => 
            array (
                'id' => 189,
                'city_id' => 30,
                'name' => 'Përmet',
            ),
            189 => 
            array (
                'id' => 190,
                'city_id' => 30,
                'name' => 'Çarçovë',
            ),
            190 => 
            array (
                'id' => 191,
                'city_id' => 30,
                'name' => 'Frashër',
            ),
            191 => 
            array (
                'id' => 192,
                'city_id' => 30,
                'name' => 'Petran',
            ),
            192 => 
            array (
                'id' => 193,
                'city_id' => 30,
                'name' => 'Qendër Piskovë',
            ),
            193 => 
            array (
                'id' => 194,
                'city_id' => 31,
                'name' => 'Këlcyrë',
            ),
            194 => 
            array (
                'id' => 195,
                'city_id' => 31,
                'name' => 'Ballaban',
            ),
            195 => 
            array (
                'id' => 196,
                'city_id' => 31,
                'name' => 'Sukë',
            ),
            196 => 
            array (
                'id' => 197,
                'city_id' => 31,
                'name' => 'Dëshnicë',
            ),
            197 => 
            array (
                'id' => 198,
                'city_id' => 32,
                'name' => 'Dropull',
            ),
            198 => 
            array (
                'id' => 199,
                'city_id' => 32,
                'name' => 'Dropull i Poshtëm',
            ),
            199 => 
            array (
                'id' => 200,
                'city_id' => 32,
                'name' => 'Dropull i Sipërm',
            ),
            200 => 
            array (
                'id' => 201,
                'city_id' => 32,
                'name' => 'Pogon',
            ),
            201 => 
            array (
                'id' => 202,
                'city_id' => 33,
                'name' => 'Korçë',
            ),
            202 => 
            array (
                'id' => 203,
                'city_id' => 33,
                'name' => 'Qendër Bulgarec',
            ),
            203 => 
            array (
                'id' => 204,
                'city_id' => 33,
                'name' => 'Voskop',
            ),
            204 => 
            array (
                'id' => 205,
                'city_id' => 33,
                'name' => 'Voskopojë',
            ),
            205 => 
            array (
                'id' => 206,
                'city_id' => 33,
                'name' => 'Lekas',
            ),
            206 => 
            array (
                'id' => 207,
                'city_id' => 33,
                'name' => 'Vithkuq',
            ),
            207 => 
            array (
                'id' => 208,
                'city_id' => 33,
                'name' => 'Mollaj',
            ),
            208 => 
            array (
                'id' => 209,
                'city_id' => 33,
                'name' => 'Drenovë',
            ),
            209 => 
            array (
                'id' => 210,
                'city_id' => 34,
                'name' => 'Maliq',
            ),
            210 => 
            array (
                'id' => 211,
                'city_id' => 34,
                'name' => 'Libonik',
            ),
            211 => 
            array (
                'id' => 212,
                'city_id' => 34,
                'name' => 'Gorë',
            ),
            212 => 
            array (
                'id' => 213,
                'city_id' => 34,
                'name' => 'Moglicë',
            ),
            213 => 
            array (
                'id' => 214,
                'city_id' => 34,
                'name' => 'Vreshtas',
            ),
            214 => 
            array (
                'id' => 215,
                'city_id' => 34,
                'name' => 'Pirg',
            ),
            215 => 
            array (
                'id' => 216,
                'city_id' => 34,
                'name' => 'Pojan',
            ),
            216 => 
            array (
                'id' => 217,
                'city_id' => 35,
                'name' => 'Pustec',
            ),
            217 => 
            array (
                'id' => 218,
                'city_id' => 36,
                'name' => 'Ersekë',
            ),
            218 => 
            array (
                'id' => 219,
                'city_id' => 36,
                'name' => 'Qendër Ersekë',
            ),
            219 => 
            array (
                'id' => 220,
                'city_id' => 36,
                'name' => 'Leskovik',
            ),
            220 => 
            array (
                'id' => 221,
                'city_id' => 36,
                'name' => 'Qendër Leskovik',
            ),
            221 => 
            array (
                'id' => 222,
                'city_id' => 36,
                'name' => 'Novoselë',
            ),
            222 => 
            array (
                'id' => 223,
                'city_id' => 36,
                'name' => 'Barmash',
            ),
            223 => 
            array (
                'id' => 224,
                'city_id' => 36,
                'name' => 'Mollas',
            ),
            224 => 
            array (
                'id' => 225,
                'city_id' => 36,
                'name' => 'Çlirim',
            ),
            225 => 
            array (
                'id' => 226,
                'city_id' => 37,
                'name' => 'Bilisht',
            ),
            226 => 
            array (
                'id' => 227,
                'city_id' => 37,
                'name' => 'Qendër Bilisht',
            ),
            227 => 
            array (
                'id' => 228,
                'city_id' => 37,
                'name' => 'Hoçisht',
            ),
            228 => 
            array (
                'id' => 229,
                'city_id' => 37,
                'name' => 'Progër',
            ),
            229 => 
            array (
                'id' => 230,
                'city_id' => 37,
                'name' => 'Miras',
            ),
            230 => 
            array (
                'id' => 231,
                'city_id' => 38,
                'name' => 'Pogradec',
            ),
            231 => 
            array (
                'id' => 232,
                'city_id' => 38,
                'name' => 'Udenisht',
            ),
            232 => 
            array (
                'id' => 233,
                'city_id' => 38,
                'name' => 'Buçimas',
            ),
            233 => 
            array (
                'id' => 234,
                'city_id' => 38,
                'name' => 'Çërravë',
            ),
            234 => 
            array (
                'id' => 235,
                'city_id' => 38,
                'name' => 'Dardhas',
            ),
            235 => 
            array (
                'id' => 236,
                'city_id' => 38,
                'name' => 'Trebinjë',
            ),
            236 => 
            array (
                'id' => 237,
                'city_id' => 38,
                'name' => 'Proptisht',
            ),
            237 => 
            array (
                'id' => 238,
                'city_id' => 38,
                'name' => 'Velçan',
            ),
            238 => 
            array (
                'id' => 239,
                'city_id' => 39,
                'name' => 'Kukës',
            ),
            239 => 
            array (
                'id' => 240,
                'city_id' => 39,
                'name' => 'Malzi',
            ),
            240 => 
            array (
                'id' => 241,
                'city_id' => 39,
                'name' => 'Bicaj',
            ),
            241 => 
            array (
                'id' => 242,
                'city_id' => 39,
                'name' => 'Ujmisht',
            ),
            242 => 
            array (
                'id' => 243,
                'city_id' => 39,
                'name' => 'Tërthore',
            ),
            243 => 
            array (
                'id' => 244,
                'city_id' => 39,
                'name' => 'Shtiqën',
            ),
            244 => 
            array (
                'id' => 245,
                'city_id' => 39,
                'name' => 'Zapod',
            ),
            245 => 
            array (
                'id' => 246,
                'city_id' => 39,
                'name' => 'Shishtavec',
            ),
            246 => 
            array (
                'id' => 247,
                'city_id' => 39,
                'name' => 'Topojan',
            ),
            247 => 
            array (
                'id' => 248,
                'city_id' => 39,
                'name' => 'Bushtricë',
            ),
            248 => 
            array (
                'id' => 249,
                'city_id' => 39,
                'name' => 'Gryk-Çajë',
            ),
            249 => 
            array (
                'id' => 250,
                'city_id' => 39,
                'name' => 'Kalis',
            ),
            250 => 
            array (
                'id' => 251,
                'city_id' => 39,
                'name' => 'Surroj',
            ),
            251 => 
            array (
                'id' => 252,
                'city_id' => 39,
                'name' => 'Arrën',
            ),
            252 => 
            array (
                'id' => 253,
                'city_id' => 39,
                'name' => 'Kolsh',
            ),
            253 => 
            array (
                'id' => 254,
                'city_id' => 40,
                'name' => 'Krumë',
            ),
            254 => 
            array (
                'id' => 255,
                'city_id' => 40,
                'name' => 'Fajza',
            ),
            255 => 
            array (
                'id' => 256,
                'city_id' => 40,
                'name' => 'Gjinaj',
            ),
            256 => 
            array (
                'id' => 257,
                'city_id' => 40,
                'name' => 'Golaj',
            ),
            257 => 
            array (
                'id' => 258,
                'city_id' => 41,
                'name' => 'Bajram Curri',
            ),
            258 => 
            array (
                'id' => 259,
                'city_id' => 41,
                'name' => 'Fierzë',
            ),
            259 => 
            array (
                'id' => 260,
                'city_id' => 41,
                'name' => 'Lekbibaj',
            ),
            260 => 
            array (
                'id' => 261,
                'city_id' => 41,
                'name' => 'Margegaj',
            ),
            261 => 
            array (
                'id' => 262,
                'city_id' => 41,
                'name' => 'Llugaj',
            ),
            262 => 
            array (
                'id' => 263,
                'city_id' => 41,
                'name' => 'Bujan',
            ),
            263 => 
            array (
                'id' => 264,
                'city_id' => 41,
                'name' => 'Bytyç',
            ),
            264 => 
            array (
                'id' => 265,
                'city_id' => 41,
                'name' => 'Tropojë',
            ),
            265 => 
            array (
                'id' => 266,
                'city_id' => 42,
                'name' => 'Lezhë',
            ),
            266 => 
            array (
                'id' => 267,
                'city_id' => 42,
                'name' => 'Shëngjin',
            ),
            267 => 
            array (
                'id' => 268,
                'city_id' => 42,
                'name' => 'Zejmen',
            ),
            268 => 
            array (
                'id' => 269,
                'city_id' => 42,
                'name' => 'Shënkoll',
            ),
            269 => 
            array (
                'id' => 270,
                'city_id' => 42,
                'name' => 'Balldren',
            ),
            270 => 
            array (
                'id' => 271,
                'city_id' => 42,
                'name' => 'Kallmet',
            ),
            271 => 
            array (
                'id' => 272,
                'city_id' => 42,
                'name' => 'Blinisht',
            ),
            272 => 
            array (
                'id' => 273,
                'city_id' => 42,
                'name' => 'Dajç',
            ),
            273 => 
            array (
                'id' => 274,
                'city_id' => 42,
                'name' => 'Ungrej',
            ),
            274 => 
            array (
                'id' => 275,
                'city_id' => 42,
                'name' => 'Kolsh',
            ),
            275 => 
            array (
                'id' => 276,
                'city_id' => 43,
                'name' => 'Rrëshen',
            ),
            276 => 
            array (
                'id' => 277,
                'city_id' => 43,
                'name' => 'Rubik',
            ),
            277 => 
            array (
                'id' => 278,
                'city_id' => 43,
                'name' => 'Selitë',
            ),
            278 => 
            array (
                'id' => 279,
                'city_id' => 43,
                'name' => 'Kthellë',
            ),
            279 => 
            array (
                'id' => 280,
                'city_id' => 43,
                'name' => 'Fan',
            ),
            280 => 
            array (
                'id' => 281,
                'city_id' => 43,
                'name' => 'Orosh',
            ),
            281 => 
            array (
                'id' => 282,
                'city_id' => 43,
                'name' => 'Kaçinar',
            ),
            282 => 
            array (
                'id' => 283,
                'city_id' => 44,
                'name' => 'Laç',
            ),
            283 => 
            array (
                'id' => 284,
                'city_id' => 44,
                'name' => 'Mamurras',
            ),
            284 => 
            array (
                'id' => 285,
                'city_id' => 44,
                'name' => 'Milot',
            ),
            285 => 
            array (
                'id' => 286,
                'city_id' => 44,
                'name' => 'Fushë-Kuqe',
            ),
            286 => 
            array (
                'id' => 287,
                'city_id' => 45,
                'name' => 'Koplik',
            ),
            287 => 
            array (
                'id' => 288,
                'city_id' => 45,
                'name' => 'Gruemirë',
            ),
            288 => 
            array (
                'id' => 289,
                'city_id' => 45,
                'name' => 'Kastrat',
            ),
            289 => 
            array (
                'id' => 290,
                'city_id' => 45,
                'name' => 'Kelmend',
            ),
            290 => 
            array (
                'id' => 291,
                'city_id' => 45,
                'name' => 'Qendër',
            ),
            291 => 
            array (
                'id' => 292,
                'city_id' => 45,
                'name' => 'Shkrel',
            ),
            292 => 
            array (
                'id' => 293,
                'city_id' => 46,
                'name' => 'Shkodër',
            ),
            293 => 
            array (
                'id' => 294,
                'city_id' => 46,
                'name' => 'Ana e Malit',
            ),
            294 => 
            array (
                'id' => 295,
                'city_id' => 46,
                'name' => 'Bërdicë',
            ),
            295 => 
            array (
                'id' => 296,
                'city_id' => 46,
                'name' => 'Dajç',
            ),
            296 => 
            array (
                'id' => 297,
                'city_id' => 46,
                'name' => 'Guri i Zi',
            ),
            297 => 
            array (
                'id' => 298,
                'city_id' => 46,
                'name' => 'Postribë',
            ),
            298 => 
            array (
                'id' => 299,
                'city_id' => 46,
                'name' => 'Pult',
            ),
            299 => 
            array (
                'id' => 300,
                'city_id' => 46,
                'name' => 'Rrethinat',
            ),
            300 => 
            array (
                'id' => 301,
                'city_id' => 46,
                'name' => 'Shalë',
            ),
            301 => 
            array (
                'id' => 302,
                'city_id' => 46,
                'name' => 'Shosh',
            ),
            302 => 
            array (
                'id' => 303,
                'city_id' => 46,
                'name' => 'Velipojë',
            ),
            303 => 
            array (
                'id' => 304,
                'city_id' => 47,
                'name' => 'Vau - Dejës',
            ),
            304 => 
            array (
                'id' => 305,
                'city_id' => 47,
                'name' => 'Bushat',
            ),
            305 => 
            array (
                'id' => 306,
                'city_id' => 47,
                'name' => 'Vig - Mnelë',
            ),
            306 => 
            array (
                'id' => 307,
                'city_id' => 47,
                'name' => 'Hajmel',
            ),
            307 => 
            array (
                'id' => 308,
                'city_id' => 47,
                'name' => 'Temal',
            ),
            308 => 
            array (
                'id' => 309,
                'city_id' => 47,
                'name' => 'Shllak',
            ),
            309 => 
            array (
                'id' => 310,
                'city_id' => 48,
                'name' => 'Pukë',
            ),
            310 => 
            array (
                'id' => 311,
                'city_id' => 48,
                'name' => 'Gjegjan',
            ),
            311 => 
            array (
                'id' => 312,
                'city_id' => 48,
                'name' => 'Rrapë',
            ),
            312 => 
            array (
                'id' => 313,
                'city_id' => 48,
                'name' => 'Qelëz',
            ),
            313 => 
            array (
                'id' => 314,
                'city_id' => 48,
                'name' => 'Qerret',
            ),
            314 => 
            array (
                'id' => 315,
                'city_id' => 49,
                'name' => 'Fushë - Arrëz',
            ),
            315 => 
            array (
                'id' => 316,
                'city_id' => 49,
                'name' => 'Fierzë',
            ),
            316 => 
            array (
                'id' => 317,
                'city_id' => 49,
                'name' => 'Blerim',
            ),
            317 => 
            array (
                'id' => 318,
                'city_id' => 49,
                'name' => 'Qafë - Mali',
            ),
            318 => 
            array (
                'id' => 319,
                'city_id' => 49,
                'name' => 'Iballë',
            ),
            319 => 
            array (
                'id' => 320,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.1',
            ),
            320 => 
            array (
                'id' => 321,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.2',
            ),
            321 => 
            array (
                'id' => 322,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.3',
            ),
            322 => 
            array (
                'id' => 323,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.4',
            ),
            323 => 
            array (
                'id' => 324,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.5',
            ),
            324 => 
            array (
                'id' => 325,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.6',
            ),
            325 => 
            array (
                'id' => 326,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.7',
            ),
            326 => 
            array (
                'id' => 327,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.8',
            ),
            327 => 
            array (
                'id' => 328,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.9',
            ),
            328 => 
            array (
                'id' => 329,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.10',
            ),
            329 => 
            array (
                'id' => 330,
                'city_id' => 50,
                'name' => 'Nj. Adm. Nr.11',
            ),
            330 => 
            array (
                'id' => 331,
                'city_id' => 50,
                'name' => 'Petrelë',
            ),
            331 => 
            array (
                'id' => 332,
                'city_id' => 50,
                'name' => 'Farkë',
            ),
            332 => 
            array (
                'id' => 333,
                'city_id' => 50,
                'name' => 'Dajt',
            ),
            333 => 
            array (
                'id' => 334,
                'city_id' => 50,
                'name' => 'Zall-Bastar',
            ),
            334 => 
            array (
                'id' => 335,
                'city_id' => 50,
                'name' => 'Bërzhitë',
            ),
            335 => 
            array (
                'id' => 336,
                'city_id' => 50,
                'name' => 'Krrabë',
            ),
            336 => 
            array (
                'id' => 337,
                'city_id' => 50,
                'name' => 'Baldushk',
            ),
            337 => 
            array (
                'id' => 338,
                'city_id' => 50,
                'name' => 'Shëngjergj',
            ),
            338 => 
            array (
                'id' => 339,
                'city_id' => 50,
                'name' => 'Vaqarr',
            ),
            339 => 
            array (
                'id' => 340,
                'city_id' => 50,
                'name' => 'Kashar',
            ),
            340 => 
            array (
                'id' => 341,
                'city_id' => 50,
                'name' => 'Pezë',
            ),
            341 => 
            array (
                'id' => 342,
                'city_id' => 50,
                'name' => 'Ndroq',
            ),
            342 => 
            array (
                'id' => 343,
                'city_id' => 50,
                'name' => 'Zall-Herr',
            ),
            343 => 
            array (
                'id' => 344,
                'city_id' => 51,
                'name' => 'Kamëz',
            ),
            344 => 
            array (
                'id' => 345,
                'city_id' => 51,
                'name' => 'Paskuqan',
            ),
            345 => 
            array (
                'id' => 346,
                'city_id' => 52,
                'name' => 'Vorë',
            ),
            346 => 
            array (
                'id' => 347,
                'city_id' => 52,
                'name' => 'Prezë',
            ),
            347 => 
            array (
                'id' => 348,
                'city_id' => 52,
                'name' => 'Bërxullë',
            ),
            348 => 
            array (
                'id' => 349,
                'city_id' => 53,
                'name' => 'Kavajë',
            ),
            349 => 
            array (
                'id' => 350,
                'city_id' => 53,
                'name' => 'Synej',
            ),
            350 => 
            array (
                'id' => 351,
                'city_id' => 53,
                'name' => 'Luz i Vogël',
            ),
            351 => 
            array (
                'id' => 352,
                'city_id' => 53,
                'name' => 'Golem',
            ),
            352 => 
            array (
                'id' => 353,
                'city_id' => 53,
                'name' => 'Helmas',
            ),
            353 => 
            array (
                'id' => 354,
                'city_id' => 54,
                'name' => 'Rrogozhinë',
            ),
            354 => 
            array (
                'id' => 355,
                'city_id' => 54,
                'name' => 'Kryevidh',
            ),
            355 => 
            array (
                'id' => 356,
                'city_id' => 54,
                'name' => 'Sinaballaj',
            ),
            356 => 
            array (
                'id' => 357,
                'city_id' => 54,
                'name' => 'Lekaj',
            ),
            357 => 
            array (
                'id' => 358,
                'city_id' => 54,
                'name' => 'Gosë',
            ),
            358 => 
            array (
                'id' => 359,
                'city_id' => 55,
                'name' => 'Vlorë',
            ),
            359 => 
            array (
                'id' => 360,
                'city_id' => 55,
                'name' => 'Orikum',
            ),
            360 => 
            array (
                'id' => 361,
                'city_id' => 55,
                'name' => 'Qendër Vlorë',
            ),
            361 => 
            array (
                'id' => 362,
                'city_id' => 55,
                'name' => 'Novoselë',
            ),
            362 => 
            array (
                'id' => 363,
                'city_id' => 55,
                'name' => 'Shushicë',
            ),
            363 => 
            array (
                'id' => 364,
                'city_id' => 56,
                'name' => 'Selenicë',
            ),
            364 => 
            array (
                'id' => 365,
                'city_id' => 56,
                'name' => 'Armen',
            ),
            365 => 
            array (
                'id' => 366,
                'city_id' => 56,
                'name' => 'Vllahinë',
            ),
            366 => 
            array (
                'id' => 367,
                'city_id' => 56,
                'name' => 'Kotë',
            ),
            367 => 
            array (
                'id' => 368,
                'city_id' => 56,
                'name' => 'Sevaster',
            ),
            368 => 
            array (
                'id' => 369,
                'city_id' => 56,
                'name' => 'Brataj',
            ),
            369 => 
            array (
                'id' => 370,
                'city_id' => 57,
                'name' => 'Himarë',
            ),
            370 => 
            array (
                'id' => 371,
                'city_id' => 57,
                'name' => 'Lukovë',
            ),
            371 => 
            array (
                'id' => 372,
                'city_id' => 57,
                'name' => 'Horë - Vranisht',
            ),
            372 => 
            array (
                'id' => 373,
                'city_id' => 58,
                'name' => 'Sarandë',
            ),
            373 => 
            array (
                'id' => 374,
                'city_id' => 58,
                'name' => 'Ksamil',
            ),
            374 => 
            array (
                'id' => 375,
                'city_id' => 59,
                'name' => 'Konispol',
            ),
            375 => 
            array (
                'id' => 376,
                'city_id' => 59,
                'name' => 'Xarrë',
            ),
            376 => 
            array (
                'id' => 377,
                'city_id' => 59,
                'name' => 'Markat',
            ),
            377 => 
            array (
                'id' => 378,
                'city_id' => 60,
                'name' => 'Livadhja',
            ),
            378 => 
            array (
                'id' => 379,
                'city_id' => 60,
                'name' => 'Dhivër',
            ),
            379 => 
            array (
                'id' => 380,
                'city_id' => 60,
                'name' => 'Aliko',
            ),
            380 => 
            array (
                'id' => 381,
                'city_id' => 60,
                'name' => 'Finiq',
            ),
            381 => 
            array (
                'id' => 382,
                'city_id' => 60,
                'name' => 'Mesopotam',
            ),
            382 => 
            array (
                'id' => 383,
                'city_id' => 61,
                'name' => 'Delvinë',
            ),
            383 => 
            array (
                'id' => 384,
                'city_id' => 61,
                'name' => 'Vergo',
            ),
        ));
        
        
    }
}