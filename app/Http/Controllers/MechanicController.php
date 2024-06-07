<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mechanic::query();

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

        $mechanics = $query->get();

        return view('mechanic.index', compact('mechanics'));
    }


    public function create()
    {
        return view('mechanic.create');
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
            'recruitmentDate' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->username = $validatedData['firstName'] . '_' . $validatedData['lastName'];
        $user->password = bcrypt($validatedData['password']);
        $user->email = $validatedData['email'];
        $user->role = 'Mechanic';

        $user->save();

        $user_id = $user->id;

        $mechanic = new Mechanic();
        $mechanic->firstname = $validatedData['firstName'];
        $mechanic->lastname = $validatedData['lastName'];
        $mechanic->cin = $validatedData['cin'];
        $mechanic->address = $validatedData['address'];
        $mechanic->phoneNumber = $validatedData['phoneNumber'];
        $mechanic->recruitmentDate = $validatedData['recruitmentDate'];
        $mechanic->userId = $user_id;

        $mechanic->save();

        // Optionally, you can redirect the user to a different page after the client is created
        return redirect()->route('mechanics.index')->with('success', 'Mechanic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    public function edit($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        $userEmail = User::findOrFail($mechanic->userId)->email;
        return view('mechanic.update', compact('mechanic', 'userEmail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mechanic = Mechanic::findOrFail($id);

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
            'recruitmentDate' => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($mechanic->userId),
            ],
            'password' => 'nullable|min:8',
        ]);



        $mechanic->firstname = $validatedData['firstName'];
        $mechanic->lastname = $validatedData['lastName'];
        $mechanic->cin = $validatedData['cin'];
        $mechanic->address = $validatedData['address'];
        $mechanic->phoneNumber = $validatedData['phoneNumber'];
        $mechanic->recruitmentDate = $validatedData['recruitmentDate'];

        $user = User::findOrFail($mechanic->userId);
        $user->email = $validatedData['email'];


        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();
        $mechanic->save();

        // Optionally, you can redirect the user to a different page after the client is updated
        return redirect()->route('mechanics.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mechanic = Mechanic::findOrFail($id);
        User::destroy($mechanic->userId);

        return redirect()->route('mechanics.index')->with('success', 'Mechanic deleted successfully.');
    }
}
