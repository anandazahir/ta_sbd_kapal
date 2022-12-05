<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt("1234");
        $username = "admin";

        DB::insert(
            'INSERT INTO users(username, password) VALUES (:username, :password)',
            [
                'username' => $username,
                'password' => $password,
            ]
        );
    }
}
