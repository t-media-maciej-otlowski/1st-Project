<?php
namespace Documents;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DocumentFile extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'documents_files';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'documents__id',
        'name',
        'fullname',
        'extension',
        'hash'
    ];

    public function document() {
        return $this->belongsTo('Document', 'id', 'documents__id');
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
