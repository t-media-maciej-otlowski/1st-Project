<?php

use Documents\DocumentFile;

class DocumentsFilesTableSeeder extends Seeder {

    public function run() {


        $dFile = DocumentFile::create([
        
        'documents__id' => 2,
        'name' => 'PIT',
        'fullaname' => 'value1',
        'extension' => 'pdf',
        'hash'=>  hash('sha512', 'fullname')
        ]);

        // DB::rollback()
    }

}
