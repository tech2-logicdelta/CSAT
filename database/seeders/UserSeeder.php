<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
          [
            'name' => 'shubham',
            'email' => 'shubham@gmail.com',
            'mobile' => '9090909090',
            'password' => bcrypt('shubham@123'),
            'user_type' => 1,
            'status' => '1'          ]
        );
    }
}
