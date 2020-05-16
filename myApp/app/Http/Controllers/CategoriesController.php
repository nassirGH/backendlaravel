<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Task;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //

    protected $Transaction;


    public function __construct()
    {
        $this->Transaction = JWTAuth::parseToken()->authenticate();
    }



}
