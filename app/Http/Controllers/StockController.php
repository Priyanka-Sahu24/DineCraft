<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? "";

        $stocks = Stock::where('item_name','LIKE',"%$search%")
                        ->orderBy('id','desc')
                        ->get();

        return view('stock.manage', compact('stocks','search'));
    }

    public function store(Request $request)
    {
        Stock::create([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect('/stock');
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        $stock->update([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
        ]);

        return redirect('/stock');
    }

    public function destroy($id)
    {
        Stock::destroy($id);
        return redirect('/stock');
    }

    public function exportExcel()
    {
        return Excel::download(new StockExport, 'stocks.xlsx');
    }
}
