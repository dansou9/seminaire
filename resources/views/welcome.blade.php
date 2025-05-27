<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Séminaires</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6">Bienvenue sur GestionSéminaires</h1>
            
            <div class="space-y-4">
                <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white py-2 px-4 rounded text-center hover:bg-blue-700 transition">
                    Connexion
                </a>
                
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block w-full bg-gray-200 text-gray-800 py-2 px-4 rounded text-center hover:bg-gray-300 transition">
                    Créer un compte
                </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>