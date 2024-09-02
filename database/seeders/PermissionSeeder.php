<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create_users',
            'view_users',
            'update_users',
            'delete_users',
            
            'create_roles',
            'view_roles',
            'update_roles',
            'delete_roles',

            'create_permissions',
            'view_permissions',
            'update_permissions',
            'delete_permissions',

            'view_history',

            'permanent_delete_users',
            'restore_users',
            'view_deleted_users',

            'view_site_settings',
            'update_site_settings',

            'create_services',
            'view_services',
            'update_services',
            'delete_services',

            'create_clients',
            'view_clients',
            'update_clients',
            'delete_clients',

            'create_images',
            'view_images',
            'update_images',
            'delete_images',

            'upload_images',

            'create_posts',
            'view_posts',
            'update_posts',
            'delete_posts',

            'create_contacts',
            'view_contacts',
            'update_contacts',
            'delete_contacts',

            'create_subscriptions',
            'view_subscriptions',
            'update_subscriptions',
            'delete_subscriptions',

            'view_parcel_tracking_dashboard',
            'view customers',
            'view receivers',
            'view tracking-updates',
            'view parcels',
            'view parcel-histories'

            // 'create_',
            // 'view_',
            // 'update_',
            // 'delete_',

        ];
        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission
            ]);
        }
        
    }
}
