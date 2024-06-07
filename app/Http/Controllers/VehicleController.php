<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Vehicle::query();

        // Check if search query is present
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('make', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhere('license_plate', 'like', '%' . $search . '%')
                    ->orWhere('vin', 'like', '%' . $search . '%');
            });
        }

        // Fetch vehicles based on user role
        if ($user->role == 'Admin') {
            // If the user is an admin, fetch all vehicles
            $vehicles = $query->get();
        } else {
            // If the user is a client, fetch only their own vehicles
            $client = Client::where('userId', $user->id)->first();
            $vehicles = $query->where('clientId', $client->id)->get();
        }

        return view('vehicle.index', compact('vehicles'));
    }


    public function create()
    {
        return view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|unique:vehicles,license_plate|regex:/^[A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4}$/',
            'vin' => 'required|string|unique:vehicles,vin|regex:/^[A-HJ-NPR-Z0-9]{17}$/',
            'fuelType' => 'required|string|in:Gasoline (Petrol),Diesel,Ethanol,Compressed Natural Gas (CNG),Liquefied Petroleum Gas (LPG)',
        ]);

        // If the authenticated user is an admin, check for the client based on the provided CIN
        if (auth()->user()->role == 'Admin') {
            // Check if the CIN field is provided
            if ($request->has('cin')) {
                $client = Client::where('cin', $request->cin)->first();

                if (!$client) {
                    return redirect()->back()->withErrors(['clientCIN' => 'Client not found with the provided CIN.']);
                }
                $clientId = $client->id;
            } else {
                // If no CIN is provided, return an error
                return redirect()->back()->withErrors(['clientCIN' => 'Please provide the client CIN.']);
            }
        } else {
            // For non-admin users, use the authenticated user's ID as the client ID
            $client = Client::where('userId', auth()->user()->id)->first();
            $clientId = $client->id;
        }

        // Create a new Vehicle instance
        $vehicle = new Vehicle();
        $vehicle->make = $validatedData['make'];
        $vehicle->model = $validatedData['model'];
        $vehicle->year = $validatedData['year'];
        $vehicle->license_plate = $validatedData['license_plate'];
        $vehicle->vin = $validatedData['vin'];
        $vehicle->fuelType = $validatedData['fuelType'];
        $vehicle->clientId = $clientId;

        // Save the vehicle instance
        $vehicle->save();

        // Redirect back to the index page with a success message
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }


    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $clientCIN = Client::findOrFail($vehicle->clientId)->cin;
        return view('vehicle.update', compact('vehicle', 'clientCIN'));
    }

    public function update(Request $request, string $id)
    {
        // Find the vehicle to update
        $vehicle = Vehicle::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id . '|regex:/^[A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4}$/',
            'vin' => 'required|string|unique:vehicles,vin,' . $vehicle->id . '|regex:/^[A-HJ-NPR-Z0-9]{17}$/',
            'fuelType' => 'required|string|in:Gasoline (Petrol),Diesel,Ethanol,Compressed Natural Gas (CNG),Liquefied Petroleum Gas (LPG)',
        ]);

        // If the authenticated user is an admin, check for the client based on the provided CIN
        if (auth()->user()->role == 'Admin') {
            // Check if the CIN field is provided
            if ($request->has('cin')) {
                $client = Client::where('cin', $request->cin)->first();

                if (!$client) {
                    return redirect()->back()
                        ->withErrors(['clientCIN' => 'Client not found with the provided CIN.'])
                        ->withInput(); // Repopulate the form fields with the previously submitted values
                }

                // Assign the found client's ID to the vehicle
                $vehicle->clientId = $client->id;
            }
        }

        // Update the vehicle details
        $vehicle->make = $validatedData['make'];
        $vehicle->model = $validatedData['model'];
        $vehicle->year = $validatedData['year'];
        $vehicle->license_plate = $validatedData['license_plate'];
        $vehicle->vin = $validatedData['vin'];
        $vehicle->fuelType = $validatedData['fuelType'];

        // Save the updated vehicle instance
        $vehicle->save();

        // Redirect back to the index page with a success message
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }


    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

}
