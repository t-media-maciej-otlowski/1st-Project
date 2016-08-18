<?php

namespace Documents;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Documents\DocumentAttributes;
use Documents\DocumentGroup;

class Document extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'documents';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'name',
        'documents_groups__id',
        'description',
        'type',
        'order_number',
        'user__id'
    ];

    public function attributes() {
        return $this->hasMany('Documents\DocumentAttributes', 'documents__id',  'id');
    }
    public function group() {
        return $this->belongsTo('Documents\DocumentGroup','documents_groups__id', 'id');
    }
    
    //Relations
    //hasMany, belongsTo
    //hasMany(model, id ,laczace__id)
    //belongsTo(model,laczace_id,id )
    /*  

    

    public function files() {
        return $this->hasMany('DocumentFiles', 'id', 'documents__id');
    }

    public function user() {
        return $this->belongsTo('User', 'user__id', 'id');
    }

    /* public function confirmWithAttributes($confirm) {
      $accept = DocumentAttributes::createAttribute($confirm);
      if (!$accept) {
      return null;
      }
      }
     */
}
