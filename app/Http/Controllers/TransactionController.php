<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//Transaction Status constants
define('CREATED_T_STATUS', 1);
define('ACCEPTED_T_STATUS', 2);
define('ONGOING_T_STATUS', 3);
define('FINISHED_T_STATUS', 4);
define('PAID_T_STATUS', 5);
define('REJECTED_T_STATUS', 6);

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'worker_id'         => 'required',
            'skill_id'          => 'required',
            'job_description'   => 'required',
            'transaction_long'  => 'numeric|required',
            'transaction_lat'   => 'numeric|required',
            'total_cost'        => 'numeric|required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->all());
        }

        $transaction = Transaction::create([
            'hailer_id'         => Auth::id(),
            'worker_id'         => $request->worker_id,
            'skill_id'          => $request->skill_id,
            'job_description'   => $request->job_description,
            'transaction_long'  => $request->transaction_long,
            'transaction_lat'   => $request->transaction_lat,
            'actions_taken'     => '',
            'job_durations'     => 1,
            'total_cost'        => $request->total_cost
        ]);

        $transaction->TransactionStatusHistory()->attach(CREATED_T_STATUS, ['remarks' => 'Transaction has been created.']);

        return response()->json([
            'message' => 'New transaction has been created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
