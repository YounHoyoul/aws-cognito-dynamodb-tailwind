<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DynamoTable extends \BaoPham\DynamoDb\DynamoDbModel
{
    use HasFactory;

    protected $fillable = [
        'pk',
        'sk',
        'data',

        'name',
        'email',
        'password',
        'email_verified_at',
        'remember_token',

        'title',
        'message',

        'sequence_number'
    ];
}