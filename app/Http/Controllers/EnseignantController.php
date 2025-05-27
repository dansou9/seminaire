<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enseignants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
               'name' => ['required', 'string', 'max:255'],
               'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique'.User::class],
               'specialite' => ['required', 'string'], 
            ]);
        $role_id = Role::where('nom', 'Enseignant')->first();
        $random_password = Str::random(10);

        $validated['password'] = Hash::make($random_password);
        $validated['role_id'] = $role_id->id;

        $user = User::create($validated);

        Password::sendResetLink(['email' => $user->email]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
