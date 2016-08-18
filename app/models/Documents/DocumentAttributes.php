<?php

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
     
}
