<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SparePart;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index($repairId)
    {
        $invoices = Invoice::where('repairId', $repairId)->get();

        $sparepartIds = $invoices->pluck('sparepartId');

        $spareparts = Sparepart::whereIn('id', $sparepartIds)->get()->keyBy('id');

        $repair = Repair::where('id', $repairId)->first();

        // Return a view with the invoices data
        return view('repair.show', compact('spareparts','repair','invoices'));
    }

    public function create($repairId)
    {
        $repair = Repair::findOrFail($repairId);
        $spareparts = Sparepart::all();

        return view('invoice.create', compact('repair', 'spareparts'));
    }

    public function store(Request $request, $repairId)
    {
        // Validate incoming request data
        $request->validate([
            'sparepartId' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1',
            'additionalCharges' => 'required|numeric|min:0',
        ]);

        // Fetch the spare part to get its price
        $sparepart = Sparepart::findOrFail($request->input('sparepartId'));

        // Calculate the total
        $quantity = $request->input('quantity');
        $additionalCharges = $request->input('additionalCharges');
        $total = ($quantity * $sparepart->price) + $additionalCharges;

        // Create a new invoice instance
        $invoice = new Invoice([
            'repairId' => $repairId,
            'sparepartId' => $request->input('sparepartId'),
            'quantity' => $quantity,
            'additionalCharges' => $additionalCharges,
            'total' => $total,
        ]);

        // Save the invoice to the database
        $invoice->save();

        // Redirect to the index page with a success message
        return redirect()->route('repairs.invoices',$repairId)->with('success', 'Invoice created successfully.');
        
    }

    public function edit($repairId, $invoiceId)
    {
        // Retrieve the invoice to be edited
        $invoice = Invoice::findOrFail($invoiceId);

        // Retrieve the spare parts for the dropdown menu
        $spareparts = SparePart::all();

        // Return the view with the invoice data and spare parts
        return view('invoice.update', compact('repairId','invoice', 'spareparts'));
    }

    public function update(Request $request, $repairId, $invoiceId)
    {
        // Validate incoming request data
        $request->validate([
            'sparepartId' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1',
            'additionalCharges' => 'required|numeric|min:0',
        ]);

        // Retrieve the invoice to be updated
        $invoice = Invoice::findOrFail($invoiceId);

        // Update the invoice with the new data
        $invoice->sparepartId = $request->input('sparepartId');
        $invoice->quantity = $request->input('quantity');
        $invoice->additionalCharges = $request->input('additionalCharges');

        // Calculate the total
        $sparepart = SparePart::findOrFail($invoice->sparepartId);
        $total = ($invoice->quantity * $sparepart->price) + $invoice->additionalCharges;
        $invoice->total = $total;

        // Save the updated invoice to the database
        $invoice->save();

        // Redirect to the index page with a success message
        return redirect()->route('repairs.invoices', $repairId)->with('success', 'Invoice updated successfully.');
    }

    public function destroy($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);

        $invoice->delete();

        return redirect()->back()->with('success', 'Invoice deleted successfully.');
    }
}
