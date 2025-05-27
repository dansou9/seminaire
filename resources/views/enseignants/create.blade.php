<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ajouter un Enseignant') }}
            </h2>
            <a href="{{ route('enseignants.index') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Voir les Enseignants
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8">
            <form method="POST" action="{{ route('register-enseignant.store') }}">
                @csrf

                <!-- Nom et prénoms -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nom et prénoms')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                  :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Spécialité -->
                <div class="mb-4">
                    <x-input-label for="specialite" :value="__('Spécialité')" />
                    <select id="specialite" name="specialite" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">-- Choisir une spécialité --</option>
                        <option value="Mathematiques" {{ old('specialite') == 'Mathematiques' ? 'selected' : '' }}>Mathématiques</option>
                        <option value="Physique" {{ old('specialite') == 'Physique' ? 'selected' : '' }}>Physique</option>
                        <option value="Informatique" {{ old('specialite') == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                        <option value="Didactique" {{ old('specialite') == 'Didactique' ? 'selected' : '' }}>Didactique</option>
                        <option value="Langue" {{ old('specialite') == 'Langue' ? 'selected' : '' }}>Langue</option>
                    </select>

                    <x-input-error :messages="$errors->get('specialite')" class="mt-2" />
                </div>

                <!-- Bouton -->
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button>
                        {{ __('Ajouter enseignant') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
