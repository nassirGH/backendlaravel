<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Transactions;
use Exception;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * @var
    */
    protected $category;

    /**
     * TransactionsController constructor.
     */
    public function __construct()
    {
        try{

        $this->category = JWTAuth::parseToken()->authenticate();

        }
        catch(Exception $error){
            
        }
    }

    /**
        * @return mixed
    */
    public function index()
    {
        $transaction = $this->category->Transactions()->get(['title', 'description'])->toArray();

        return $transaction;
    }

    
    /**
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function show($id)
    {
        $transaction = $this->category->Transactions()->find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return $transaction;
    }




    /**
        * @param Request $request
        * @return \Illuminate\Http\JsonResponse
        * @throws \Illuminate\Validation\ValidationException
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required' ,
            'type' => 'required'
        ]);

        $transaction = new Transactions();
        $transaction->title = $request->title;
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->type =$request->type;

        if($transaction->type === 'fixed'){
            $transaction->start_date = $request->start_date;;
            $transaction->end_date = null;
        }
        elseif($transaction->type === 'recurring'){
            $transaction->start_date = null;
            $transaction->end_date = null;
        }
        else{
            if($transaction->type === 'goal'){
                //certain calculations...
            }
        }

        if ($this->category->Transactions()->save($transaction))
            return response()->json([
                'success' => true,
                'transaction' => $transaction
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction could not be added.'
            ], 500);
    }



    /**
        * @param Request $request
        * @param $id
         * @return \Illuminate\Http\JsonResponse
    */
    public function update(Request $request, $id)
    {
        $transaction = $this->category->Transactions()->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $transaction->fill($request->all())->save();
        
        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction could not be updated.'
            ], 500);
        }   
    }



    /**
        * @param $id
        * @return \Illuminate\Http\JsonResponse
    */
    public function destroy($id)
    {
        $transaction = $this->category->Transactions()->find($id);
        
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction with id ' . $id . ' cannot be found.'
            ], 400);
        }

        if ($transaction->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'transaction could not be deleted.'
            ], 500);
        }
    }













}

