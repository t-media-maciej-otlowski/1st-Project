<?php

use Documents\DocumentGroup;

class DocumentsGroupsTableSeeder extends Seeder {

    public function run() {

        try {
            //\DB::beginTransaction();
            //   \DB::table('users')->truncate();
            $dGroup = DocumentGroup::create([
                        'id_parent' => null,
                        'name' => 'ToolsDevice',
                        'description' => 'This table shows group of Tools',
                        'number' => '8',
            ]);
            DocumentGroup::create([
                'id_parent' => $dGroup->id,
                'name' => 'GeneralTools',
                'description' => 'Description of GeneralTools',
                'number' => '8.1',
            ]);
            DocumentGroup::create([
                'id_parent' => $dGroup->id,
                'name' => 'Measuring',
                'description' => 'Description of Measuring',
                'number' => '8.2',
            ]);
            unset($dGroup);

            $dGroup = DocumentGroup::create([
                        'id_parent' => null,
                        'name' => 'Processing',
                        'description' => 'This table shows group of Processing',
                        'number' => '9',
            ]);
            DocumentGroup::create([
                'id_parent' => $dGroup->id,
                'name' => 'TurnMedium',
                'description' => 'Description of Turn(medium)',
                'number' => '9.1',
            ]);
            DocumentGroup::create([
                'id_parent' => $dGroup->id,
                'name' => 'TurnComplex',
                'description' => 'Description of Turn Complex',
                'number' => '9.2',
            ]);
        } catch (Exception $ads) {
            // DB::rollback()
        }
    }

}
