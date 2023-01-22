<?php

namespace Database\Seeders;

use App\Models\Admin as AdminAlias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        AdminAlias::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'username' => 'admin',
        ]);
    }
}
