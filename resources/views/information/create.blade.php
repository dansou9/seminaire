<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ajouter une Information') }}
            </h2>
            <a href="{{ route('information.page') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h4l2 2h8a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                </svg>
                Voir les Informations
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8">
            <form method="POST" action="{{ route('information.store') }}">
                @csrf

                <!-- Zone de texte -->
                <x-input-label for="texte" :value="__('Contenu de l\'information')" />
                <input id="texte" type="hidden" name="texte" value="{{ old('texte') }}">
                <trix-editor input="texte" class="trix-content"></trix-editor>

                <x-input-error :messages="$errors->get('texte')" class="mt-2" />
                    
                <div class="mb-4">
                    {{-- <x-input-label for="texte" :value="__('Contenu de l\'information')" /> --}}
                    {{-- <textarea id="texte" name="texte" rows="6"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                        required>{{ old('texte') }}</textarea> --}}
                    {{-- <x-input-error :messages="$errors->get('texte')" class="mt-2" /> --}}    

                </div>

                <!-- Bouton -->
                <div class="flex justify-end">
                    <x-primary-button>
                        {{ __('Publier l\'information') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
