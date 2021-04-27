<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\NewTransaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Requests\UpdateTransactionStatusRequest;

//Transaction Status constants
define('CREATED_T_STATUS', 1);
define('ACCEPTED_T_STATUS', 2);
define('COMPLETED_T_STATUS', 3);
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

        $transactions->load('skill');
        $transactions->load('transactionStatusHistory');

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
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

        $transaction->transactionStatusHistory()->attach(CREATED_T_STATUS, ['remarks' => 'Transaction has been created.']);

        $transaction->load('skill', 'transactionStatusHistory');

        broadcast(new NewTransaction($transaction))->toOthers();

        return response()->json([
            'message' => 'New transaction has been created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        // $transaction->load('Skill');
        // $transaction->load('transactionStatusHistory');
        // $transaction->load('Hailer');
        // $transaction->load('Worker');
        $transaction->load('skill', 'transactionStatusHistory', 'hailer', 'worker');

        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return response()->json([
            'message' => 'Transaction details has been updated.'
        ]);
    }

    public function updateTransactionStatus(UpdateTransactionStatusRequest $request, Transaction $transaction)
    {
        switch($request->status){
            case 1:
                $remark = 'Transaction has been created.';
            break;
            case 2:
                $remark = 'Transaction has been accepted.';
            break;
            case 3:
                $remark = 'Transaction has been completed.';
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

        $transaction->transactionStatusHistory()->attach($request->status, ['remarks' => $remark]);

        return response()->json([
            'message' => 'Transaction status has been updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
