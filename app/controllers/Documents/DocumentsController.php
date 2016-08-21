<?php

namespace Documents;

use Documents\Document;

//use Documents\DocumentGroup;

class DocumentsController extends \ServerController {

    public function listDocuments() {
        try {
            $params = \Input::all();
            $validator = \Validator::make($params, [
                        'with_group' => 'boolean',
                        'with_attributes' => 'boolean'
            ]);
            if ($validator->fails()) {
                return self::resposeJson($validator->errors(), 'error', null);
            }

            $query = Document::whereNull('deleted_at');

            if (isset($params['with_attributes']) && $params['with_attributes']) {
                $query->with('attributes');
            }
            if (isset($params['with_group']) && $params['with_group']) {
                $query->with('group');
            }
            if (isset($params['documents_groups__id']) && $params['documents_groups__id']) {
                $query->where('documents_groups__id', $params['documents_groups__id']);
            }

            $documents = $query->get();

            return self::responseJson($documents);
        } catch (Exception $ex) {
            return self::resposeJson($ex->getMessage(), 'error', null);
        }
    }

    public function addDocuments() {
        try {
            $param = \Input::all();
            $validator = \Validator::make($param, [
                        'with_group' => 'boolean',
                        'with_attributes' => 'boolean',
                        'with_files' => 'boolean'
            ]);
            if ($validator->fails()) {

                return self::resposeJson($validator->errors(), 'error', null);
            }
            $query = Document::create($param);

            if (isset($param['with_group']) && ($param['with_group']) == 1) {
                $query->with('group');
            }
            if (isset($param['with_attributes']) && ($param['with_attributes']) == 1) {
                $query->with('attributes');
            }
            if (isset($param['with_files']) && ($param['with_files']) == 1) {
                $query->with('file');
            }
            $documents = $query->get();

            return self::responseJson($documents);
        } catch (Exception $ex) {
            return self::resposeJson($ex->getMessage(), 'error', null);
        }
    }

    public function updateDocuments() {
        try {
            
        } catch (Exception $ex) {
            
        }
    }

    public function deleteDocuments() {
        try {
            $param = \Input::all();
            $validator = \Validator::make($param, [
                'with_group'=>'boolean',
                'with_attributes'=>'boolean',
                'with_files'=>'boolean'
            ]);
            if($validator->fails()){
                return self::responseJson($validator->errors(), 'error', null);
            }
            
            
        } catch (Exception $ex) {
            
        }
    }

}
