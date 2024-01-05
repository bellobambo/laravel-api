<?php

namespace App\Filters\V1;

use App\Filters\ApFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApFilter

{

    protected $safeParms = [
        'customer_id' => ['eq'],
        'amount' => ['eq' , 'lt' , 'gt' , 'lte' , 'gte'],
        'status' => ['eq' , 'ne'],
        'billed_date' =>  ['eq' , 'lt' , 'gt' , 'lte' , 'gte'],
        'paid_date' =>  ['eq' , 'lt' , 'gt' , 'lte' , 'gte'],

    ];

    protected $columnMap = [
        'customer_id' => 'customer_id',
        'billed_date' => 'billed_date',
        'paid_date' => 'paid_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];



}
