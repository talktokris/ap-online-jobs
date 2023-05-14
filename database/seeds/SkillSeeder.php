<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Skills_for_gw = array(
            'Blueprint Reading',
            'MIG Welding',
            'Fabricating',
            'Steel Manufacturing',
            'Grinding',
            'Tig Welding',
            'Instructing',
            'Torching',
            'Arc Welding'
        );
        
        foreach($Skills_for_gw as $name){
            $skill = new \App\Skill;
            $skill->for = 'gw';
            $skill->name = $name;
            $skill->slug = str_replace(" ", "_", $name);
            $skill->type = 'Skill';
            $skill->save();
        }

        $languages_for_gw = array('English', 'Malay', 'Mandarin');
        foreach($languages_for_gw as $name){
            $skill = new \App\Skill;
            $skill->for = 'gw';
            $skill->name = $name;
            $skill->slug = str_replace(" ", "_", $name);
            $skill->type = 'Language';
            $skill->save();
        }
        $Skills_for_dm = array(
            'Baby Care',
            'Children Care',
            'Elderly Care',
            'Disable Care',
            'House Keeping',
            'Ironing',
            'Car Washing',
            'Gardening',
            'Marketing',
        );
        foreach($Skills_for_dm as $name){
            $skill = new \App\Skill;
            $skill->for = 'dm';
            $skill->name = $name;
            $skill->slug = str_replace(" ", "_", $name);
            $skill->type = 'Skill';
            $skill->save();
        }
        $languages_for_dm = array('English', 'Malay', 'Mandarin');
        foreach($languages_for_dm as $name){
            $skill = new \App\Skill;
            $skill->for = 'dm';
            $skill->name = $name;
            $skill->slug = str_replace(" ", "_", $name);
            $skill->type = 'Language';
            $skill->save();
        }


    }
}
