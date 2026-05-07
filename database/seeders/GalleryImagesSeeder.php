<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryImagesSeeder extends Seeder
{
    public function run()
    {
        $images = [
            ['name' => 'absoluteciname2', 'img_path' => 'extra_gallery/absoluteciname2.jfif'],
            ['name' => 'BTS', 'img_path' => 'extra_gallery/BTS.jfif'],
            ['name' => 'bossbaby', 'img_path' => 'extra_gallery/bossbaby.jfif'],
            ['name' => 'beautiful', 'img_path' => 'extra_gallery/beautiful.jfif'],
            ['name' => 'btsnewyork', 'img_path' => 'extra_gallery/btsnewyork.jfif'],
            ['name' => 'btsmacbeth', 'img_path' => 'extra_gallery/btsmacbeth.jfif'],
            ['name' => 'btsss', 'img_path' => 'extra_gallery/btsss.jfif'],
            ['name' => 'BTSSSS', 'img_path' => 'extra_gallery/BTSSSS.jfif'],
            ['name' => 'cinbts', 'img_path' => 'extra_gallery/cinbts.jfif'],
            ['name' => 'download (2)', 'img_path' => 'extra_gallery/download (2).jfif'],
            ['name' => 'eggJin', 'img_path' => 'extra_gallery/eggJin.jfif'],
            ['name' => 'fairy', 'img_path' => 'extra_gallery/fairy.jfif'],
            ['name' => 'grinding', 'img_path' => 'extra_gallery/grinding.jfif'],
            ['name' => 'HAHAHA', 'img_path' => 'extra_gallery/HAHAHA.jfif'],
            ['name' => 'hobi', 'img_path' => 'extra_gallery/hobi.jfif'],
            ['name' => 'huh', 'img_path' => 'extra_gallery/huh.jfif'],
            ['name' => 'idc', 'img_path' => 'extra_gallery/idc.jfif'],
            ['name' => 'idcc', 'img_path' => 'extra_gallery/idcc.jfif'],
            ['name' => 'idk', 'img_path' => 'extra_gallery/idk.jfif'],
            ['name' => 'jimin', 'img_path' => 'extra_gallery/jimin.jfif'],
            ['name' => 'jiminaaa', 'img_path' => 'extra_gallery/jiminaaa.jfif'],
            ['name' => 'jiminSmile', 'img_path' => 'extra_gallery/jiminSmile.jfif'],
            ['name' => 'jin', 'img_path' => 'extra_gallery/jin.jfif'],
            ['name' => 'jinnnn', 'img_path' => 'extra_gallery/jinnnn.jfif'],
            ['name' => 'jinSmile', 'img_path' => 'extra_gallery/jinSmile.jfif'],
            ['name' => 'jk', 'img_path' => 'extra_gallery/jk.jfif'],
            ['name' => 'Jkk', 'img_path' => 'extra_gallery/Jkk.jfif'],
            ['name' => 'jkkkk', 'img_path' => 'extra_gallery/jkkkk.jfif'],
            ['name' => 'lalala', 'img_path' => 'extra_gallery/lalala.jfif'],
            ['name' => 'lifeGoesOn', 'img_path' => 'extra_gallery/lifeGoesOn.jfif'],
            ['name' => 'niagarapopo', 'img_path' => 'extra_gallery/niagarapopo.jfif'],
            ['name' => 'ooooo', 'img_path' => 'extra_gallery/ooooo.jfif'],
            ['name' => 'peace', 'img_path' => 'extra_gallery/peace.jfif'],
            ['name' => 'princess_v', 'img_path' => 'extra_gallery/princess_v.jfif'],
            ['name' => 'run', 'img_path' => 'extra_gallery/run.jfif'],
            ['name' => 'runrunrun', 'img_path' => 'extra_gallery/runrunrun.jfif'],
            ['name' => 'skincare', 'img_path' => 'extra_gallery/skincare.jfif'],
            ['name' => 'smile', 'img_path' => 'extra_gallery/smile.jfif'],
            ['name' => 'stobit', 'img_path' => 'extra_gallery/stobit.jfif'],
            ['name' => 'suga', 'img_path' => 'extra_gallery/suga.jfif'],
            ['name' => 'sugaspider', 'img_path' => 'extra_gallery/sugaspider.jfif'],
            ['name' => 'tae', 'img_path' => 'extra_gallery/tae.jfif'],
            ['name' => 'taekook', 'img_path' => 'extra_gallery/taekook.jfif'],
            ['name' => 'v', 'img_path' => 'extra_gallery/v.jfif'],
            ['name' => 'WHAT', 'img_path' => 'extra_gallery/WHAT.jfif'],
        ];

        DB::table('gallery_images')->insert($images);
    }
}
