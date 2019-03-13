<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'user']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.user'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Sportelist']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Sportelist'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Kryetar Zyre']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Kryetar Zyre'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Specialist në Degë']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Specialist në Degë'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Specialist në Filial']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Specialist në Filial'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Specialist Shërbimesh në Drejtori']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Specialist Shërbimesh në Drejtori'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'IT Admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.IT Admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Roli Dafes']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Roli Dafes'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'Base Role']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('seeders.roles.Base Role'),
            ])->save();
        }


    }
}
