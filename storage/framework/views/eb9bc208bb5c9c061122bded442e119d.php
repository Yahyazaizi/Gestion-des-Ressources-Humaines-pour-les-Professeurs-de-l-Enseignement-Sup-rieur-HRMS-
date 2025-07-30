
<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .week-calendar {
        display: flex;
        justify-content: start;
        list-style: none;
        padding: 0;
        margin: 0;
        overflow: hidden;
    }

    .week-calendar li {
        flex: 1;
        padding: 15px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        text-align: center;
        margin: 2px;
        font-size: 14px;
    }

    .week-calendar .active {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .container-sm {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .btn-print {
        margin-top: 20px;
    }

    @media print {
        body {
            font-size: 12px;
            color: #000;
        }

        .header,
        .sidebar,
        .btn,
        .bx-menu,
        .text {
            display: none;
        }

        .home-section,
        .container-sm {
            box-shadow: none;
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .container-sm {
            border: none;
        }

        .week-calendar {
            justify-content: space-between;
        }

        .week-calendar li {
            border: 1px solid #000;
            /* Better visibility in print */
            background-color: #FFF;
            /* White background for printing */
            color: #000;
            /* Ensure text is black for printing */
        }

        .week-calendar .active {
            background-color: #000;
            color: #FFF;
        }
    }
</style>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Afficher l’emploi du temps</span>
</div>
<div class="container-sm mt-5">
    <h2>Détails de <?php echo e($schedule->name); ?></h2>
    <ul class="week-calendar">
        <?php
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $daysFr = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            $scheduleDays = explode(',', $schedule->days_of_week);
        ?>
        <?php $__currentLoopData = $daysOfWeek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php echo e(in_array($day, $scheduleDays) ? 'active' : ''); ?>"><?php echo e($daysFr[$index]); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <div class="container-sm mt-2">
        <p><strong>Heure de début :</strong> <?php echo e($schedule->start_time); ?></p>
        <p><strong>Heure de fin :</strong> <?php echo e($schedule->end_time); ?></p>
        <p><strong>Nombre de jours :</strong> <?php echo e(count($scheduleDays)); ?></p>
    </div>

    
    <?php if(!$schedule->employees->isNotEmpty()): ?>
        <div class="alert alert-warning" role="alert">
            Aucun enseignant assigné à cet emploi du temps.
        </div>
    <?php endif; ?>

    <br>
    <div>
        <a href="<?php echo e(route('schedules.index')); ?>" class="btn btn-primary mt-3">Retour à la liste</a>
        <a href="<?php echo e(route('schedule.assigned' , ["id" => $schedule->id])); ?>" class="btn btn-primary mt-3">Voir les enseignants assignés</a>
        <button onclick="window.print()" class="btn btn-secondary btn-print">Imprimer l’emploi du temps</button>
    </div>

    </div>
    </div>
</section>

<?php echo $__env->make('components.private.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/schedules/show.blade.php ENDPATH**/ ?>