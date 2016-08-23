<?php

namespace Contracts;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Contracts\ContractCosts;
use Contracts\ContractUsers;

class Contract extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'contracts';
    protected $date = ['deleted_at'];
    protected $softDelete = true;
    protected $fillable = [
        'object_id',
        'contractors__id',
        'contract_number',
        'enquiry_number',
        'enquiry_received_at',
        'offer_number',
        'offer_send_at',
        'offer_valid_to',
        'offer_approved_at',
        'offer_value',
        'offer_value_currency',
        'protocol_number',
        'protocol_created_at',
        'invoice_number',
        'invoice_created_at',
        'invoice_payment_to',
        'description'
    ];

    public function costs() {
        return $this->hasMany('Contracts\ContractCosts', 'contracts__object_id', 'object_id');
    }
    public function users()
            {
        return $this->hasMany('Contracts\ContractUsers', 'contracts__object_id', 'object_id');
            }

}
