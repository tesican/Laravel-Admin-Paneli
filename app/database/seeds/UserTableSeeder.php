<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        User::create(
                array(
                    "fullname" => "Admin",
                    "username" => "admin",
                    'email' => 'test@webdeders.com',
                    "password" => Hash::make('123456'),
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => null,
                    "created_ip" => Request::getClientIp(),
                    "updated_ip" => "",
                    "status" => 1
                )
        );
    }

}
