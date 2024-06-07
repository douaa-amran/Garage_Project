<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index()
    {
        $spareparts = SparePart::all();

        return view('spareparts.index', compact('spareparts'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('spareparts.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'required|string|unique:spareparts,reference|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'supplier' => 'required|exists:suppliers,id',
        ]);

        $sparePart = new SparePart();
        $sparePart->name = $validatedData['name'];
        $sparePart->reference = $validatedData['reference'];
        $sparePart->stock = $validatedData['stock'];
        $sparePart->price = $validatedData['price'];
        $sparePart->supplierId = $validatedData['supplier'];

        $sparePart->save();

        return redirect()->route('spareparts.index')->with('success', 'Spare part created successfully.');
    }

    public function edit($id)
    {
        $sparepart = SparePart::findOrFail($id);
        $suppliers = Supplier::all();
        return view('spareparts.update', compact('sparepart', 'suppliers'));
    }

    public function update(Request $request, SparePart $sparepart)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'required|string|unique:spareparts,reference,' . $sparepart->id . '|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'supplier' => 'required|exists:suppliers,id',
        ]);

        $sparepart->name = $validatedData['name'];
        $sparepart->reference = $validatedData['reference'];
        $sparepart->stock = $validatedData['stock'];
        $sparepart->price = $validatedData['price'];
        $sparepart->supplierId = $validatedData['supplier'];

        $sparepart->save();

        return redirect()->route('spareparts.index')->with('success', 'Spare part updated successfully.');
    }

    public function destroy(SparePart $sparepart)
    {
        $sparepart->delete();

        return redirect()->route('spareparts.index')->with('success', 'Mechanic deleted successfully.');
    }

}
