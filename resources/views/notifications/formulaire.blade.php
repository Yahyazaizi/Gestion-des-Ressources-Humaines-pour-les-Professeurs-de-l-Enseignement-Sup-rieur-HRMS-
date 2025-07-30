@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Modifier l'échelon et le cadre</h2>

    <!-- Formulaire pour sélectionner l'année et la date -->
    <form method="GET" action="{{ route('modifier.echelon') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="annee" class="form-label">Année</label>
            <input type="number" id="annee" name="annee" value="{{ request('annee', date('Y')) }}" class="form-control" min="2000" max="2100">
        </div>
        <div class="col-md-4">
            <label for="nom_prof" class="form-label">Nom de l'enseignant</label>
            <input type="text" id="nom_prof" name="nom_prof" class="form-control" placeholder="Nom de l'enseignant">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Afficher les changements</button>
        </div>
    </form>

    <!-- Affichage des résultats -->
    @if(isset($enseignants) && count($enseignants))
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom complet</th>
                <th>Ancien Cadre</th>
                <th>Ancien Échelon</th>
                <th>Nouveau Cadre</th>
                <th>Nouveau Échelon</th>
                <th>Date de changement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enseignants as $enseignant)
            <tr>
                <td>{{ $enseignant->NOM_ET_PRENOM }}</td>
                <td>{{ $enseignant->ancien_cadre }}</td>
                <td>{{ $enseignant->ancien_echelon }}</td>
                <td>{{ $enseignant->nouveau_cadre }}</td>
                <td>{{ $enseignant->nouveau_echelon }}</td>
                <td>{{ \Carbon\Carbon::parse($enseignant->date_changement)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">Aucun changement trouvé pour les critères spécifiés.</div>
    @endif
</div>
@endsection
