<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//Transaction Status constants
define('CREATED_T_STATUS', 1);
define('ACCEPTED_T_STATUS', 2);
define('FINISHED_T_STATUS', 3);
define('PAID_T_STATUS', 4);
define('REJECTED_T_STATUS', 5);

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display all transactions of loggedin user
        $transactions = Transaction::where('hailer_id', Auth::id())
                            ->orWhere('worker_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();
        $transactions->load('Skill');
        $transactions->load('transactionStatusHistory');
        $transactions->load('Hailer');
        $transactions->load('Worker');

        return response()->json($transactions);
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
        $transaction->load('latestStatus');
        $transaction->load('Hailer');
        $transaction->load('Worker');

        return response()->json($transaction);
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
        $validator = Validator::make($request->all(), [
            'job_description'   => 'required',
            'total_cost'        => 'numeric|required'
        ]);

        $transaction->job_description   = $request->job_description;
        $transaction->actions_taken     = (isset($request->actions_taken) ? $request->actions_taken : '' );
        $transaction->total_cost        = $request->total_cost;

        $transaction->save();

        return response()->json([
            'message' => 'Transaction details has been updated.'
        ]);
    }

    public function updateTransactionStatus(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required:numeric',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->all());
        }

        switch($request->status){
            case 1:
                $remark = 'Transaction has been created.';
            break;
            case 2:
                $remark = 'Transaction has been accepted.';
            break;
            case 3:
                $remark = 'Transaction has been finished.';
            break;
            case 4:
                $remark = 'Client has made payment for the transaction.';
            break;
            case 5:
                $remark = 'Worker has rejected the transacion.';
            break;
            default:
                return abort(response()->json([
                    'message' => 'Invalid transacion status.'
                ], 400));
        }

        $transaction->TransactionStatusHistory()->attach($request->status, ['remarks' => $remark]);

        return response()->json([
            'message' => 'Transaction status has been updated.'
        ]);
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
