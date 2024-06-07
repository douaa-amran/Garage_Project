<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Repair;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF($repairId)
    {
        // Fetch repair details
        $repair = Repair::findOrFail($repairId);

        // Fetch client details
        $client = Client::where('id',$repair->clientId)->first();

        // Fetch all invoices related to the repair
        $invoices = Invoice::where('repairId',$repair->id)->get();

        // Calculate total of all invoice totals
        $total = $invoices->sum('total');

        // Load PDF view with data
        $pdf = Pdf::loadView('pdf.invoice', compact('repair', 'client', 'invoices', 'total'));

        // Download the PDF file
        return $pdf->download('invoice.pdf');
    }
}
