<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sites')->delete();
        
        \DB::table('sites')->insert(array (
            0 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 1,
                'name' => 'Tiranë',
                'slug' => 'Tiranë',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            1 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 2,
                'name' => 'Sarandë',
                'slug' => 'Sarandë',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            2 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 3,
                'name' => 'Mat',
                'slug' => 'Mat',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            3 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 4,
                'name' => 'Shkodër',
                'slug' => 'Shkodër',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            4 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 5,
                'name' => 'Berat',
                'slug' => 'Berat',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            5 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 6,
                'name' => 'Durrës',
                'slug' => 'Durrës',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            6 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 7,
                'name' => 'Elbasan',
                'slug' => 'Elbasan',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            7 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 8,
                'name' => 'Fier',
                'slug' => 'Fier',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            8 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 9,
                'name' => 'Gjirokastër',
                'slug' => 'Gjirokastër',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            9 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 10,
                'name' => 'Korçë',
                'slug' => 'Korçë',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            10 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 11,
                'name' => 'Kukës',
                'slug' => 'Kukës',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            11 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 12,
                'name' => 'Lezhë',
                'slug' => 'Lezhë',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            12 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 13,
                'name' => 'Lushnje',
                'slug' => 'Lushnje',
                'updated_at' => '2018-11-26 16:23:18',
            ),
            13 => 
            array (
                'created_at' => '2018-11-26 16:23:18',
                'id' => 14,
                'name' => 'Vlorë',
                'slug' => 'Vlorë',
                'updated_at' => '2018-11-26 16:23:18',
            ),
        ));
        
        
    }
}