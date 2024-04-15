<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType as UserTypes;

class UserType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $userTypesData = [
        ['user_type' => 'Super Admin'],
        ['user_type' => 'Admin'],
        ['user_type' => 'Sales Representative'],
        ['user_type' => 'Customer'],
        ['user_type' => 'App User']
      ];

      UserTypes::insert($userTypesData);
    }
}
