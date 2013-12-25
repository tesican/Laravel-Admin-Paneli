<?php

class PagesTableSeeder extends Seeder
{

    public function run()
    {
        Pages::create(
                array(
                    "user_id" => 1,
                    "slug" => "hakkimizda",
                    "title" => "Hakkımızda",
                    'body' => 'Hakkımızda Yazısı',
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => null,
                    "created_ip" => Request::getClientIp(),
                    "updated_ip" => "",
                    "status" => 1
                )
        );
    }

}
