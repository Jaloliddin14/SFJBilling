<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@umail.uz',
            'password' => bcrypt('123456789')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Manager']);
        $role3 = Role::create(['name' => 'Cashier']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        DB::table('syssana')->insert([
            'id' => 1,
            'tekoy' => now()->modify('first day of this month'),
            'crated_at' => now(),
        ]);
    }
}
