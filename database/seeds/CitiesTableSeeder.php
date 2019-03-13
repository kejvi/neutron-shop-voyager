<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Berat',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ura Vajgurore',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Kuçovë',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Skrapar',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Poliçan',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Dibër',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Bulqizë',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Mat',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Klos',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Durrës',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Shijak',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Krujë',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Elbasan',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Cërrik',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Belsh',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Peqin',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Gramsh',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Librazhd',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Prrenjas',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Fier',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Patos',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Roskovec',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Lushnje',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Divjakë',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Mallakastër',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Gjirokastër',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Libohovë',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Tepelenë',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Memaliaj',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Përmet',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Këlcyrë',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Dropull',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Korçë',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Maliq',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Pustec',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Kolonjë',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Devoll',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Pogradec',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Kukës',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Has',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Tropojë',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Lezhë',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Mirditë',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Kurbin',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Malësi e Madhe',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Shkodër',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Vau -Dejës',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Pukë',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Fushë-Arrëz',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Tiranë',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Kamëz',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Vorë',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Kavajë',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Rrogozhinë',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Vlorë',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Selenicë',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Himarë',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Sarandë',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Konispol',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Finiq',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Delvinë',
            ),
        ));
        
        
    }
}