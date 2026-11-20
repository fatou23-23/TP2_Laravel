<header>
    <a href="{{ route('accueil') }}" @class(['actif' => request()->routeIs('accueil')])>Accueil</a>
    <a href="{{ route('classes.index') }}" @class(['actif' => request()->routeIs('classes.*')])>Classes</a>
    <a href="{{ route('etudiants.index') }}" @class(['actif' => request()->routeIs('etudiants.*')])>Étudiants</a>
    <a href="{{ route('annuaire') }}" @class(['actif' => request()->routeIs('annuaire')])>Annuaire</a>
</header>
