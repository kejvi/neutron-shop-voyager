<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

        ///////////////////////////
        /// ** SPORTELIST **    //
        //////////////////////////
        $sportelistiPermissions = $permissions->filter(function ($item){
            if (in_array($item->key, [
                'browse_admin',
                'change_password',
                'browse_pos',
                'read_pos',
                'edit_pos',
                'add_pos',
                'delete_pos',
                'browse_returns',
                'read_returns',
                'edit_returns',
                'add_returns',
                'delete_returns',
            ])){
                return $item;
            }
        });

        $sportelisti = Role::where('name', 'Sportelist')->firstOrFail();
        $sportelisti->permissions()->sync(
            $sportelistiPermissions->pluck('id')->all()
        );

        ///////////////////////////
        /// ** KRYETAR ZYRE **   //
        //////////////////////////
        $kryetarZyrePermissons = $permissions->filter(function ($item){
            if (in_array($item->key, [
                'browse_admin',
                'browse_reports',
                'read_reports',
                'edit_reports',
                'add_reports',
                'delete_reports',
                'change_password',
            ])){
                return $item;
            }
        });

        $kryetarZyre = Role::where('name', 'Kryetar Zyre')->firstOrFail();
        $kryetarZyre->permissions()->sync(
            $kryetarZyrePermissons->pluck('id')->all()
        );

        ///////////////////////////
        /// ** Specialist Dege **   //
        //////////////////////////
        $specialistDegePermissions = $permissions->filter(function ($item){
            if (in_array($item->key, [
                'browse_admin',
                'browse_reports',
                'read_reports',
                'edit_reports',
                'add_reports',
                'delete_reports',
                'change_password',
            ])){
                return $item;
            }
        });

        $specialistDege = Role::where('name', 'Specialist në Degë')->firstOrFail();
        $specialistDege->permissions()->sync(
            $specialistDegePermissions->pluck('id')->all()
        );

        ///////////////////////////
        /// ** Specialist Filiali **   //
        //////////////////////////
        $specialistFilialiPermissions = $permissions->filter(function ($item){
            if (in_array($item->key, [
                'browse_admin',
                'browse_reports',
                'read_reports',
                'edit_reports',
                'add_reports',
                'delete_reports',
                'change_password',
            ])){
                return $item;
            }
        });

        $specialistFiliali = Role::where('name', 'Specialist në Filial')->firstOrFail();
        $specialistFiliali->permissions()->sync(
            $specialistFilialiPermissions->pluck('id')->all()
        );

        ///////////////////////////
        /// ** Base Role **   //
        //////////////////////////
        $baseRolePermissions = $permissions->filter(function ($item){
            if (in_array($item->key, [
                'browse_admin',
                'change_password',
            ])){
                return $item;
            }
        });

        $baseRole = Role::where('name', 'Base Role')->firstOrFail();
        $baseRole->permissions()->sync(
            $baseRolePermissions->pluck('id')->all()
        );


        ///////////////////////////
        /// ** Base Role **   //
        //////////////////////////
        $roliDafesPermissions = $permissions->filter(function ($item){
            if (in_array($item->key, [
                'browse_admin',
                'change_password',
            ])){
                return $item;
            }
        });

        $roliDafes = Role::where('name', 'Roli Dafes')->firstOrFail();
        $roliDafes->permissions()->sync(
            $roliDafesPermissions->pluck('id')->all()
        );
    }
}
