<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | IMSP - Gestion des Séminaires</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
    </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                {{-- <img src="{{ asset('images/logo_imsp.png') }}" alt="Logo IMSP" class="h-12"> --}}
                <div>
                    <h1 class="text-xl font-bold text-blue-900">Institut de Mathématiques et de Sciences Physiques</h1>
                    <p class="text-sm text-gray-600">Plateforme de gestion des séminaires</p>
                </div>
            </div>

            <!-- Menu Desktop -->
            <nav class="hidden sm:flex space-x-4">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Connexion</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-gray-700 hover:underline font-semibold">Créer un compte</a>
                @endif
            </nav>

            <!-- Menu Mobile Button -->
            <div class="sm:hidden">
                <button id="menu-btn" class="text-gray-600 focus:outline-none">
                    <!-- Hamburger Icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu Mobile Dropdown -->
        <div id="mobile-menu" class="sm:hidden hidden px-4 pb-4">
            <a href="{{ route('login') }}" class="block text-blue-600 py-2 font-semibold">Connexion</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block text-gray-700 py-2 font-semibold">Créer un compte</a>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-blue-50 py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">Bienvenue sur la plateforme de gestion des séminaires</h2>
            <p class="text-lg text-gray-700 mb-8">
                Gérez, programmez et suivez les séminaires scientifiques organisés à l’IMSP.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition text-lg font-semibold">
                    Se connecter
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-white border border-blue-600 text-blue-600 py-3 px-6 rounded-lg hover:bg-blue-100 transition text-lg font-semibold">
                    Créer un compte
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} IMSP - Tous droits réservés.
        </div>
    </footer>

</body>
</html>
