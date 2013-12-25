<?php

class GaleriesTableSeeder extends Seeder
{

    public function run()
    {
        Galeries::create(array(
            "name" => "Futbol Takımları",
            "slug" => "futbol-takimlari",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => null,
            "status" => 1
                )
        );
        Galeries::create(array(
            "name" => "Basketbol Takımları",
            "slug" => "basketbol-takimlari",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => null,
            "status" => 1
                )
        );
    }

}
