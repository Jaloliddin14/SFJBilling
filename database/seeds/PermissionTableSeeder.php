<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $permissions = [
            'nastroyki-cena_uslugi',
            'nastroyki-uslugi',
            'nastroyki-users',
            'nastroyki-close_month',
            'nastroyki',

            'otcheti',


            'new-abonent',

            'abonent-edit',
            'abonent-add_uslugi',
            'abonent-oplata',
            'abonent-actions',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
