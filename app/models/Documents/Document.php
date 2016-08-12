<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Documents;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

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

    //Relations
    //hasMany, belongsTo
    //hasMany(model, id ,laczace__id )
    //belongsTo(model,laczace_id,id  )
    public function attributes() {
        return $this->hasMany('DocumentAttributes', 'id', 'documents__id');
    }

    public function group() {
        return $this->belongsTo('DocumentGroup', 'documents_groups__id', 'id');
    }

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
