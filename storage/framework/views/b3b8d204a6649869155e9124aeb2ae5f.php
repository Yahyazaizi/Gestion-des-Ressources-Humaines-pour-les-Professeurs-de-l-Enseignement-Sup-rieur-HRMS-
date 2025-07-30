<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<section class="home-section" style="margin-bottom: 500px">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Statistiques des Enseignants</span>
</div>
<div class="mycontent">
    <div class="container mt-5">

        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nombre total d’enseignants : <span class="badge bg-primary"><?php echo e($totalEmployees); ?></span>
            </li>




            <?php $__currentLoopData = $ageDistribution; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="list-group-item list-group-item-action list-group-item-dark">
                    Âge <?php echo e($range); ?> : <span class="badge bg-dark"><?php echo e($count); ?></span>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $positionCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="list-group-item list-group-item-action" style="background-color: #7e50d3; color: white;">
                    <?php echo e($position); ?> : <span class="badge" style="background-color: #9966cc;"><?php echo e($count); ?></span>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <br><br>

        <div class="accordion" id="nationalityAccordion">
            <div class="accordion-item">


                </div>
            </div>

            <div class="container-fluid"> <!-- Ensure there's span container wrapping your rows -->
                <div class="row flex-wrap">

                    <div class=" col-md-5 bg-white shadow rounded my-2 mx-1">
                        <canvas id="ageDistributionChart" width="400" height="400"></canvas>
                    </div>
                    <div class=" col-md-5 bg-white shadow rounded my-2 mx-1">
                        <canvas id="positionDistributionChart" width="400" height="400"></canvas>
                    </div>
                    <div style="visibility: hidden" class=" col-md-5 bg-white shadow rounded my-2 mx-1">
                        <canvas id="salaryDistributionChart" width="400" height="400"></canvas>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var genderData = <?php echo json_encode($genderDistribution, 15, 512) ?>;
        var ageData = <?php echo json_encode($ageDistribution, 15, 512) ?>;
        var salaryData = <?php echo json_encode([$averageSalary, $maxSalary, $minSalary]) ?>;
        var positionData = <?php echo json_encode($positionDistribution, 15, 512) ?>;
        var countryData = <?php echo json_encode($nationalityDistribution, 15, 512) ?>;

        // Gender Distribution Pie Chart
        new Chart(document.getElementById('genderDistributionChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(genderData),
                datasets: [{
                    label: 'Gender Distribution',
                    data: Object.values(genderData),
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Age Distribution Bar Chart
        new Chart(document.getElementById('ageDistributionChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(ageData),
                datasets: [{
                    label: 'Age Distribution',
                    data: Object.values(ageData),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Salary Distribution Line Chart
        new Chart(document.getElementById('salaryDistributionChart'), {
            type: 'line',
            data: {
                labels: ['Average Salary', 'Max Salary', 'Min Salary'],
                datasets: [{
                    label: 'Salary Statistics',
                    data: salaryData,
                    fill: false,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    tension: 0.1
                }]
            }
        });

        // Position Distribution Doughnut Chart
        new Chart(document.getElementById('positionDistributionChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(positionData),
                datasets: [{
                    label: 'Position Distribution',
                    data: Object.values(positionData),
                    backgroundColor: [
                        'rgba(255, 205, 86, 0.2)', 'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 205, 86, 1)', 'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Country Distribution Doughnut Chart
        new Chart(document.getElementById('countryDistributionChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(countryData),
                datasets: [{
                    label: 'Country Distribution',
                    data: Object.values(countryData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // This will hide the legend
                    }
                }
            }
        });;
    });
</script>

<?php echo $__env->make('components.private.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/private/employee/statistics.blade.php ENDPATH**/ ?>