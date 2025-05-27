 @if(auth()->user()->hasAnyRole([1]))
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Planification de la présentation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold mb-4">{{ $presentation->titre }}</h3>

                <form action="{{ $presentation->date_evenement ? route('presentation.programmer.update', $presentation->id) : route('presentation.programmer.store', $presentation->id) }}" method="POST" class="space-y-4">
                @csrf
                @if($presentation->date_evenement)
                    @method('PUT')
                @endif

                    <div>
                        <label for="date_evenement" class="block text-sm font-medium text-gray-700">
                            Date de la présentation
                        </label>
                        <input type="date" name="date_evenement" id="date_evenement" required
                               value="{{ old('date_evenement', $presentation->date_evenement ? $presentation->date_evenement->format('Y-m-d') : '') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                            Enregistrer
                        </button>

                        <a href="{{ route('presentation.page') }}" 
                           class="bg-gray-600 text-white px-5 py-2 rounded hover:bg-gray-700">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endif