<?php

namespace App\Http\Controllers;

use App\Imports\ClientsImport;
use App\Models\User;
use App\Models\Client;
use App\Models\Repair;
use Illuminate\Http\Request;
use App\Exports\ClientsExport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Client::query();

        // Check if search query is present
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('firstName', 'like', '%' . $search . '%')
                    ->orWhere('lastName', 'like', '%' . $search . '%')
                    ->orWhere('cin', 'like', '%' . $search . '%')
                    ->orWhere('phoneNumber', 'like', '%' . $search . '%');
            });
        }

        // Fetch clients based on user role
        if ($user->role == 'Admin') {
            // If the user is an admin, fetch all clients
            $clients = $query->get();
        } else {
            // If the user is a client, fetch only their own client details
            $clients = $query->where('id', $user->id)->get();
        }

        return view('client.index', compact('clients'));
    }


    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'cin' => 'required|string|unique:mechanics,cin|unique:clients,cin|regex:/^[A-Z][0-9]{6}$/',
            'address' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->username = $validatedData['firstName'] . '_' . $validatedData['lastName'];
        $user->password = bcrypt($validatedData['password']);
        $user->email = $validatedData['email'];
        $user->role = 'Client';

        $user->save();

        $user_id = $user->id;

        $client = new Client();
        $client->firstname = $validatedData['firstName'];
        $client->lastname = $validatedData['lastName'];
        $client->cin = $validatedData['cin'];
        $client->address = $validatedData['address'];
        $client->phoneNumber = $validatedData['phoneNumber'];
        $client->userId = $user_id;

        $client->save();

        // Optionally, you can redirect the user to a different page after the client is created
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $repairs = Repair::where('clientId', $client->id)->get();
        $user = User::where('id', $client->userId)->first();

        return view('client.show', compact('client', 'user', 'repairs'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $userEmail = User::findOrFail($client->userId)->email;
        return view('client.update', compact('client', 'userEmail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'cin' => [
                'required',
                'string',
                Rule::unique('mechanics')->ignore($id),
                Rule::unique('clients')->ignore($id),
                'regex:/^[A-Z][0-9]{6}$/',
            ],
            'address' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($client->userId),
            ],
            'password' => 'nullable|min:8',
        ]);



        $client->firstname = $validatedData['firstName'];
        $client->lastname = $validatedData['lastName'];
        $client->cin = $validatedData['cin'];
        $client->address = $validatedData['address'];
        $client->phoneNumber = $validatedData['phoneNumber'];

        $user = User::findOrFail($client->userId);
        $user->email = $validatedData['email'];


        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();
        $client->save();

        // Optionally, you can redirect the user to a different page after the client is updated
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function export()
    {
        try {
            return Excel::download(new ClientsExport, 'clients.xlsx');
        } catch (\Exception $e) {
            return back()->withError('Failed to export clients. Please try again later.');
        }
    }

    public function import()
    {
        Excel::import(new ClientsImport, request()->file('file'));
        return back()->with('success', 'File imported successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        User::destroy($client->userId);

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
