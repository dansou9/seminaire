@props(['seminaire', 'type'])

@php
    use Carbon\Carbon;

    $color = match($type) {
        'today' => 'border-green-500',
        'future' => 'border-blue-500',
        'past' => 'border-gray-400',
    };

    $icon = match($type) {
        'today' => 'calendar-days',
        'future' => 'calendar-plus',
        'past' => 'calendar-check',
    };

    $date = Carbon::parse($seminaire->date_evenement)->locale('fr')->isoFormat('dddd D MMMM YYYY');
@endphp

<div class="flex flex-col border-l-4 {{ $color }} bg-white shadow-md rounded-2xl p-5 h-full" hover:shadow-xl transition">
    {{-- Titre --}}
    <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $seminaire->titre }}</h4>
    {{-- Résumé --}}
    @if($seminaire->resume)
        <p class="text-gray-600 text-md mb-4">
            {{ Str::limit($seminaire->resume, 180) }}
        </p>
    @endif

    {{-- Infos utilisateur + date --}}
    <div class="flex items-center text-sm text-gray-700 space-x-4 mt-auto">
        <div class="flex items-center space-x-1">
            <x-heroicon-o-user class="h-5 w-5 text-blue-500 " />
            <span class="font-bold">{{ $seminaire->user->name }}</span>
        </div>
        <div class="flex items-center space-x-1">
            <x-heroicon-o-calendar class="h-5 w-5 text-blue-500" />
            <span class="font-bold">{{ $date }}</span>
        </div>
    </div>

    {{-- Lien PDF pour les séminaires passés --}}
    @if($type === 'past')
        <a href="{{ asset('storage/' . $seminaire->pdf_file_path) }}" target="_blank"
           class="mt-4 inline-block text-blue-600 hover:underline font-semibold text-sm">
            📄 Voir le fichier PDF
        </a>
    @endif
</div>
