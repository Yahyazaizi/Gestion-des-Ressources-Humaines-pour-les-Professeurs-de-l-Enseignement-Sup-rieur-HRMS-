@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🔍 Rechercher des promotions prévues</h2>

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('promotions.recherche') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="date_effet" class="form-label">Date de promotion prévue</label>
            <input type="date" id="date_effet" name="date_effet" class="form-control" value="{{ request('date_effet') }}">
        </div>

        <div class="col-md-4">
            <label for="nom_prof" class="form-label">Nom du professeur</label>
            <select name="nom_prof" id="nom_prof" class="form-select">
                <option value="">-- Tous les professeurs --</option>
                @foreach($professeurs as $prof)
                    <option value="{{ $prof->id }}" {{ request('nom_prof') == $prof->id ? 'selected' : '' }}>
                        {{ $prof->NOM_ET_PRENOM }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
    </form>

    {{-- Résultats --}}
    @if($notifications->isEmpty())
        <div class="alert alert-warning">Aucune promotion prévue trouvée.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ancien Grade</th>
                    <th>Nouveau Grade</th>
                    <th>Ancien Échelon</th>
                    <th>Nouveau Échelon</th>
                    <th>Date de Changement</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->nom_complet }}</td>
                        <td>{{ $notification->ancien_grade }}</td>
                        <td>{{ $notification->nouveau_grade }}</td>
                        <td>{{ $notification->ancien_echelon }}</td>
                        <td>{{ $notification->nouveau_echelon }}</td>
                        <td>{{ \Carbon\Carbon::parse($notification->date_changement)->format('d/m/Y') }}</td>
                        <td>{{ $notification->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
