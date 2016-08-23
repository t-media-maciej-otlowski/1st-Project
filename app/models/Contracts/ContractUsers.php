<?php

namespace Contracts;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Contracts\Contract;
use Contracts\ContractCosts;

class ContractUsers extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'contracts_users';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'contracts__object_id',
        'users__id',
        'description'
        
    ];

    public function contract() {
        return $this->belongsTo('Contracts\Contract', 'contracts__object_id', 'object_id');
    }
    
}
