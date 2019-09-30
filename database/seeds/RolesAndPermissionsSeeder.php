<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $items = ['programs', 'agencies', 'users'];
        foreach($items as $item) {
            Permission::create(['name' => 'create ' . $item]);
            Permission::create(['name' => 'edit ' . $item]);
            Permission::create(['name' => 'view ' . $item]);
            Permission::create(['name' => 'delete ' . $item]);
        }

        // create roles and assign created permissions
        $role = Role::create(['name' => 'super-admin', 'label' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'faculty', 'label' => 'Faculty']);
        Role::create(['name' => 'survey-exec', 'label' => 'Survey Executive']);
    }
}
