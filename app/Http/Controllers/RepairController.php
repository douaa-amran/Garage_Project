<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Repair;
use App\Models\Vehicle;
use App\Models\Mechanic;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    // Display all repairs
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Fetch all repairs if the user is an admin
            $repairs = Repair::all();
        } else {
            // Fetch only the repairs related to the logged-in user if the user is a client
            $client = Client::where('userId', $user->id)->first();
            $repairs = Repair::where('clientId', $client->id)->get();
        }

        return view('client.show', compact('client','repairs'));
    }

    // Show the form to create a new repair
    public function create($id)
    {
        $mechanics = Mechanic::all();
        $vehicles = Vehicle::where('clientId', $id)->get();
        return view('repair.create', compact('mechanics', 'vehicles'))->with('clientId', $id);
    }


    // Store a newly created repair in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
            'clientId' => 'required|exists:clients,id',
            'mechanicId' => 'required|exists:mechanics,id',
            'vehicleId' => 'required|exists:vehicles,id',
        ]);

        Repair::create($validatedData);

        return redirect()->route('clients.show', $validatedData['clientId'])->with('success', 'Repair created successfully.');
    }


    // Show the form to edit a repair
    public function edit($id)
    {
        $repair = Repair::findOrFail($id);
        $mechanics = Mechanic::all();
        $vehicles = Vehicle::where('clientId', $repair->clientId)->get();
        return view('repair.update', compact('repair', 'mechanics', 'vehicles'))->with('clientId', $id);
    }

    // Update the specified repair in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
            'clientId' => 'required|exists:clients,id',
            'mechanicId' => 'required|exists:mechanics,id',
            'vehicleId' => 'required|exists:vehicles,id',
        ]);

        // Find the repair
        $repair = Repair::findOrFail($id);

        // Update the repair
        $repair->update($validatedData);

        // Redirect to the index page with success message
        return redirect()->route('clients.show', $validatedData['clientId'])->with('success', 'Repair created successfully.');
    }

    public function show($id)
    {
        $repair = Repair::findOrFail($id);
        return view('repair.show', compact('repair'));
    }

    // Delete the specified repair from the database
    public function destroy($id)
    {
        $repair = Repair::findOrFail($id);

        $repair->delete();

        return redirect()->back()->with('success', 'Repair deleted successfully.');
    }

}
