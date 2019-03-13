<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'policy_name'           => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'sites');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sites',
                'display_name_singular' => __('seeders.data_types.sites.singular'),
                'display_name_plural'   => __('seeders.data_types.sites.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\Site',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'branches');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'branches',
                'display_name_singular' => __('seeders.data_types.branches.singular'),
                'display_name_plural'   => __('seeders.data_types.branches.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\Branch',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'offices');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'offices',
                'display_name_singular' => __('seeders.data_types.offices.singular'),
                'display_name_plural'   => __('seeders.data_types.offices.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\Office',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'articles');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'articles',
                'display_name_singular' => __('seeders.data_types.articles.singular'),
                'display_name_plural'   => __('seeders.data_types.articles.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\Article',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pos');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'pos',
                'display_name_singular' => __('seeders.data_types.pos.singular'),
                'display_name_plural'   => __('seeders.data_types.pos.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\Pos',
                'controller'            => 'Admin\\PosController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'reports');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'reports',
                'display_name_singular' => __('seeders.data_types.reports.singular'),
                'display_name_plural'   => __('seeders.data_types.reports.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\EmptyModel',
                'controller'            => 'Admin\\MonitoringController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'neutron-report');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'neutron-report',
                'display_name_singular' => __('seeders.data_types.neutron-report.singular'),
                'display_name_plural'   => __('seeders.data_types.neutron-report.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\EmptyModel',
                'controller'            => 'Admin\\NeutronReportController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'total-reports');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'total-reports',
                'display_name_singular' => __('seeders.data_types.total-reports.singular'),
                'display_name_plural'   => __('seeders.data_types.total-reports.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\EmptyModel',
                'controller'            => 'Admin\\TotalReportMonitoringController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'clients');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'clients',
                'display_name_singular' => __('seeders.data_types.clients.singular'),
                'display_name_plural'   => __('seeders.data_types.clients.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\Client',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'returns');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'returns',
                'display_name_singular' => __('seeders.data_types.returns.singular'),
                'display_name_plural'   => __('seeders.data_types.returns.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\KthimDekoderi',
                'controller'            => 'ReturnsController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'transfer-to-magazine');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'transfer-to-magazine',
                'display_name_singular' => __('seeders.data_types.transfer-to-magazine.singular'),
                'display_name_plural'   => __('seeders.data_types.transfer-to-magazine.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\EmptyModel',
                'controller'            => 'Admin\\TransferController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'transfer-to-offices');
        if (!$dataType->exists){
            $dataType->fill([
                'name'                  => 'transfer-to-offices',
                'display_name_singular' => __('seeders.data_types.transfer-to-offices.singular'),
                'display_name_plural'   => __('seeders.data_types.transfer-to-offices.plural'),
                'icon'                  => 'voyager-angle-right',
                'model_name'            => 'App\\EmptyModel',
                'controller'            => 'Admin\\TransferToOfficesController',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
