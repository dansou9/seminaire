<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Presentation;
use App\Models\User;
use App\Notifications\AlertePresentationAccepted;
use App\Notifications\AlertePresentationScheduled;

use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Enseignant')) {
            // Enseignant : seulement ses présentations
            $presentations = Presentation::with('user')
                ->where('user_id', $user->id)
                ->get();
        } else if ($user->hasRole('Etudiant') && $user->degree === 'doctorat') {
            // Étudiant doctorant : seulement ses présentations
            $presentations = Presentation::with('user')
                ->where('user_id', $user->id)
                ->get();
        } else {
            // Autres rôles : toutes les présentations
            $presentations = Presentation::with('user')->get();
        }

        return view('presentation.index', compact('presentations'));
    }

    public function create()
    {
        return view('presentation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'resume' => 'required',
            'pdf_file' => 'required|file|mimes:pdf|max:2048'
        ]);

        $path = $request->file('pdf_file')->store('presentation', 'public');
        $validated['pdf_file_path'] = $path;

        $validated['user_id'] = auth()->user()->id;

        Presentation::create($validated);

        return redirect()->back()->with('success', 'Présentation ajoutée avec succès');
    }

    public function showValidation($id)
    {
        $presentation = Presentation::with('user')->findOrFail($id);
        return view('presentation.show', compact('presentation'));
    }

    public function update($id)
    {
        $presentation = Presentation::findOrFail($id);
        $presentation->etat = true;
        $presentation->save();

        $user = User::findOrFail($presentation->user_id);
        $user->notify(new AlertePresentationAccepted());

        return redirect()->route('presentation.page')->with('success', 'Présentation validée avec succès');
    }

    public function index_validated()
    {
        $presentations = Presentation::with('user')
            ->where('etat', true)
            ->get();

        return view('presentation.index_validated', compact('presentations'));
    }

    public function index_not_validated()
    {
        $presentations = Presentation::with('user')
            ->where('etat', false)
            ->get();

        return view('presentation.index_not_validated', compact('presentations'));
    }

    public function showProgram($id)
    {
        $presentation = Presentation::findOrFail($id);
        return view('presentation.program', compact('presentation'));
    }

    public function storeProgram(Request $request, $id)
    {
        $validated = $request->validate([
            'date_evenement' => 'required|date',
        ]);

        $presentation = Presentation::findOrFail($id);
        $presentation->date_evenement = $validated['date_evenement'];
        $presentation->save();

        $user = User::findOrFail($presentation->user_id);
        $user->notify(new AlertePresentationScheduled());

        return redirect()->route('presentation.page')->with('success', 'Date de présentation mise à jour avec succès');
    }


    public function editProgram($id)
    {
        $presentation = Presentation::findOrFail($id);
        return view('presentation.program', compact('presentation'));
    }

    public function updateProgram(Request $request, $id)
    {
        $validated = $request->validate([
            'date_evenement' => 'required|date|after:today',
        ]);

        $presentation = Presentation::findOrFail($id);
        $presentation->date_evenement = $validated['date_evenement'];
        $presentation->save();

        return redirect()->route('presentation.page')->with('success', 'Date programmée avec succès.');
    }

    public function seminaires()
    {
        $today = Carbon::today();

        $seminairesDuJour = Presentation::whereDate('date_evenement', $today)
            ->get();

        $seminairesAVenir = Presentation::whereDate('date_evenement', '>', $today)
            ->orderBy('date_evenement')
            ->get();

        $seminairesPasses = Presentation::whereDate('date_evenement', '<', $today)
            ->orderByDesc('date_evenement')
            ->get();

        return view('presentation.seminaires', compact(
            'seminairesDuJour',
            'seminairesAVenir',
            'seminairesPasses'
        ));
    }


    public function showSoumissionPage()
    {
        return view('presentation.soumettre');
    }
}
