<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">🎓 Séminaires</h2>
    </x-slot>

    <div class="py-6 space-y-10 max-w-7xl mx-auto">

        {{-- 🎯 Séminaires du jour J --}}
        @if($seminairesDuJour->count())
            <div>
                <h3 class="text-xl font-semibold text-green-600 mb-4">📌 Séminaires du jour</h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($seminairesDuJour as $seminaire)
                        <x-seminaire-card :seminaire="$seminaire" type="today" />
                    @endforeach
                </div>
            </div>
        @endif

        {{-- 🔮 Séminaires à venir --}}
        @if($seminairesAVenir->count())
            <div>
                <h3 class="text-xl font-semibold text-blue-600 mb-4">📅 Séminaires à venir</h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($seminairesAVenir as $seminaire)
                        <x-seminaire-card :seminaire="$seminaire" type="future" />
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ⏳ Séminaires passés --}}
        @if($seminairesPasses->count())
            <div>
                <h3 class="text-xl font-semibold text-gray-600 mb-4">⏱ Séminaires passés</h3>
                @if($seminairesAVenir->count() === 1)
                <div class="flex justify-center">
                    <div class="w-full max-w-md">
                        <x-seminaire-card :seminaire="$seminaire" type="future" />
                    </div>
                </div>
                @else
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($seminairesAVenir as $seminaire)
                            <x-seminaire-card :seminaire="$seminaire" type="future" />
                        @endforeach
                    </div>
                @endif


            </div>
        @endif

    </div>
</x-app-layout>
