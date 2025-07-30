@include('components.private.header')
@include('components.private.sidebar')
<link href="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<style>
    .visually-hidden {
    position: absolute;
    left: -9999px;
}

.day-checkbox {
    display: inline-block;
    margin: 5px;
}

.day-label {
    display: block;
    background-color: #f0f0f0;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    border: 2px solid transparent;
}

.day-label:hover {
    transform: scale(1.05);
}

.form-check-input:checked + .day-label {
    background-color: #b3e5fc; /* Light baby blue background */
    border-color: #b3e5fc;
    color: #000;
}

</style>
<section class="home-section" style="margin-bottom: 500px">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Emploi du temps</span>
</div>
<div class="mycontent">
    <div class="container-sm mt-5">
        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="scheduleName" class="form-label">Nom de l’emploi du temps</label>
                <input type="text" class="form-control" id="scheduleName" name="scheduleName"
                    placeholder="Entrez le nom de l’emploi du temps" value="{{ old('scheduleName') }}" required>
            </div>
            <h2 class="mb-3">Sélection des jours et horaires</h2>
            <div class="row">
                <div class="col">
                    <label class="form-label">Sélectionnez les jours</label>
                    <div class="days-container">
                        @php
                            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                            $jours_en = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp
                        @foreach ($jours_en as $index => $day)
                            <div class="day-checkbox">
                                <input type="checkbox" class="form-check-input visually-hidden" id="{{ strtolower($day) }}"
                                    name="days[]" value="{{ $day }}"
                                    {{ in_array($day, old('days', [])) ? 'checked' : '' }}>
                                <label class="day-label" for="{{ strtolower($day) }}">{{ $jours[$index] }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col">
                    <label for="startTime" class="form-label">Heure de début</label>
                    <input type="text" class="form-control mb-3 timepicker" id="startTime" name="startTime"
                        value="{{ old('startTime') }}">

                    <label for="endTime" class="form-label">Heure de fin</label>
                    <input type="text" class="form-control mb-3 timepicker" id="endTime" name="endTime"
                        value="{{ old('endTime') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>

<!-- Conteneur de notifications Toast -->
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
    <!-- Toast -->
    <div class="toast" id="validationToast">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto">Erreur de validation</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                aria-label="Fermer"></button>
        </div>
        <div class="toast-body bg-white">
            <!-- Les messages d’erreur seront insérés ici -->
        </div>
    </div>
</div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                let errorMessage = <ul>;
                @foreach ($errors->all() as $error)
                    errorMessage += <li>{{ $error }}</li>;
                @endforeach
                errorMessage += </ul>;

                document.querySelector('#validationToast .toast-body').innerHTML = errorMessage;
                var toast = new bootstrap.Toast(document.getElementById('validationToast'));
                toast.show();
            @endif
        });
    </script>




</section>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".timepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
</script>
<script>
    flatpickr(".timepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
</script>


@include('components.private.footer')
