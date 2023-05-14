<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(GeneralData::class);
        $this->call(MaidSeeder::class);
        $this->call(WorkerSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(EmployerSeeder::class);
        $this->call(SkillSeeder::class);
    }
}
