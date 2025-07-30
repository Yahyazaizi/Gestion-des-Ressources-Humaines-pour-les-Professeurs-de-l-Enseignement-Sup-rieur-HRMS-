<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Détails de l'employé</h2>
    <ul class="list-group">

        <li class="list-group-item"><strong>Doti :</strong> <?php echo e($employee->tpr); ?></li>

        <li class="list-group-item"><strong>Prénom :</strong> <?php echo e($employee->first_name); ?></li>
        <li class="list-group-item"><strong>Nom :</strong> <?php echo e($employee->last_name); ?></li>
        <li class="list-group-item"><strong>Nom et Prénom :</strong> <?php echo e($employee->NOM_ET_PRENOM); ?></li>
        <li class="list-group-item"><strong>Nom Prénom :</strong> <?php echo e($employee->nom_prenom); ?></li>
        <li class="list-group-item"><strong>الاسم :</strong> <?php echo e($employee->prenomar); ?></li>
        <li class="list-group-item"><strong>النسب :</strong> <?php echo e($employee->nomar); ?></li>

        <li class="list-group-item"><strong>CIN :</strong> <?php echo e($employee->national_id); ?></li>
        <li class="list-group-item"><strong>DRMC :</strong> <?php echo e($employee->drmc); ?></li>
        <li class="list-group-item"><strong>DRM/ATT/S :</strong> <?php echo e($employee->drm_att_s); ?></li>
        <li class="list-group-item"><strong>Cadre :</strong> <?php echo e($employee->cadre); ?></li>
        <li class="list-group-item"><strong>Date Effet Échelon :</strong> <?php echo e($employee->date_effet1); ?></li>
        <li class="list-group-item"><strong>Date Effet Cadre :</strong> <?php echo e($employee->date_effet2); ?></li>
        <li class="list-group-item"><strong>Grade :</strong> <?php echo e($employee->grade); ?></li>
        <li class="list-group-item"><strong>Échelon :</strong> <?php echo e($employee->ech); ?></li>
        <li class="list-group-item"><strong>Indice :</strong> <?php echo e($employee->indice); ?></li>
        <li class="list-group-item"><strong>Département :</strong> <?php echo e($employee->dep); ?></li>
        <li class="list-group-item"><strong>Spécialité :</strong> <?php echo e($employee->specialite); ?></li>
        <li class="list-group-item"><strong>Sexe :</strong> <?php echo e($employee->sex); ?></li>
        <li class="list-group-item"><strong>Date de naissance :</strong> <?php echo e($employee->date_of_birth); ?></li>

    </ul>
    <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-secondary mt-3">Retour</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.private.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/private/employee/show.blade.php ENDPATH**/ ?>