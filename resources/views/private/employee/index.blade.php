@include('components.private.header')
@include('components.private.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

{{-- @foreach ($data as $employee)
    <div>
        <p>{{ $employee->first_name }} {{ $employee->last_name }}</p>
        <p>Email: {{ $employee->email }}</p>
        <!-- Add other attributes you want to display -->
    </div>
@endforeach --}}
<style>
    /* Ensure the table uses the full area in fullscreen */
    #tableContainer:-webkit-full-screen,
    #tableContainer:-moz-full-screen,
    #tableContainer:fullscreen {
        width: 100%;
        height: 100%;
    }

    .email-link {
        color: inherit;
        /* Makes the color the same as the surrounding text */
        text-decoration: none;
        /* Removes underline */
        cursor: pointer;
        /* Changes the cursor to indicate it's clickable */
    }

    .email-link:hover,
    .email-link:focus {
        text-decoration: underline;
        /* Adds underline on hover for emphasis */
        color: #0056b3;
        /* Optional: changes color on hover */
    }

    .btn-modal-trigger {
        padding: 0;
        margin: 0;
        border: none;
        background-color: transparent;
        cursor: pointer;
    }

    .table-hover tbody tr td:nth-child(2) {
        cursor: pointer;
    }


    .salary-number {
        font-weight: bold;
        /* Makes the number bold */
        color: #333;
        /* Sets a dark gray color for better contrast */
    }



    /* Optional: Custom styles for resize handles */
    .ui-resizable-handle {
        background-color: #272727;
        width: 10px;
        height: 100%;
        right: -5px;
        top: 0;
        cursor: col-resize;
    }

    th {
        position: relative;
        /* Necessary to contain the resize handle */
    }

    #customContextMenu {
        border: 1px solid #ccc;
        background-color: white;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        width: 150px;
        cursor: pointer;
    }
</style>
<div id="customContextMenu" style="display: none; position: absolute; z-index: 1000;" class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">View Details</li>
        <li class="list-group-item">Edit</li>
    </ul>
</div>


<section class="home-section" style="margin-bottom: 500px">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Tous les enseignants</span>
    </div>
    <!-- Dans layouts/app.blade.php par exemple -->
    <div class="position-absolute top-0 end-0 m-4 me-1 d-flex">
        <a href="{{ route('notifications.index') }}" class="notification-bell" id="notificationBell">
            <i class="fas fa-bell"></i>
            <span class="notification-badge pulse" id="notificationBadge">3</span>
        </a>
    </div>

    <style>
        /* Style de base */
        .notification-bell {
            position: relative;
            
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 50%;
            color: white;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
            z-index: 10;
        }

        /* Badge de notification */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 24px;
            height: 24px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Animation de pulsation */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Effet au survol */
        .notification-bell:hover {
            transform: translateY(-3px) rotate(15deg);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #6366f1, #3b82f6);
        }

        /* Animation de sonnerie */
        @keyframes ring {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            30% { transform: rotate(15deg); }
            40% { transform: rotate(-15deg); }
            50% { transform: rotate(10deg); }
            60% { transform: rotate(-10deg); }
            70% { transform: rotate(5deg); }
            80% { transform: rotate(-5deg); }
            90% { transform: rotate(2deg); }
            100% { transform: rotate(0deg); }
        }

        .ring-animation {
            animation: ring 1s ease;
        }

        /* Effet de vague */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 1s ease-out;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bell = document.getElementById('notificationBell');
            const badge = document.getElementById('notificationBadge');

            // Animation au clic
            bell.addEventListener('click', function(e) {
                // Créer l'effet de vague
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);

                // Positionner la vague
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = `${size}px`;
                ripple.style.left = `${e.clientX - rect.left - size/2}px`;
                ripple.style.top = `${e.clientY - rect.top - size/2}px`;

                // Supprimer après l'animation
                setTimeout(() => {
                    ripple.remove();
                }, 1000);

                // Animation de sonnerie
                this.querySelector('i').classList.add('ring-animation');
                setTimeout(() => {
                    this.querySelector('i').classList.remove('ring-animation');
                }, 1000);

                // Simuler la lecture des notifications (à adapter)
                badge.textContent = '0';
                badge.classList.remove('pulse');
                badge.style.backgroundColor = '#6b7280';
            });

            // Simulation de nouvelle notification (pour la démo)
            setInterval(() => {
                if (badge.textContent === '0') {
                    const newCount = Math.floor(Math.random() * 5) + 1;
                    badge.textContent = newCount;
                    badge.classList.add('pulse');
                    badge.style.backgroundColor = '#ef4444';

                    // Animation pour attirer l'attention
                    bell.style.animation = 'none';
                    void bell.offsetWidth; // Déclenche un reflow
                    bell.style.animation = 'shake 0.5s';
                }
            }, 15000); // Toutes les 15 secondes pour la démo
        });
    </script>
