<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => config('admin.admin_email'),
                'name' => config('admin.admin_name'),
                'password' => bcrypt(config('admin.admin_password')),
                'is_admin' => true,
            ],
        ]);
    }
}
