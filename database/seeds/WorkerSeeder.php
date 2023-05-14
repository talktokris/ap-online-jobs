<?php
use App\Role;
use App\User;
use App\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $worker = Role::where('name', 'worker')->first();
        $worker->display_name = 'GW';
        $worker->description = 'General Worker';
        $worker->save();

        $user = User::where('email', 'worker@app.com')->first();
        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->name = $user->name;
        $profile->phone = $user->phone;
        $profile->agent_code = 'agent';
        $profile->save();

        $names = array( "Anderson", "Ashwoon", "Aikin", "Bateman", "Bongard", "Bowers", "Boyd", "Cannon", "Cast", "Deitz" );
        foreach($names as $name){
            // Create default user for each role
            $user = \App\User::create([
                'name' => $name,
                'email' => $name.'@app.com',
                'status' => 1,
                'phone' => '0123456789',
                'password' => bcrypt('password'),
                'public_id' => time().md5($name.'@app.com'),
            ]);

            $user->attachRole('worker');

            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->agent_code = 'agent';
            $profile->name = $user->name;
            $profile->nationality = 2;
            $profile->marital_status = 1;
            $profile->phone = $user->phone;
            $profile->save();
        }
    }
}
