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
        <div class="bg-gradient-to-r from-blue-500 via-blue-400 to-blue-500 shadow-md sm:rounded-lg mb-8">
            <div class="p-6 text-center text-white text-2xl font-bold">
                👋 Bonjour {{ Auth::user()->name }}, bienvenue sur votre tableau de bord !
            </div>
        </div>


        @if($recentInformations->isNotEmpty())
            <div class="bg-white shadow rounded-lg mb-8 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">📢 Informations récentes</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentInformations as $info)
                        <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded shadow hover:shadow-md transition-all duration-300">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-6 h-6 text-blue-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-semibold text-blue-700">Nouvelle information</span>
                            </div>
                            <div class="text-gray-800 text-sm leading-relaxed">
                                {!! $info->texte !!}
                            </div>
                            <div class="text-xs text-gray-500 mt-3">
                                Publié le {{ \Carbon\Carbon::parse($info->created_at)->translatedFormat('d F Y à H\hi') }} GMT
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


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
            @if(auth()->user()->hasAnyRole([1,2]) || auth()->user()->isDoctorant() )
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Présentations</h3>
                <p class="text-gray-600 mb-6">Consultez la liste des présentations et gérez vos événements.</p>
                <a href="{{ route('presentation.page') }}"
                   class="mt-auto inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center">
                    Voir les présentations
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
