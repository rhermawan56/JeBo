<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index', [
            'title' => 'Admin',
            'header' => 'Transaction',
            'products' => Product::all(),
            'transactions' => Transaction::active()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $rule = [
            'product_id' => 'required',
            'order_by' => 'required',
            'qty' => 'required'
        ];

        $validated = $request->validate($rule);

        $validated['user_id'] = auth()->user()->id;

        $validated['status'] = "waiting";

        Transaction::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        @dd($transaction);
        return view('admin.index', [
            'title' => 'Admin',
            'header' => 'Transaction',
            'products' => Product::all(),
            'transactions' => Transaction::active()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateDone(Request $request, Transaction $transaction)
    {
        $data = $request->status;
        $trx = Transaction::firstWhere('id', $transaction->id);
        $trx['status'] = $data;
        $trx->save();
    }
}
