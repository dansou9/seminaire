<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            @if(auth()->user()->hasAnyRole([1]))
            <div class="flex gap-4">
                <!-- Utilisateurs -->
                <a href="{{ route('enseignants.index') }}"
                   class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Voir les Enseignants
                </a>
                
            </div>
             @endif
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Message de bienvenue centré -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 text-center text-gray-900 text-xl font-semibold">
                Bienvenue sur votre tableau de bord !
            </div>
        </div>

        <!-- Cartes d'accès aux sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Card 1 : Accéder aux séminaires -->
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Séminaires</h3>
                <p class="text-gray-600 mb-6">Accédez à la liste des séminaires disponibles et participez aux événements.</p>
                <a href="{{ route('seminaires.index') }}"  {{-- Ajuste la route selon ta config --}}
                   class="mt-auto inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                    Voir les séminaires
                </a>
            </div>

            <!-- Card 2 : Accéder à la page des présentations -->
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Présentations</h3>
                <p class="text-gray-600 mb-6">Consultez la liste des présentations et gérez vos événements.</p>
                <a href="{{ route('presentation.page') }}"
                   class="mt-auto inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center">
                    Voir les présentations
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
