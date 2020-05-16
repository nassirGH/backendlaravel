<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * @var string
     */
    protected $table = 'Categories';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
        * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function Categories()
    {
        return $this->hasMany(Transactions::class);
    }



}