<?php
use App\Role;
use App\User;
use App\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $maid = Role::where('name', 'maid')->first();
        $maid->display_name = 'DM';
        $maid->description = 'Domestic Maid';
        $maid->save();

        $user = User::where('email', 'maid@app.com')->first();
        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->name = $user->name;
        $profile->phone = $user->phone;
        $profile->agent_code = 'agent';
        $profile->save();
        //$names = array( "Pak", "Pettigrew", "Quinn", "Quizoz", "Ramachandran", "Resnick", "Sagar", "Schickowski", "Schiebel", "Sellon", "Severson", "Shaffer", "Solberg", "Soloman", "Sonderling", "Soukup", "Soulis", "Stahl", "Sweeney", "Tandy", "Trebil", "Trusela", "Trussel", "Turco", "Uddin", "Uflan", "Ulrich", "Upson", "Vader", "Vail", "Valente", "Van Zandt", "Vanderpoel", "Ventotla", "Vogal", "Wagle", "Wagner", "Wakefield", "Weinstein", "Weiss", "Woo", "Yang", "Yates", "Yocum", "Zeaser", "Zeller", "Ziegler", "Bauer", "Baxster", "Casal", "Cataldi", "Caswell", "Celedon", "Chambers", "Chapman", "Christensen", "Darnell", "Davidson", "Davis", "DeLorenzo", "Dinkins", "Doran", "Dugelman", "Dugan", "Duffman", "Eastman", "Ferro", "Ferry", "Fletcher", "Fietzer", "Hylan", "Hydinger", "Illingsworth", "Ingram", "Irwin", "Jagtap", "Jenson", "Johnson", "Johnsen", "Jones", "Jurgenson", "Kalleg", "Kaskel", "Keller", "Leisinger", "LePage", "Lewis", "Linde", "Lulloff", "Maki", "Martin", "McGinnis", "Mills", "Moody", "Moore", "Napier", "Nelson", "Norquist", "Nuttle", "Olson", "Ostrander", "Reamer", "Reardon", "Reyes", "Rice", "Ripka", "Roberts", "Rogers", "Root", "Sandstrom", "Sawyer", "Schlicht", "Schmitt", "Schwager", "Schutz", "Schuster", "Tapia", "Thompson", "Tiernan", "Tisler" );
        $names = array ("Lawicki", "Mccord", "McCormack", "Miller", "Myers", "Nugent", "Ortiz", "Orwig", "Ory", "Paiser");
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

            $user->attachRole('maid');

            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->agent_code = 'agent';
            $profile->name = $user->name;
            $profile->nationality = 1;
            $profile->marital_status = 2;
            $profile->phone = $user->phone;
            $profile->save();
        }
    }
}
