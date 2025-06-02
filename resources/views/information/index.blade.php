 <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Informations') }}
            </h2>
            <a href="{{ route('information.create') }}"
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
                            
                            <th class="border px-4 py-2">Information</th>
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($informations)
                            @forelse ($informations as $information)
                                @php
                                    \Carbon\Carbon::setLocale('fr');
                                    $createdAt = \Carbon\Carbon::parse($information->created_at);
                                    $now = \Carbon\Carbon::now();
                                    $diffInDays = $createdAt->diffInDays($now);
                                    $isSameDay = $createdAt->isSameDay($now);
                                @endphp
                                <tr>
                                    <td class="border px-4 py-2">{!! $information->texte !!}</td>
                                    <td class="border px-4 py-2 text-center"> {{ $createdAt->translatedFormat('d F Y à H\hi') }} GMT</td>
                                    <td class="border px-4 py-2 text-center">
                                        @if ($isSameDay)
                                            <span class="bg-green-100 text-green-800 text-sm font-medium px-2 py-1 rounded">
                                                En cours
                                            </span>
                                        @elseif ($diffInDays > 2)
                                            <span class="bg-red-100 text-red-800 text-sm font-medium px-2 py-1 rounded">
                                                Passé
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-2 py-1 rounded">
                                                Récent
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">Aucune information trouvée.</td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="3" class="text-center py-4">Aucune information trouvée.</td>
                            </tr>
                        @endisset
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>
