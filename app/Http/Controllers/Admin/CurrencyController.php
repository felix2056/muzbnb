<?php

namespace App\Http\Controllers\Admin;

use App\Model\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *  shows all Currencies
     *
     * @return void
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.currency.index',compact('currencies'));
    }

    /**
     *  Currency create form
     *
     * @return void
     */
    public function create()
    {
        $currency = new Currency();

        return view('admin.currency.create',compact('currency'));
    }

    /**
     *  Stores new Currency
     *
     * @return void
     */
    public function store(Request $request)
    {
        Currency::create($request->except('_token'));
        return redirect('/admin/currency');
    }
    /**
     *  Currency create form
     *
     * @return void
     */
    public function edit($currency)
    {
        $currency = Currency::find($currency);

        return view('admin.currency.edit',compact('currency'));
    }

    /**
     *  Currency create form
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $currency = Currency::find($id);
        $currency->update($request->except('_token'));

        return redirect('/admin/currency');
    }
    public function destroy($id)
    {
        Currency::where('id',$id)->firstOrFail()->delete();

        return back();

    }
}
