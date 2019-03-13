<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branches')->delete();
        
        \DB::table('branches')->insert(array (
            0 => 
            array (
                'id' => 1,
                'site_id' => 1,
                'name' => 'TIranë',
                'slug' => 'TIranë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            1 => 
            array (
                'id' => 2,
                'site_id' => 6,
                'name' => 'Krujë',
                'slug' => 'Krujë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            2 => 
            array (
                'id' => 3,
                'site_id' => -1,
                'name' => 'Tranzit',
                'slug' => 'Tranzit',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            3 => 
            array (
                'id' => 4,
                'site_id' => 6,
                'name' => 'Durrës',
                'slug' => 'Durrës',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            4 => 
            array (
                'id' => 5,
                'site_id' => 1,
                'name' => 'Kavajë',
                'slug' => 'Kavajë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            5 => 
            array (
                'id' => 6,
                'site_id' => 7,
                'name' => 'Elbasan',
                'slug' => 'Elbasan',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            6 => 
            array (
                'id' => 7,
                'site_id' => 7,
                'name' => 'Gramsh',
                'slug' => 'Gramsh',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            7 => 
            array (
                'id' => 8,
                'site_id' => 7,
                'name' => 'Librazhd',
                'slug' => 'Librazhd',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            8 => 
            array (
                'id' => 9,
                'site_id' => 7,
                'name' => 'Peqin',
                'slug' => 'Peqin',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            9 => 
            array (
                'id' => 10,
                'site_id' => 4,
                'name' => 'Shkodër',
                'slug' => 'Shkodër',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            10 => 
            array (
                'id' => 11,
                'site_id' => 4,
                'name' => 'Malësi e Madhe',
                'slug' => 'Malësi e Madhe',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            11 => 
            array (
                'id' => 12,
                'site_id' => 4,
                'name' => 'Pukë',
                'slug' => 'Pukë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            12 => 
            array (
                'id' => 13,
                'site_id' => 12,
                'name' => 'Lezhë',
                'slug' => 'Lezhë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            13 => 
            array (
                'id' => 14,
                'site_id' => 12,
                'name' => 'Mirditë',
                'slug' => 'Mirditë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            14 => 
            array (
                'id' => 15,
                'site_id' => 12,
                'name' => 'Laç',
                'slug' => 'Laç',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            15 => 
            array (
                'id' => 16,
                'site_id' => 5,
                'name' => 'Berat',
                'slug' => 'Berat',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            16 => 
            array (
                'id' => 17,
                'site_id' => 5,
                'name' => 'Kuçovë',
                'slug' => 'Kuçovë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            17 => 
            array (
                'id' => 18,
                'site_id' => 5,
                'name' => 'Skrapar',
                'slug' => 'Skrapar',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            18 => 
            array (
                'id' => 19,
                'site_id' => 9,
                'name' => 'Gjirokastër',
                'slug' => 'Gjirokastër',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            19 => 
            array (
                'id' => 20,
                'site_id' => 9,
                'name' => 'Tepelenë',
                'slug' => 'Tepelenë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            20 => 
            array (
                'id' => 21,
                'site_id' => 9,
                'name' => 'Përmet',
                'slug' => 'Përmet',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            21 => 
            array (
                'id' => 22,
                'site_id' => 10,
                'name' => 'Korçë',
                'slug' => 'Korçë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            22 => 
            array (
                'id' => 23,
                'site_id' => 10,
                'name' => 'Pogradec',
                'slug' => 'Pogradec',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            23 => 
            array (
                'id' => 24,
                'site_id' => 10,
                'name' => 'Ersekë',
                'slug' => 'Ersekë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            24 => 
            array (
                'id' => 25,
                'site_id' => 3,
                'name' => 'Mat',
                'slug' => 'Mat',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            25 => 
            array (
                'id' => 26,
                'site_id' => 3,
                'name' => 'Dibër',
                'slug' => 'Dibër',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            26 => 
            array (
                'id' => 27,
                'site_id' => 3,
                'name' => 'Bulqizë',
                'slug' => 'Bulqizë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            27 => 
            array (
                'id' => 28,
                'site_id' => 11,
                'name' => 'Kukës',
                'slug' => 'Kukës',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            28 => 
            array (
                'id' => 29,
                'site_id' => 11,
                'name' => 'Has',
                'slug' => 'Has',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            29 => 
            array (
                'id' => 30,
                'site_id' => 11,
                'name' => 'Bajram Curri',
                'slug' => 'Bajram Curri',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            30 => 
            array (
                'id' => 31,
                'site_id' => 13,
                'name' => 'Lushnje',
                'slug' => 'Lushnje',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            31 => 
            array (
                'id' => 32,
                'site_id' => 8,
                'name' => 'Fier',
                'slug' => 'Fier',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            32 => 
            array (
                'id' => 33,
                'site_id' => 14,
                'name' => 'Vlorë',
                'slug' => 'Vlorë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            33 => 
            array (
                'id' => 34,
                'site_id' => 2,
                'name' => 'Sarandë',
                'slug' => 'Sarandë',
                'created_at' => '2018-11-26 16:24:31',
                'updated_at' => '2018-11-26 16:24:31',
            ),
            34 => 
            array (
                'id' => 35,
                'site_id' => 1,
                'name' => 'Dega Neutron',
                'slug' => 'dega-neutron',
                'created_at' => '2018-12-12 08:55:20',
                'updated_at' => '2018-12-12 08:55:20',
            ),
        ));
        
        
    }
}