<!-- Bouton pour afficher les options -->




        {{-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#infoModal"
            data-bs-placement="left" title="Help Information">
            <i class="bi bi-info-circle"></i>
        </button> --}}
    </div>
    {{-- <div class="position-absolute top-9 end-0 m-3 d-flex">
        <a href="{{ route('promotions.recherche') }}" class="btn btn-success">
            <i class="fas fa-arrow-right" style="font-size: 24px; color:white;"></i>
        </a>
    </div> --}}
    <div class="position-absolute top-0 end-0 m-4 me-5  d-flex" id="fullscreenBtn">
        <a href="{{ route('promotions.recherche') }}" class="btn-search-futur" id="searchButton">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    <line x1="11" y1="8" x2="11" y2="14"></line>
                    <line x1="8" y1="11" x2="14" y2="11"></line>
                </svg>
            </span>
            <span class="search-text">Analyser</span>
        </a>
    </div>

    <style>
        /* Style du bouton futuriste */
        .btn-search-futur {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background: linear-gradient(135deg, #6e8efb, #4a6cf7);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-search-futur:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(74, 108, 247, 0.4);
            background: linear-gradient(135deg, #4a6cf7, #6e8efb);
        }

        .btn-search-futur:active {
            transform: translateY(1px);
        }
        #fullscreenBtn {
            /* margin-top: -42px; */







        }







        .search-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .btn-search-futur:hover .search-icon {
            transform: rotate(90deg);
        }

        .search-text {
            position: relative;
            z-index: 1;
        }

        /* Effet de lumière futuriste */
        .btn-search-futur::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.1) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            transition: all 0.6s ease;
        }

        .btn-search-futur:hover::before {
            left: 100%;
        }

        /* Animation au clic */
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(74, 108, 247, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(74, 108, 247, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 108, 247, 0); }
        }

        .btn-search-futur:focus {
            animation: pulse 0.8s;
            outline: none;
        }
    </style>

    <script>
        document.getElementById('searchButton').addEventListener('click', function(e) {
            // Animation supplémentaire au clic
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);

            // Vous pouvez ajouter ici une logique de validation du formulaire
            // avant la soumission si nécessaire
        });
    </script>





    <!-- Modal -->
    <!-- Employee Detail Modal -->
    {{-- <div class="modal fade" id="employeeDetailModal" tabindex="-1" aria-labelledby="employeeDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeDetailModalLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="employeeDetails">

                    <!-- Details will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div> --}}

    <div class="mycontent">
        <div class="mt-2">
            <div>
                <form action="{{ route('employee.index') }}" method="GET" class="d-flex float-start">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search"
                        aria-label="Search" style="width: 400px" value="{{ request('search') }}">


                    <!-- Position Filter -->
                    <select name="position" class="form-select ms-2">
                        <option value="">Tous les Grades</option>
                        @foreach (\App\Models\Position::all() as $position)
                            <option value="{{ $position->id }}"
                                {{ request('position') == $position->id ? 'selected' : '' }}>
                                {{ $position->name }} {{ $position->employees->count() }}

                            </option>
                        @endforeach
                    </select>
                    <div class="ms-2 btn-group" role="group" class="mb-3"> <!-- Bootstrap margin bottom class -->
                        <button class="btn btn-success" type="submit" title="Search"> <i class='bx bx-search'></i>
                        </button>
                        <a href="{{ route('employee.index') }}" class="btn btn-light btn-outline-dark">
                            <i class="bi bi-arrow-clockwise " title="Refresh"></i>
                        </a>

                    </div>


                    <!-- Salary Filter -->
                    <!-- Salary Sorting -->


                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
                        rel="stylesheet">
                </form>



            </div>
        </div>
        <br>
        <br>
        <br>
        <a href="{{ route('employee.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Ajouter un enseignant
        </a>
        <br>
        <br><br>


        <div id="tableContainer">
            <!-- Your table code here -->
            @include('private.employee.components.table', ['data' => $data])
        </div>



    </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<script>
    document.getElementById('fullscreenBtn').addEventListener('click', function() {
        var tableContainer = document.getElementById('tableContainer');
        if (!document.fullscreenElement) {
            tableContainer.requestFullscreen().catch(err => {
                alert(Error attempting to enable full-screen mode: ${err.message} (${err.name}));
            });
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    });

    // Optional: Add an event listener to adjust button text based on fullscreen state
    document.addEventListener('fullscreenchange', () => {
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        fullscreenBtn.textContent = document.fullscreenElement ? 'Exit Fullscreen' : 'View Table in Fullscreen';
    });
</script>

{{-- <script>
    $(document).ready(function() {
        // Bind click event to the second column (first name) of each row in the table
        $('.table-hover tbody tr td:nth-child(2)').click(function() {
            const row = $(this).parent(); // Get the parent tr of this td
            const employeeId = row.data(
                'employee-id'); // Assuming each row has a data attribute like data-employee-id

            const details = `
                <p><strong>Name:</strong> ${row.find('td:nth-child(2)').text()} ${row.find('td:nth-child(3)').text()}</p>
                <p><strong>Phone:</strong> ${row.find('td:nth-child(4)').text()}</p>
                <p><strong>Email:</strong> ${row.find('td:nth-child(5)').text()}</p>
                <p><strong>Position:</strong> ${row.find('td:nth-child(6)').text()}</p>
                <p><strong>Salary:</strong> ${row.find('td:nth-child(7)').text()}</p>
                <p><strong>Status:</strong> ${row.find('td:nth-child(8)').html()}</p>
                <a href="/employee/${employeeId}" class="btn btn-primary">View Full Details</a> <!-- Adjust the route as necessary -->
            `;

            // Set the details in the modal's body and show the modal
            $('#employeeDetails').html(details);
            $('#employeeDetailModal').modal('show');
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        // Right-click event on table row
        $('table tbody tr').on('contextmenu', function(e) {
            e.preventDefault(); // Prevent the default context menu

            // Position the context menu
            $('#customContextMenu').css({
                top: e.pageY + 'px',
                left: e.pageX + 'px',
                display: 'block'
            });

            // Store the ID or any relevant data attribute of the row if needed
            var employeeId = $(this).data('employee-id');
            $('#customContextMenu').data('employee-id', employeeId);
        });

        // Click anywhere to close the context menu
        $(document).click(function(e) {
            $('#customContextMenu').hide();
        });

        // Example action when clicking on menu items
        $('#customContextMenu .list-group-item').click(function() {
            var action = $(this).text();
            var employeeId = $('#customContextMenu').data('employee-id');

            console.log("Action: " + action + ", on Employee ID: " + employeeId);

            // Here you can redirect or perform further actions based on the clicked item
            if (action === "View Details") {
                window.location.href = '/employee/' + employeeId; // Adjust URL as needed
            }
            if (action === "Edit") {
                window.location.href = '/employee/' + employeeId + '/edit'; // Adjust URL as needed
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        const colorMap = {};

        function generateColor() {
            const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
            return randomColor;
        }

        rows.forEach(row => {
            const position = row.dataset.position;
            if (!colorMap[position]) {
                colorMap[position] = generateColor(); // Generate color if it doesn't exist
            }
            row.style.backgroundColor = colorMap[position];
        });
    });
</script>

<script>
    document.addEventListener('fullscreenchange', () => {
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        // Clear the current content of the button
        fullscreenBtn.innerHTML = '';

        // Fill it with the correct icon based on fullscreen state
        if (document.fullscreenElement) {
            fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen-exit" id="fullscreenIcon"></i>';
        } else {
            fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen" id="fullscreenIcon"></i>';
        }
    });
</script>
@include('components.private.footer')
