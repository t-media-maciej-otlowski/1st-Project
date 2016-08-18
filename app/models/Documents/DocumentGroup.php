<?php

namespace Documents;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DocumentGroup extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'documents_groups';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'id_parent',
        'name',
        'description',
        'number'
    ];

    /*  public function documents() {
      return $this->hasMany('Document', 'id', 'documents_groups__id');
      }

     */
}
