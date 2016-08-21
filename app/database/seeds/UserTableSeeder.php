<?php

use Users\User;

class UserTableSeeder extends Seeder {

    public function run() {

        try {
            //\DB::beginTransaction();

            DB::table('users')->truncate();

            for ($i = 0; $i < 10; $i++) {

                $user = User::create([
                            'name' => str_random(5),
                            'surname' => str_random(5),
                            'username' => 'user' . $i,
                            'password' => hash('sha512','surname')
                ]);
            }
        } catch (Exception $ads) {
            // DB::rollback();
        }
    }

}
