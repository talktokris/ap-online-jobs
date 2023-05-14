<?php

use App\User;
use App\EmployerProfile;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'employer@app.com')->first();
        $profile = new EmployerProfile;
        $profile->user_id = $user->id;
        $profile->address = '39 Fake street';
        $profile->country = 1;
        $profile->company_name = 'Lorem Company';
        $profile->company_address = '29 Long Street';
        $profile->company_city = 1;
        $profile->save();
    }
}
