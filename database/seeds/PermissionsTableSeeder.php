<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
            'browse_profile',
            'change_password',
            'approve_returns',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('settings');

        Permission::generateFor('branches');

        Permission::generateFor('sites');

        Permission::generateFor('offices');

        Permission::generateFor('articles');

        Permission::generateFor('pos');

        Permission::generateFor('reports');

        Permission::generateFor('total-reports');

        Permission::generateFor('clients');

        Permission::generateFor('returns');

        Permission::generateFor('transfer-to-offices');

        Permission::generateFor('transfer-to-magazine');

        Permission::generateFor('neutron-report');
    }
}
