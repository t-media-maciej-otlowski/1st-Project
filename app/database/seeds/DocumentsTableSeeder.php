<?php

use Documents\Document;
use Documents\DocumentGroup;
use Documents\DocumentAttributes;
use Documents\DocumentFile;

class DocumentsTableSeeder extends Seeder {

    public function run() {
        //  $dGr = DocumentGroup::where('id', '=', 5)->first();
        DB::table('documents')->truncate();
        DB::table('documents_groups')->truncate();
        DB::table('documents_attributes')->truncate();
        DB::table('documents_files')->truncate();
        // $documents = [];
        $documents = [
            // 8.1
            [
                'name' => 'Lifereschein & CofC',
                'number' => '8,1',
                'description' => '',
                'type' => 'CofC',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            [
                'name' => 'Betriebsanieltung',
                'number' => '8,1',
                'description' => '',
                'type' => '..',
                'params' => []
            ],
            // 8.2
            [
                'name' => 'Lifereschein & CofC',
                'number' => '8,2',
                'description' => '',
                'type' => 'CofC',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            [
                'name' => 'Kalibrierzertifikate',
                'number' => '8,2',
                'description' => 'DIN EN ISO/IEC 17025',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            // 9.1
            [
                //1
                'name' => 'Lifereschein & CofC',
                'number' => '9.1',
                'description' => '',
                'type' => 'CofC',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            [
                //2
                'name' => 'FAI Report(EN9102)',
                'number' => '9.1',
                'description' => 'MSH BS 10053225',
                'type' => '',
                'params' => ['A', 'B', 'C']
            ],
            [
                //3
                'name' => 'Kennzeichnung',
                'number' => '9.1',
                'description' => 'MSH BS 10034244',
                'type' => '',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            //4
            [
                'name' => 'Prutmenge',
                'number' => '9.1',
                'description' => 'MSH BS 10052575',
                'type' => '',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            //5
            [
                'name' => 'Rohmaterial',
                'number' => '9.1',
                'description' => 'EN 10204',
                'type' => '3.1',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
            //6
            [
                'name' => 'Gewicht',
                'number' => '9.1',
                'description' => '',
                'type' => '',
                'params' => ['A', 'B', 'C', 'TEST']
            ],
            //6
            [
                'name' => 'Spezielle Prufungen',
                'number' => '9.1',
                'description' => 'MSH TOP',
                'type' => '',
                'params' => ['A', 'B', 'C', 'D', 'TEST']
            ],
        ];


        foreach ($documents as $docData) {
            // get details d.group   
       
            $documentGroup = DocumentGroup::create([
                        'id_parent' => NULL,
                        'name' => 'Warendetailgruppe',
                        'description' => 'Spezifikation',
                        'number' => $docData['number']
            
            ]);
            // create
            $document = Document::create([
                        'name' => $docData['name'],
                        'documents_groups__id' => $documentGroup->id,
                        'description' => $docData['description'],
                        'type' => 'type',
                        'order_number' => $docData['number'],
                        'user__id' => 20
            ]);
            $document2 = DocumentFile::create([
                
                'name' => $docData['name'],
                'documents__id' => $document->id,
                'fullname' => '['.$docData['name'].']'.'.doc' ,
                'extension' => 'pdf',
                'hash' => hash('md5',$docData['name'].date('Y-m-d H:i:s:u') )
                
            ]);
            // dc. attr
            foreach ($docData['params'] as $param) {
                $documentAttribute = DocumentAttributes::create([
                            // id dokumentu
                            'documents__id' => $document->id,
                            'name' => $param,
                            'type' => 'BOOL',
                            'value' => '1'
                ]);
            }
        }
    }

}
