<?php

namespace Database\Seeders;

use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected array $hostUsers = [
        [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@airqueue.live',
        ],
        [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'janedoe@airqueue.live',
        ],
        [
            'first_name' => 'Jake',
            'last_name' => 'Smith',
            'email' => 'jakesmith@airqueue.live',
        ],
    ];

    public function run(): void
    {
        $this->adminUser();
        $this->hostUsers();
    }

    protected function adminUser(): void
    {
        $adminUser = User::factory()->create([
            'first_name' => 'Dev',
            'last_name' => 'Admin',
            'email' => 'dev@airqueue.live',
            'password' => bcrypt('password'),
        ]);

        $adminBand = Band::factory()->create([
            'owner_id' => $adminUser->id,
            'name' => 'AirQueue',
            'description' => 'AirQueue is the best band in the world!',
        ]);

        BandUser::factory()->create([
            'band_id' => $adminBand->id,
            'user_id' => $adminUser->id,
            'has_accepted' => true,
        ]);

        $this->attachBandMembers($adminBand);
    }

    protected function hostUsers(): void
    {
        foreach ($this->hostUsers as $hostUser) {
            $user = User::factory()->create([
                'first_name' => $hostUser['first_name'],
                'last_name' => $hostUser['last_name'],
                'email' => $hostUser['email'],
                'password' => bcrypt('password'),
            ]);

            $band = Band::factory()->create([
                'owner_id' => $user->id,
                'name' => $user->first_name.' '.$user->last_name.' Band',
                'description' => 'This is the band of '.$user->first_name.' '.$user->last_name,
            ]);

            BandUser::factory()->create([
                'band_id' => $band->id,
                'user_id' => $user->id,
                'has_accepted' => true,
            ]);

            $this->attachBandMembers($band);
        }
    }

    protected function attachBandMembers(Band $band): void
    {
        User::factory(5)->create()->each(function ($user) use ($band) {
            BandUser::factory()->create([
                'band_id' => $band->id,
                'user_id' => $user->id,
                'has_accepted' => true,
            ]);
        });
    }
}
