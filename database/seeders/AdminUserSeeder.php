<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name' => 'Administrator',
            'email' => 'administrator@arka-doc.dev',
            'password' => bcrypt('admin'),
            'level' => 'administrator',
            'project_id' => 1,
            'department_id' => 7
        ]);
    }
}
