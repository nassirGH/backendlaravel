<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /**
     * @var string
     */
    protected $table = 'Transactions';

    /**
     * @var array
     */
    protected $guarded = [];
}