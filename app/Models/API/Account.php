<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Account extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'acct_number',
        'acct_balance',
        'user_id',
        'bank_id',
    ];
}
