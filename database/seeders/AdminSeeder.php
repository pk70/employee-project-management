<?php

namespace Database\Seeders;

use App\Models\Admin as ModelsAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Moinul',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com'),
            'type'=>'admin'
        ]);
    }
}
