 @if(auth()->user()->hasAnyRole([1]))
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Validation de la présentation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-lg space-y-4">

                <h3 class="text-lg font-semibold text-gray-700">{{ $presentation->titre }}</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $presentation->resume }}</p>

                <p><span class="font-semibold">Présentateur :</span> {{ $presentation->user->name ?? 'N/A' }}</p>

                <div>
                    <span class="font-semibold">Fichier PDF : </span>
                    <a href="{{ asset('storage/' . $presentation->pdf_file_path) }}" target="_blank" 
                       class="text-blue-600 hover:underline">
                        Voir le fichier
                    </a>
                </div>

                <div class="flex space-x-4 mt-6">
                    <form action="{{ route('presentation.update', $presentation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Valider
                        </button>
                    </form>

                    <a href="{{ route('presentation.page') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@endif