
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Documents;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DocumentAttributes extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'documents_attributes';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'documents__id',
        'name',
        'value',
        'type'
    ];

    public function document() {
        return $this->belongsTo('Document', 'documents__id', 'id');
    }

    /*
      public function createAttribute($document) {
      $param = [
      'documentId' => $document->id,
      'name' => $document->type . str_random(3),
      'description' => str_random(10),
      'confirmed' => (bool) rand(0, 1)
      ];
      $attribute = self::create($param);
      return $attribute;
      }
     * 
     */
}
