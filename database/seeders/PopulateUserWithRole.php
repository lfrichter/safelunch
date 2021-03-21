<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PopulateUserWithRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $user = User::whereEmail('fernando.richter@gmail.com')->first();

        if (empty($user)) {
            $user = User::create([
                'name' => 'Fernando Richter',
                'email' => 'fernando.richter@gmail.com',
                'password' => bcrypt('12345678'),
            ]);

            $role = Role::whereName('admin')->first();
            $user->assignRole($role);
            $user->update();

            echo "Default user Amin id: $user->id sucessfully created!".PHP_EOL;
        }

        $role = Role::whereName('developer')->first();

        for ($i = 1; $i <= 10; ++$i) {
            $user = User::factory()->create();
            $user->assignRole($role);
        }
    }
}
