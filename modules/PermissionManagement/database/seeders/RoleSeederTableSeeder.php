<?php

namespace Modules\PermissionManagement\database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $superadmin = Role::create(['name' => 'Super Admin']);
        $user = Role::create(['name' => 'User']);

        $superadmin->givePermissionTo(Permission::all());
        $user->givePermissionTo(['general', 'dashboard.index']);

        User::firstWhere('name', 'Super Admin')->assignRole('Super Admin');
        User::firstWhere('name', 'User')->assignRole('User');
    }
}