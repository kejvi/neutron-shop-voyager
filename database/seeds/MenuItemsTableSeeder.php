<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.dashboard'),
            'url'     => '',
            'route'   => 'voyager.dashboard',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-boat',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $adminMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.admin'),
            'url'     => '',
        ]);
        if (!$adminMenuItem->exists) {
            $adminMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-people',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 9,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.media'),
            'url'     => '',
            'route'   => 'voyager.media.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-images',
                'color'      => null,
                'parent_id'  => $adminMenuItem->id,
                'order'      => 5,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.users'),
            'url'     => '',
            'route'   => 'voyager.users.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => $adminMenuItem->id,
                'order'      => 3,
            ])->save();
        }

        $mailMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.mail'),
            'url'     => '',
        ]);
        if (!$mailMenuItem->exists) {
            $mailMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-mail',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 8,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.pos'),
            'url'     => '',
            'route'   => 'voyager.pos.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.report'),
            'url'     => '',
            'route'   => 'voyager.reports.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.neutron-report'),
            'url'     => '',
            'route'   => 'voyager.neutron-report.index',
        ]);
        if (!$menuItem->exists){
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.total-report'),
            'url'     => '',
            'route'   => 'voyager.total-reports.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.sites'),
            'url'     => '',
            'route'   => 'voyager.sites.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.branches'),
            'url'     => '',
            'route'   => 'voyager.branches.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.offices'),
            'url'     => '',
            'route'   => 'voyager.offices.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.articles'),
            'url'     => '',
            'route'   => 'voyager.articles.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }


        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.clients'),
            'url'     => '',
            'route'   => 'voyager.clients.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.returns'),
            'url'     => '',
            'route'   => 'voyager.returns.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.transfer-to-offices'),
            'url'     => '',
            'route'   => 'voyager.transfer-to-offices.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('seeders.menu_items.transfer-to-magazine'),
            'url'     => '',
            'route'   => 'voyager.transfer-to-magazine.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-angle-right',
                'color'      => null,
                'parent_id'  => $mailMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.roles'),
            'url'     => '',
            'route'   => 'voyager.roles.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-lock',
                'color'      => null,
                'parent_id'  => $adminMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $toolsMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.tools'),
            'url'     => '',
        ]);
        if (!$toolsMenuItem->exists) {
            $toolsMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-tools',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 9,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.menu_builder'),
            'url'     => '',
            'route'   => 'voyager.menus.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-list',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 10,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.database'),
            'url'     => '',
            'route'   => 'voyager.database.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-data',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 11,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.compass'),
            'url'     => '',
            'route'   => 'voyager.compass.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-compass',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 12,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.bread'),
            'url'     => '',
            'route'   => 'voyager.bread.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-bread',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 13,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.settings'),
            'url'     => '',
            'route'   => 'voyager.settings.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-settings',
                'color'      => null,
                'parent_id'  => $adminMenuItem->id,
                'order'      => 14,
            ])->save();
        }
    }
}
