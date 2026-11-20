@csrf

<div class="champ">
    <label for="code">Code</label>
    <input id="code" name="code" value="{{ old('code', $classe->code) }}" placeholder="L1-GL">
    @error('code') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="libelle">Libellé</label>
    <input id="libelle" name="libelle" size="50" value="{{ old('libelle', $classe->libelle) }}">
    @error('libelle') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="niveau">Niveau</label>
    <select id="niveau" name="niveau">
        @foreach (['L1', 'L2', 'L3', 'M1', 'M2'] as $niveau)
            <option value="{{ $niveau }}" @selected(old('niveau', $classe->niveau) === $niveau)>{{ $niveau }}</option>
        @endforeach
    </select>
    @error('niveau') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="filiere">Filière</label>
    <input id="filiere" name="filiere" size="40" value="{{ old('filiere', $classe->filiere) }}">
    @error('filiere') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="annee_academique">Année académique</label>
    <input id="annee_academique" name="annee_academique" value="{{ old('annee_academique', $classe->annee_academique) }}" placeholder="2026-2027">
    @error('annee_academique') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<div class="champ">
    <label for="effectif_max">Effectif maximal</label>
    <input id="effectif_max" name="effectif_max" type="number" min="1" max="100" value="{{ old('effectif_max', $classe->effectif_max) }}">
    @error('effectif_max') <div class="message-erreur">{{ $message }}</div> @enderror
</div>

<button>Enregistrer</button>
<a href="{{ route('classes.index') }}">Annuler</a>