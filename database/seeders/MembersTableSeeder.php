<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    public function run(): void
{
        $members = [
            ['name' => 'KimNamjoon', 
                'role' => 'Leader / Rapper', 
                'image' => 'rm.jfif', 
                'quote' => 'Life is tough, but so are you 💜',
                'nickname' => 'Rm',
                'favicon' => 'KOYA.png'],
            ['name' => 'KimSeokjin', 
                'role' => 'Vocal', 
                'image' => 'jin.jfif', 
                'quote' => 'Love yourself 💜',
                'nickname' => 'Jin',
                'favicon' => 'RJ.png'],
            ['name' => 'MinYoongi', 
                'role' => 'Rapper', 
                'image' => 'suga.jfif', 
                'quote' => 'Effort never betrays you 💜',
                'nickname' => 'Suga',
                'favicon' => 'SHOOKY.png'],
            ['name' => 'JungHoseok', 
                'role' => 'Dancer / Rapper', 
                'image' => 'jhope.jfif', 
                'quote' => 'Smile, even if it hurts 💜',
                'nickname' => 'J-hope',
                'favicon' => 'MANG.png'],
            ['name' => 'ParkJimin', 
                'role' => 'Vocal / Dancer', 
                'image' => 'jimin.jfif', 
                'quote' => 'Do it with passion or not at all 💜',
                'nickname' => 'Jimin',
                'favicon' => 'CHIMMY.png'],
            ['name' => 'KimTaehyung', 
                'role' => 'Vocal', 
                'image' => 'v.jfif', 
                'quote' => 'Never give up 💜',
                'nickname' => 'V',
                'favicon' => 'TATA.png'],
            ['name' => 'JeonJungkook', 
                'role' => 'Main Vocal / Dancer', 
                'image' => 'jk.jfif', 
                'quote' => 'Dream big, keep going 💜',
                'nickname' => 'Jk',
                'favicon' => 'COOKY.png'],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
};