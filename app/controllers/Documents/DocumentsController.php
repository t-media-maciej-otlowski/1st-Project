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
                        'id' => 'required|numeric|exists:documents_groups',
                        'name' => 'string',
                        'description' => 'string',
                        'type' => 'string',
                        'order_number' => 'integer',
                        'user__id' => 'integer'
            ]);
            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error', null);
            }
            $document_group_id = DocumentGroup::where('id', '=', $param['id'])->first();
            // $document = Document::where('documents_groups_id','=',$param['id'])
            if (!$document_group_id) {
                return self::responseJson('DocumentGroup does not exist', 'error', null);
            }

            $document = Document::create($param);

            return self::responseJson($document);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

    public function updateDocuments() {
        try {
            $param = \Input::all();
            $validator = \Validator::make($param, [
                        'id' => 'required|numeric|exists:documents',
                        'name' => 'string',
                        'description' => 'string',
                        'type' => 'string',
                        'order_number' => 'integer',
                        'user__id' => 'integer'
            ]);
            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error', null);
            }
            $document = Document::where('id', '=', $param['id'])->first();
            if (!$document) {
                return self::responseJson('Document does not exist', 'error', null);
            }
            $document->update($param);
            return self::responseJson($document);
        } catch (Exception $ex) {

            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

    public function deleteDocuments() {
        try {
            $param = \Input::all();
            $validator = \Validator::make($param, array(
                        'id' => 'numeric|exists:documents',
                        'documents_groups_id' => 'numeric',
            ));
            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error', null);
            }
            if (isset($param['id']) && ($param['id'])) {
                $document = Document::where('id', '=', $param['id'])
                        ->first();
            }

            if (isset($param['documents_group_id']) && ($param['documents_group_id'])) {
                $document = Document::where('id', '=', $param['documents_group_id'])
                        ->first();
            }
            if (!$document) {
                return self::responseJson('Document not found', 'error', null);
            }

            $document->delete();
            return self::responseJson($document);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

}
