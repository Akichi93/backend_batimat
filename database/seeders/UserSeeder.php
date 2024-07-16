<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersRecords = [
            ['id'=>1,'name'=>'Admin','email'=>'jean@gmail.com','contact'=>'0758650487','email_verified_at'=> NULL,'password'=>'$2y$10$Y2niMCQWuigFfFn76gbWx.34lxgasyrNb27sB6yeTYvXVejuRYXN6','remember_token'=>NULL,'created_at'=>NULL,'updated_at'=>NULL],
        ];

        User::insert($usersRecords);
    }
}
