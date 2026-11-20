@csrf

<div class="champ">
    <label for="prenom">Prénom</label>
    <input id="prenom" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}">
    @error('prenom') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="nom">Nom</label>
    <input id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}">
    @error('nom') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="email">E-mail</label>
    <input id="email" name="email" type="email" size="40" value="{{ old('email', $etudiant->email) }}">
    @error('email') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="date_naissance">Date de naissance</label>
    <input id="date_naissance" name="date_naissance" type="date"
           value="{{ old('date_naissance', $etudiant->date_naissance?->format('Y-m-d')) }}">
    @error('date_naissance') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label>Sexe</label>
    <label><input type="radio" name="sexe" value="F" @checked(old('sexe', $etudiant->sexe) === 'F')> Féminin</label>
    <label><input type="radio" name="sexe" value="M" @checked(old('sexe', $etudiant->sexe) === 'M')> Masculin</label>
    @error('sexe') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="telephone">Téléphone (facultatif)</label>
    <input id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" placeholder="77 123 45 67">
    @error('telephone') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="classe_id">Classe</label>
    <select id="classe_id" name="classe_id">
        <option value="">Choisir une classe</option>
        @foreach ($classes as $classe)
            <option value="{{ $classe->id }}" @selected(old('classe_id', $etudiant->classe_id) == $classe->id)>
                {{ $classe->code }} - {{ $classe->libelle }}
            </option>
        @endforeach
    </select>
    @error('classe_id') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<button>Enregistrer</button>
<a href="{{ route('etudiants.index') }}">Annuler</a>
