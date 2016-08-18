<?php

namespace Documents;

use Documents\Document;

//use Documents\DocumentGroup;

class DocumentsController extends \ServerController {

    public function showDocuments() {
        try {
            $params = \Input::all();
            //validacja
            $validator = \Validator::make($params, [
                        'with_attributes' => 'boolean'
            ]);

            if ($validator->fails()) {
                return self::responseError($validator->errors(), '0011');
            }

            $query = Document::whereNull('deleted_at');
            if (isset($params['with_attributes']) && $params['with_attributes'] == true) {
                $query->with('attributes');
           } 
           
            $documents = $query->get();

            return self::responseJson($documents);

            //return self::responseJson($documentsAttributes);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }


  public function showDocumentsInChoosenGroup() {
        try {
            $params = \Input::all();
            //validacja
            $validator = \Validator::make($params, [
                        'with_group' => 'boolean'
            ]);

            if ($validator->fails()) {
                return self::responseError($validator->errors(), '0011');
            }

            $query = Document::whereNull('deleted_at');
//            if (isset($params['with_attributes']) && $params['with_attributes']) {
//                
//           }
            $query->with('group');
            $documents = $query->get();

            return self::responseJson($documents);

            //return self::responseJson($documentsAttributes);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

}


//    public function showDocumentsInChoosenGroup() {
//       try {
//          $params = \Input::all();        
//         $validator = \Validator::make($params,[
//             
//            $query = Document::whereNull('deleted_at');
//           if (isset($params['with_group']) && $params['with_group']) {
//           }
//           $documents = $query->get();
//
//            return self::responseJson($documents);
//          
//       } catch (Exception $ex) {
//            return self::responseError($ex->getMessage(), 'error', null);
//       }
//    }

//}

//            $param = \Input::all();
//
//            $validator = \Validator::make($param, array(
//                        'documents__id' => 'numeric|exists:documents_attributes'
//            ));
////dd($param);
//
//            if ($validator->fails()) {
//                return self::responseJson($validator->errors(), '0011', 'ERROR!');
//            }
//            \

// $docAtt = DocumentAttributes::whereNull('documents__id')->get();
//            
//            $param = [1,2,3,4,5];   
//            
//            $docAtt = Document::where('documents_gid', '=', $param[4])->get();
//            dd($docAtt);
//
//
//
//
//            if (isset($param['documents__id'])) {
//                $query->where('id', $param['documents__id']);
//
//                $docs = $query->orderBy('id', 'ASC')->get();
//                return self::responseJson($docs);
//            foreach ($docAtt as $docAt) {
//                $query = Document::where('id', '=', $docAt)->get();
//                 dd($query);
//            }
//           
            
       
