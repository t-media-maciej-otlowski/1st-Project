<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DocumentSeeder extends Seeder {

    public function run() {

        try {
            //\DB::beginTransaction();
            //   \DB::table('users')->truncate();

            $doc = ['PIT', 'ZUS', 'PZU'];
            for ($i = 0; $i < 2; $i++) {

                $document = Document::create([
                            'type' => $doc[rand(0, 2)] . str_random(3)
                ]);
            }
        } catch (Exception $ads) {
            // DB::rollback();
        }
    }

}
