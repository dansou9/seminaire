<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Liste des Enseignants') }}
            </h2>
            <a href="{{ route('enseignants.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Ajouter
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-blue-500 text-white font-bold">
                            <th class="border px-4 py-2">Nom et Prénoms</th>
                            <th class="border px-4 py-2">Mail</th>
                            <th class="border px-4 py-2">Specialité</th>
                            <th class="border px-4 py-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($enseignants)
                            @forelse ($enseignants as $enseignant)
                                <tr>
                                    <td class="border px-4 py-2">{{ $enseignant->name }}</td>
                                    <td class="border px-4 py-2">{{ $enseignant->email }}</td>    
                                    <td class="border px-4 py-2">{{ $enseignant->specialite }}</td>                               
                                    <td class="border px-4 py-2 text-center">
                                        @if ($enseignant->status === 'actif')
                                            <span class="text-green-600 font-semibold">Compte actif</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Compte inactif</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Aucun enseignant trouvé.</td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-4">Aucun enseignant trouvé.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
