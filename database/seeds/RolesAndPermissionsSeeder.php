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
        $items = ['program', 'agency', 'user', 'accreditation', 'course', 'document', 'document-outline', 'scoring-type', 'curriculum', 'faculty', 'team', 'timeline', 'role-permission'];
        foreach($items as $item) {
            Permission::create(['name' => 'create ' . $item]);
            Permission::create(['name' => 'edit ' . $item]);
            Permission::create(['name' => 'view ' . $item]);
            Permission::create(['name' => 'delete ' . $item]);
        }

        // create roles and assign created permissions
        $role = Role::create(['name' => 'super-admin', 'label' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        $faculty = Role::create(['name' => 'faculty', 'label' => 'Faculty']);
        $faculty->givePermissionTo('view faculty');
        $chair = Role::create(['name' => 'department-chair', 'label' => 'Department Chair']);
        $chair->givePermissionTo(['view course','view curriculum','view faculty']);
        $secretary = Role::create(['name' => 'department-secretary', 'label' => 'Department Secretary']);
        $secretary->givePermissionTo(['view course','view curriculum','view faculty']);
        $staff = Role::create(['name' => 'department-staff', 'label' => 'Department Staff']);
        $staff->givePermissionTo(['view course','view curriculum','view faculty']);
        $member = Role::create(['name' => 'member', 'label' => 'Member']);
        $member->givePermissionTo('view document-outline');
        $team_head = Role::create(['name' => 'team-head', 'label' => 'Team Head']);
        $team_head->givePermissionTo('view document-outline');
    }
}
