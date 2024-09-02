<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=['superadmin','admin'];    
        foreach ($roles as $role){
            Role::create([
                'name'=>$role
            ]);
        }

        $permission=Permission::all()->pluck('id');
        $superadmin=Role::findOrFail(1);
        $superadmin->permissions()->sync($permission);
        $admin=Role::findOrFail(2);
        $adminpermission=Permission::whereIn('name',[
            'create_users',
            'view_users',
            'update_users',
            'delete_users',
            'permanent_delete_users',
            'restore_users',
            'view_deleted_users',

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

            ])->pluck('id');
        $admin->permissions()->sync($adminpermission);    
    }
}
