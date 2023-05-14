<?php

use App\User;
use App\AgentProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'agent@app.com')->first();
        $user->name = 'Agent Bangla';
        $user->save();
        $profile = new AgentProfile;
        $profile->agency_registered_name = 'Agent Bangla';
        $profile->agent_code = 'agent';
        $profile->agency_country = 1;
        $profile->user_id = $user->id;
        $profile->first_name = 'Agent';
        $profile->save();

        $names = array( "Dewalt", "Ebner", "Frick", "Hancock", "Haworth", "Hesch", "Hoffman", "Kassing", "Knutson", "Lawless" );
        foreach($names as $name){
            // Create default user for each role
            $user = \App\User::create([
                'name' => $name . ' Agency',
                'email' => $name.'@app.com',
                'status' => 1,
                'phone' => '0123456789',
                'password' => bcrypt('password'),
                'public_id' => time().md5($name.'@app.com'),
            ]);

            $user->attachRole('agent');

            $profile = new AgentProfile;
            $profile->agent_code = time();
            $profile->agency_registered_name = $name . ' Agency';
            $profile->agency_country = 1;
            $profile->user_id = $user->id;
            $profile->first_name = $name;
            $profile->save();
        }
    }
}
