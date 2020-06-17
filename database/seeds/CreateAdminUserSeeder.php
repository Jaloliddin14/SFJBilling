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

        $role2->givePermissionTo('nastroyki');
        $role2->givePermissionTo('new-abonent');
        $role2->givePermissionTo('abonent-edit');
        $role2->givePermissionTo('abonent-add_uslugi');
        $role2->givePermissionTo('abonent-actions');
        $role2->givePermissionTo('otcheti');

        $role3->givePermissionTo('abonent-oplata');

        DB::table('syssana')->insert([
            'id' => 1,
            'tekoy' => now()->modify('first day of this month'),
            'created_at' => now(),
        ]);
    }
}
