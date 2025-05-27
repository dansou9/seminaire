<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\User;
use App\Notifications\AlertePresentationAccepted;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentations = Presentation::all();
        return view('presentation.index', compact('presentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valited = $request->validate([
               'titre' => 'required|string|max:255',
               'resume' => 'required',
               'pdf_file' => 'required|file|mimes:pdf|max:2048' 
            ]);

        $path = $request->file('pdf_file')->store('presentation', 'public');
        $valited['pdf_file_path'] = $path;
        $valited['user_id'] = auth()->id;

        Presentation::create($valited);

        return redirect()->back()->with('sucess', 'Présentation ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presentation $presentation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $presentation = Presentation::findOrFail($id);
        return view('presentation.show', compact('presentation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $presentation = Presentation::findOrFail($id);
        $presentation->etat = true;
        $presentation->save();
        $user = User::findOrFail($presentation->user_id);
        $user->notify(new AlertePresentationAccepted());

        return redirect()->route('presentation.index')->with('success', 'Presentation validée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentation $presentation)
    {
        //
    }

    
    public function index_passed()
    {
        $all_presentations_passed = Presentation::where('etat', true)->get();
        return view('presentation.index_passed', compact('all_presentations_passed '));
    }

    public function index_not_passed()
    {
        $all_presentations_not_passed = Presentation::where('etat', false)->get();
        return view('presentation.index_passed', compact('all_presentations_not_passed '));
    }

    public function create_seminaire($id, Request $request)
    {
        $valited = $request->validate([
               'date_evenement' => 'required|date',
            ]);

        $presentation = Presentation::findOrFail($id);

        $presentation->date_evenement = $valited['date_evenement'];
        $presentation->save();

        return redirect()->back()->with('sucess', 'Date de présentation mis à jour avec succès');
    }
}
