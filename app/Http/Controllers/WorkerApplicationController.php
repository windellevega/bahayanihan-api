<?php

namespace App\Http\Controllers;

use App\WorkerApplication;
use Illuminate\Http\Request;

//Worker Application Status constants
define('PENDING_WA_STATUS', 1);
define('ACCEPTED_WA_STATUS', 2);
define('REJECTED_WA_STATUS', 3);

class WorkerApplicationController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkerApplication  $workerApplication
     * @return \Illuminate\Http\Response
     */
    public function show(WorkerApplication $workerApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkerApplication  $workerApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkerApplication $workerApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkerApplication  $workerApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkerApplication $workerApplication)
    {
        //
    }
}
