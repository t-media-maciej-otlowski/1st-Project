<?php

class DatabaseSeeder extends Seeder {

    public function run() {
        //$this->call('UserTableSeeder');
        //$this->call('DocumentsGroupsTableSeeder');
        $this->call('DocumentsTableSeeder');
//         $this->call('DocumentsFilesTableSeeder');
//         $this->call('DocumentsAttributesTableSeeder');
//        $this->command->info('TABLE SEEDED!');
    }

}
