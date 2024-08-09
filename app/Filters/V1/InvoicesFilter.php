<?php

namespace App\Filters\V1;

class InvoicesFilter extends ApiFilter {
    protected $safeParams = [
        'customerId' => ['eq'],
        'amount'     => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'status'     => ['eq', 'ne'],
        'paidDate'   => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'billedDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate'   => 'paid_date',
    ];

    protected $operatorMap = [
        'eq'  => '=',
        'gt'  => '>',
        'lt'  => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne'  => '!='
    ];
}