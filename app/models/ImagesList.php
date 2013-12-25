<?php

class ImagesList extends Eloquent
{
    protected $table = 'images';
    
    public static function getImage(){
        return self::join("galeries as g","g.id","=","images.galery_id")
                ->select("g.slug as galerySlug","images.image","images.id","images.name")
                ->get();
    }
}
