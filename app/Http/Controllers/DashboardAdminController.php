<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $randomStr = '';
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '12345';

        $strLength = strlen($str);
        $numLength = strlen($num);

        for ($i=0; $i < 5; $i++) { 
            $randomStr .= $str[rand(0, $strLength - 1)];
        }

        for ($i=0; $i < 3; $i++) { 
            $randomStr.= $num[rand(0, $numLength - 1)];
        }

        return view('admin.index', [
            'title' => 'Admin',
            'header' => 'Transaction',
            'products' => Product::all(),
            'transactions' => Transaction::active()->get(),
            'ii' => $request->ii,
            'order' => $randomStr
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
        // @dd($request->all());

        $rule = [
            'product_id' => 'required',
            'order_by' => 'required',
            'qty' => 'required',
            'payment' => 'gte:'.$request->total
        ];

        if (! $request->payment < $request->total || $request->select_order_item > 1) {
            unset($rule['payment']);
        }

        $validated = Validator::make($request->all(), $rule, $messages = [
            'gte' => 'The payment must be greater than or equal to Total.',
        ])->validate();

        $validated['status'] = "waiting";
        $validated['order_id'] = $request->order_id;
        $validated['total'] = $request->total;
        $validated['user_id'] = auth()->user()->id;
        unset($validated['payment']);

        // @dd($validated);

        Transaction::create($validated);

        if ($request->select_order_item > 1) {
            return redirect('/dashboard/transaction?ii=' . $request->select_order_item);
        } else {
            return redirect('/dashboard/transaction')->with('created', "Order has been made!");
        }
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
        if ($transaction->user_id === auth()->user()->id) {
            return view('admin.edit', [
                'title' => 'Admin',
                'header' => 'Edit Transaction',
                'products' => Product::all(),
                'transactions' => Transaction::active()->get(),
                'transaction' => $transaction
            ]);
        } else {
            return redirect('/dashboard/transaction')->with('forbidden', "not allowed!!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // @dd($request->all());
        $rule = [
            'product_id' => 'required',
            'qty' => 'required',
            'total' => 'required'
        ];

        $validated = $request->validate($rule);
        
        // @dd($validated);
        
        Transaction::where('id', $transaction->id)->update($validated);

        return redirect('/dashboard/transaction')->with('update', 'Order has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Transaction::where('id', $transaction->id)
            ->delete();

        return redirect('/dashboard/transaction')->with('delete', 'Order has been deleted!');
    }

    public function updateDone(Transaction $transaction)
    {
        $data = [
            'status' => "done"
        ];

        Transaction::where('id', $transaction->id)->update($data);
        return redirect('/dashboard/transaction');
    }
}
