@include('components.private.header')
@include('components.private.sidebar')
<section class="home-section" style="margin-bottom: 500px">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Afficher @switch($training_id)
                @case(0)
                    Enseignant
                @break


                @break
            @endswitch
            pour poste : {{ $position->name }}
        </span>
    </div>
    <div class="mycontent">
        <div class="container-sm mt-5">

            <div class="pagination">
                {{ $employees->appends(request()->except('page'))->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
            @if ($employees->isEmpty())
                <p>Aucun enseignant trouvé avec le statut de formation spécifié à ce poste.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom et Prenom</th>

                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>

                                <td>
                                    @switch($training_id)
                                        @case(0)
                                            Enseignant
                                        @break


                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @switch($training_id)
                                        @case(0)
                                            <a href="{{ route('employee.show', $employee->id) }}"
                                                class="btn btn-primary btn-sm">Voir</a>
                                        @break

                                        @case(1)
                                            <a href="{{ route('trainee.show', $employee->id) }}"
                                                class="btn btn-primary btn-sm">Voir</a>
                                        @break

                                        @case(2)
                                            <a href="{{ route('trained.show', $employee->id) }}"
                                                class="btn btn-primary btn-sm">Voir</a>
                                        @break
                                    @endswitch

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $employees->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</section>
@include('components.private.footer')
