<?php

namespace Contracts;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Contracts\Contract;
use Contracts\ContractUsers;

class ContractCosts extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'contracts_costs';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'contracts__object_id',
        'type',
        'value',
        'value_currency'
    ];

    public function contract() {
        return $this->belongsTo('Contracts\Contract', 'contracts__object_id', 'object_id');
    }

}
