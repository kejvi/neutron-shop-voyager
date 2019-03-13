<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('clients')->delete();
        
        \DB::table('clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_name' => 'Julinda',
                'last_name' => 'Hackaj',
                'address' => 'Rruga Emin Duraku',
                'tel' => '0684042394',
                'email' => 'julindahackaj@yahoo.com',
                'created_at' => '2018-12-18 17:13:07',
                'updated_at' => '2018-12-18 17:13:07',
                'sn' => '180502110',
                'qyteti' => 'Tiranë',
                'njesia' => 'Nj. Adm. Nr.5',
            ),
            1 => 
            array (
                'id' => 2,
                'first_name' => 'Klevis',
                'last_name' => 'Karaj',
                'address' => 'Elbasan',
                'tel' => '0693582999',
                'email' => 'visi_karaj@hotmail.com',
                'created_at' => '2018-12-08 15:01:49',
                'updated_at' => '2018-12-08 15:01:49',
                'sn' => 'RTN101-1805001958',
                'qyteti' => 'null',
                'njesia' => 'null',
            ),
        ));
        
        
    }
}