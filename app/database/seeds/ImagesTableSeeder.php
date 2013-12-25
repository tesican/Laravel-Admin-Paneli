<?php

class ImagesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('images')->delete();
        ImagesList::create(array(
            "galery_id" => 1,
            "image" => "test.jpg",
            "name" => "Manu FC",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => null
                )
        );
        ImagesList::create(array(
            "galery_id" => 1,
            "image" => "test2.jpg",
            "name" => "FC Real Madrid",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => null
                )
        );
        ImagesList::create(array(
            "galery_id" => 2,
            "image" => "test3.jpg",
            "name" => "Miami",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => null
                )
        );
    }

}
