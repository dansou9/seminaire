
 @if(auth()->user()->hasRole(1))
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Liste des Présentateurs') }}
            </h2>
            {{-- <a href="{{ route('enseignants.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Ajouter
            </a> --}}
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Messages de succès --}}
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif
        
       
        {{-- Table 1 : Présentations en attente --}}
        <div class="mb-12 bg-white p-6 shadow sm:rounded-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Présentations en attente de validation</h3>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-yellow-100">
                    <tr>
                        <th class="border px-4 py-2">Titre</th>
                        <th class="border px-4 py-2">Résumé</th>
                        <th class="border px-4 py-2">Présentateur</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Validation</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presentations->where('etat', false)->where('refused', false) as $presentation)
                        <tr>
                            <td class="border px-4 py-2">{{ $presentation->titre }}</td>
                            <td class="border px-4 py-2">{{ $presentation->resume }}</td>
                            <td class="border px-4 py-2">{{ $presentation->user->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $presentation->date_evenement ?? 'Non programmé' }}</td>
                            <td class="border px-4 py-2 text-center text-red-600 font-semibold">En attente</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('presentation.showValidation', $presentation->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Aucune présentation à valider.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table 2 : Présentations validées --}}
        <div class="mb-12 bg-white p-6 shadow sm:rounded-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Présentations validées</h3>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-green-100">
                    <tr>
                        <th class="border px-4 py-2">Titre</th>
                        <th class="border px-4 py-2">Résumé</th>
                        <th class="border px-4 py-2">Présentateur</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Statut</th>
                        <th class="border px-4 py-2">PDF</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presentations->where('etat', true) as $presentation)
                        <tr>
                            <td class="border px-4 py-2">{{ $presentation->titre }}</td>
                            <td class="border px-4 py-2">{{ $presentation->resume }}</td>
                            <td class="border px-4 py-2">{{ $presentation->user->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">
                                {{ $presentation->date_evenement ? \Carbon\Carbon::parse($presentation->date_evenement)->format('d/m/Y') : 'Non programmé' }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if ($presentation->date_evenement)
                                    @if (\Carbon\Carbon::parse($presentation->date_evenement)->isPast())
                                        <span class="text-red-600 font-semibold">Passée</span>
                                    @else
                                        <span class="text-green-600 font-semibold">À venir</span>
                                    @endif
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ asset('storage/' . $presentation->pdf_file_path) }}"
                                   target="_blank"
                                   class="text-blue-600 underline">Voir PDF</a>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if ($presentation->date_evenement)
                                    @php
                                        $dateEvenement = \Carbon\Carbon::parse($presentation->date_evenement);
                                        $deuxJoursPasse = $dateEvenement->isPast() && $dateEvenement->diffInDays(now()) > 2;
                                    @endphp

                                    @if (!$deuxJoursPasse)
                                        <a href="{{ route('presentation.programmer.edit', $presentation->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                            Modifier la date
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('presentation.programmer', $presentation->id) }}"
                                       class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">
                                        Programmer
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Aucune présentation validée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table 3 : Présentations non validées --}}
        <div class="mb-12 bg-white p-6 shadow sm:rounded-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Présentations non validées</h3>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-red-100">
                    <tr>
                        <th class="border px-4 py-2">Titre</th>
                        <th class="border px-4 py-2">Résumé</th>
                        <th class="border px-4 py-2">Présentateur</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Validation</th>
                        {{-- <th class="border px-4 py-2">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presentations->where('etat', false)->where('refused', true) as $presentation)
                        <tr>
                            <td class="border px-4 py-2">{{ $presentation->titre }}</td>
                            <td class="border px-4 py-2">{{ $presentation->resume }}</td>
                            <td class="border px-4 py-2">{{ $presentation->user->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $presentation->date_evenement ?? 'Non programmé' }}</td>
                            <td class="border px-4 py-2 text-center text-red-600 font-semibold">Non validée</td>
                            {{-- <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('presentation.showValidation', $presentation->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Voir</a>
                            </td> --}}
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Aucune présentation à valider.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</x-app-layout>
@endif



@if(auth()->user()->hasAnyRole([2]) || auth()->user()->isDoctorant())
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Liste de mes présentations') }}
            </h2>
            <a href="{{ route('presentation.soumission') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Soumettre une présentation
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Messages de succès --}}
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif
        
       
        {{-- Table  : Présentations validées  --}}
        <div class="mb-12 bg-white p-6 shadow sm:rounded-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Présentations validées</h3>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-green-100">
                    <tr>
                        <th class="border px-4 py-2">Titre</th>
                        <th class="border px-4 py-2">Résumé</th>
                        <th class="border px-4 py-2">Présentateur</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Statut</th>
                        <th class="border px-4 py-2">Validation</th>
                        <th class="border px-4 py-2">Fichier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presentations as $presentation)
                        @if ($presentation->user_id === auth()->id())
                        <tr>
                            <td class="border px-4 py-2">{{ $presentation->titre }}</td>
                            <td class="border px-4 py-2">{{ $presentation->resume }}</td>
                            <td class="border px-4 py-2">{{ $presentation->user->name ?? 'N/A' }}</td>
                             <td class="border px-4 py-2">
                                {{ $presentation->date_evenement ? \Carbon\Carbon::parse($presentation->date_evenement)->format('d/m/Y') : 'Non programmé' }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if ($presentation->date_evenement)
                                    @if (\Carbon\Carbon::parse($presentation->date_evenement)->isPast())
                                        <span class="text-red-600 font-semibold">Passée</span>
                                    @else
                                        <span class="text-green-600 font-semibold">À venir</span>
                                    @endif
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center font-semibold {{ $presentation->etat ? 'text-green-600' : 'text-red-600' }}">
                                 {{ $presentation->etat ? 'Validée' : 'Non validée' }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ asset('storage/' . $presentation->pdf_file_path) }}"
                                   target="_blank"
                                   class="text-blue-600 underline">Voir PDF</a>
                            </td>
                        </tr>
                    @endif
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Aucune présentation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table  : Présentations non validées  --}}
        <div class="mb-12 bg-white p-6 shadow sm:rounded-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Présentations non validées</h3>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-red-100">
                    <tr>
                        <th class="border px-4 py-2">Titre</th>
                        <th class="border px-4 py-2">Résumé</th>
                        <th class="border px-4 py-2">Présentateur</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Validation</th>
                        {{-- <th class="border px-4 py-2">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presentations->where('etat', false)->where('refused', true) as $presentation)
                        <tr>
                            <td class="border px-4 py-2">{{ $presentation->titre }}</td>
                            <td class="border px-4 py-2">{{ $presentation->resume }}</td>
                            <td class="border px-4 py-2">{{ $presentation->user->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $presentation->date_evenement ?? 'Non programmé' }}</td>
                            <td class="border px-4 py-2 text-center text-red-600 font-semibold">Non validée</td>
                            {{-- <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('presentation.showValidation', $presentation->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Voir</a>
                            </td> --}}
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Aucune présentation non validée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

           
    </div>
</x-app-layout>
@endif


 