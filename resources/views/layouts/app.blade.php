<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titre', 'Accueil') - {{ config('app.name') }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; color: #222; }
        header { background: #1f3864; padding: 12px 24px; }
        header a { color: #fff; margin-right: 18px; text-decoration: none; }
        header a.actif { font-weight: bold; text-decoration: underline; }
        main { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #eef2f9; }
        .alerte { padding: 10px; margin-bottom: 16px; border-radius: 4px; }
        .succes { background: #e6f4ea; } .erreur { background: #fdecea; }
        .champ { margin-bottom: 12px; } .champ label { display: block; font-weight: bold; }
        .message-erreur { color: #b00020; font-size: 0.9em; }
        form.en-ligne { display: inline; }
    </style>
</head>
<body>
    @include('partials.menu')
    <main>
        @if (session('succes'))
            <div class="alerte succes">{{ session('succes') }}</div>
        @endif
        @if (session('erreur'))
            <div class="alerte erreur">{{ session('erreur') }}</div>
        @endif

        @yield('contenu')
    </main>
</body>
</html>
