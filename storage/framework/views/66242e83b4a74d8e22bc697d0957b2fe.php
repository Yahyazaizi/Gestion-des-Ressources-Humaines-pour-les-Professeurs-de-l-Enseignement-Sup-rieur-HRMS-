<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text text-dark">Accueil</span>
    </div>
     <style>

        .container-fluid {
            padding: 0;
            margin: 0;
            width: 100%; /* Adjusted to fill the entire screen */
        }

        .card {
            width: 100%; /* Adjusted to fill the entire screen */
        }

        .home-section{
            height: fit-content;
        }
    </style>
    <div class="container-fluid mt-5">
        <div>
            <h1 class="text-dark ms-3 mb-5">Bonjour, <?php echo e(Auth()->user()->first_name); ?></h1>
            <div class="">
                <div class="card" style="margin: 0 ; width:auto;" data-bs-theme="light">
                    <div class="card-body">
                        <canvas id="employeeChart" width="400" height="200"></canvas>
                    </div>
                    <div class="mt-4 container ">
                        <h2 class="ms-4">Grades Statistics</h2>
                        <table class="table table-hover table-striped table-white">
                            <thead>
                                <tr>
                                    <th scope="col">Grades</th>
                                    <th scope="col">Total des Enseignants</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($position->name); ?></td>
                                    <td><?php echo e($position->all_employees_count); ?></td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="m-5">
                        <h2 class="text-dark mb-4">Derniers Employés Ajoutés</h2>
                        <div class="row">
                            <?php $__currentLoopData = $lastAddedEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lemployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-success text-white fw-bold">
                                        <a href="<?php echo e(route('employee.show', ['employee' => $lemployee->id])); ?>" class="text-white text-decoration-none">
                                            <?php echo e($lemployee->first_name); ?> <?php echo e($lemployee->last_name); ?>

                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text mb-2">
                                            <strong>Poste :</strong> <?php echo e($lemployee->position?->name ?? 'Non défini'); ?>

                                        </p>
                                        <p class="card-text">
                                            <strong>Date d'ajout :</strong> <?php echo e($lemployee->created_at->format('d M Y')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

<hr>
<div class="m-5">
    <h2 class="text-dark mb-4">Top 3 des Employés les Plus Anciens</h2>
    <div class="row">
        <?php $__currentLoopData = $oldestEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oemployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    <a href="<?php echo e(route('employee.show', ['employee' => $oemployee->id])); ?>" class="text-white text-decoration-none">
                        <?php echo e($oemployee->first_name); ?> <?php echo e($oemployee->last_name); ?>

                    </a>
                </div>
                <div class="card-body">
                    <p class="card-text mb-2">
                        <strong>Poste :</strong> <?php echo e($oemployee->position?->name ?? 'Non défini'); ?>

                    </p>
                    <p class="card-text">
                        <strong>Date d'embauche :</strong> <?php echo e($oemployee->created_at->format('d M Y')); ?>

                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<hr>




                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
   var ctx = document.getElementById('employeeChart').getContext('2d');
var employeeChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Total Enseignants', 'Enseignants'],
        datasets: [{
            label: '# Pour les Enseignants',
            data: [<?php echo e($totalEmployees); ?>, <?php echo e($employee); ?>, <?php echo e($inTraining); ?>, <?php echo e($trained); ?>, <?php echo e($terminated); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // Total Employees
                'rgba(54, 162, 235, 0.2)',  // Employees
                'rgba(255, 206, 86, 0.2)',  // In Training
                'rgba(75, 192, 192, 0.2)',  // Trained
                'rgba(153, 102, 255, 0.2)'  // Terminated
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#000' // Noir pour texte axe Y
                },
                grid: {
                    color: '#ccc' // Grille plus claire
                }
            },
            x: {
                ticks: {
                    color: '#000' // Noir pour texte axe X
                },
                grid: {
                    color: '#ccc'
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    color: '#000' // Légende en noir
                }
            },
            tooltip: {
                enabled: true,
                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                titleColor: '#000',
                bodyColor: '#000',
                borderColor: '#000',
                borderWidth: 1
            }
        }
    }
});

</script>

 <?php echo $__env->make('components.private.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/private/home.blade.php ENDPATH**/ ?>