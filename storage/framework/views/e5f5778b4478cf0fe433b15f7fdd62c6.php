<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="home-section" style="margin-bottom: 500px">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Afficher <?php switch($training_id):
                case (0): ?>
                    Enseignant
                <?php break; ?>


                <?php break; ?>
            <?php endswitch; ?>
            pour poste : <?php echo e($position->name); ?>

        </span>
    </div>
    <div class="mycontent">
        <div class="container-sm mt-5">

            <div class="pagination">
                <?php echo e($employees->appends(request()->except('page'))->links('vendor.pagination.simple-bootstrap-4')); ?>

            </div>
            <?php if($employees->isEmpty()): ?>
                <p>Aucun enseignant trouvé avec le statut de formation spécifié à ce poste.</p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom et Prenom</th>

                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></td>

                                <td>
                                    <?php switch($training_id):
                                        case (0): ?>
                                            Enseignant
                                        <?php break; ?>


                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </td>
                                <td>
                                    <?php switch($training_id):
                                        case (0): ?>
                                            <a href="<?php echo e(route('employee.show', $employee->id)); ?>"
                                                class="btn btn-primary btn-sm">Voir</a>
                                        <?php break; ?>

                                        <?php case (1): ?>
                                            <a href="<?php echo e(route('trainee.show', $employee->id)); ?>"
                                                class="btn btn-primary btn-sm">Voir</a>
                                        <?php break; ?>

                                        <?php case (2): ?>
                                            <a href="<?php echo e(route('trained.show', $employee->id)); ?>"
                                                class="btn btn-primary btn-sm">Voir</a>
                                        <?php break; ?>
                                    <?php endswitch; ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php echo e($employees->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php echo $__env->make('components.private.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/positions/showEmployees.blade.php ENDPATH**/ ?>