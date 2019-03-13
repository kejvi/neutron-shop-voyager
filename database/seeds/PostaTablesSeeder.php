<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;


class PostaTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * --------------------------------------------------------------------------
         *  SITES
         * --------------------------------------------------------------------------
         */

        //Data Type
        $dataType = $this->dataType('slug', 'sites');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'sites',
                'display_name_singular' => __('voyager::seeders.data_types.sites.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.sites.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'App\\Site',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        //Data Rows
        $siteDataType = DataType::where('slug', 'sites')->firstOrFail();

        $dataRow = $this->dataRow($siteDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($siteDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($siteDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'slugify' => [
                        'origin' => 'name',
                    ],
                    'validation' => [
                        'rule'  => 'unique:branches,slug',
                    ],
                ],
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($siteDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($siteDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 11,
            ])->save();
        }

        /**
         * --------------------------------------------------------------------------
         *  BRANCHES
         * --------------------------------------------------------------------------
         */

        //Data Type
        $dataType = $this->dataType('slug', 'branches');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'branches',
                'display_name_singular' => __('voyager::seeders.data_types.branches.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.branches.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'App\\Branch',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        //Data Rows
        $branchDataType = DataType::where('slug', 'branches')->firstOrFail();

        $dataRow = $this->dataRow($branchDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($branchDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($branchDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'slugify' => [
                        'origin' => 'name',
                    ],
                    'validation' => [
                        'rule'  => 'unique:branches,slug',
                    ],
                ],
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($branchDataType, 'site_id');
        if (!$dataRow->exists){
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.site_id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($branchDataType, 'branch_belongsto_site_relationship');
        if (!$dataRow->exists){
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('seeders.data_types.sites.singular'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model' => 'App\\Site',
                    'table' => 'sites',
                    'type' => 'belongsTo',
                    'column' => 'site_id',
                    'key' => 'id',
                    'label' => 'name',
                    'pivot_table' => 'branches',
                    'pivot' => '0',
                    'taggable' => '0',
                ],
                'order'        => 1,
            ])->save();
        }



        $dataRow = $this->dataRow($branchDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($branchDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 11,
            ])->save();
        }

        /**
         * --------------------------------------------------------------------------
         *  OFFICES
         * --------------------------------------------------------------------------
         */

        //Data Type
        $dataType = $this->dataType('slug', 'offices');
        if (!$dataType->exists) {
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

        //Data Rows
        $officeDataType = DataType::where('slug', 'offices')->firstOrFail();

        $dataRow = $this->dataRow($officeDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'slugify' => [
                        'origin' => 'name',
                    ],
                    'validation' => [
                        'rule'  => 'unique:offices,slug',
                    ],
                ],
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'branch_id');
        if (!$dataRow->exists){
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.branch_id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'branch_belongsto_branch_relationship');
        if (!$dataRow->exists){
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => __('seeders.data_types.branches.singular'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model' => 'App\\Branch',
                    'table' => 'branches',
                    'type' => 'belongsTo',
                    'column' => 'branch_id',
                    'key' => 'id',
                    'label' => 'name',
                    'pivot_table' => 'branches',
                    'pivot' => '0',
                    'taggable' => '0',
                ],
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'postal_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.postal_code'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($officeDataType, 'hall');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.hall'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($officeDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 11,
            ])->save();
        }


        /**
         * --------------------------------------------------------------------------
         *  ARTICLES
         * --------------------------------------------------------------------------
         */
        //Data Type
        $dataType = $this->dataType('slug', 'articles');
        if (!$dataType->exists) {
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

        //Data Rows
        $articledataType = DataType::where('slug', 'articles')->firstOrFail();

        $dataRow = $this->dataRow($articledataType, 'emertimet');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'sn');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.sn'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'transferuar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => __('seeders.data_rows.transferuar'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'Cmimi');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.Cmimi'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 11,
            ])->save();
        }


        /**
         * --------------------------------------------------------------------------
         *  CLIENTS
         * --------------------------------------------------------------------------
         */
        //Data Type
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

        //Data Rows
        $articledataType = DataType::where('slug', 'clients')->firstOrFail();

        $dataRow = $this->dataRow($articledataType, 'first_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.first_name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'last_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.last_name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }


        $dataRow = $this->dataRow($articledataType, 'address');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.address'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'tel');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.tel'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.email'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'sn');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.sn'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }



        /**
         * --------------------------------------------------------------------------
         *  RETURNS
         * --------------------------------------------------------------------------
         */
        //Data Type
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

        //Data Rows
        $articledataType = DataType::where('slug', 'returns')->firstOrFail();

        $dataRow = $this->dataRow($articledataType, 'postal_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => __('seeders.data_rows.postal_code'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'office_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => __('seeders.data_rows.office_name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($articledataType, 'user_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => __('seeders.data_rows.user_name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }


        $dataRow = $this->dataRow($articledataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => __('seeders.data_rows.user_id'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.description'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'serial_number');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.serial_number'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'new_serial_number');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.new_serial_number'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($articledataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'details'      => [
                    'default' => 'options',
                    'options' => [
                            'ne_pritje' => 'Ne_ Pritje',
                            'aprovuar' => 'Aprovuar',
                            'refuzuar' => 'Refuzuar',
                            'refuzuar' => 'Refuzuar',
                    ],
                ],
                'display_name' => __('seeders.data_rows.status'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }


        $dataRow = $this->dataRow($articledataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 10,
            ])->save();
        }


    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
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
