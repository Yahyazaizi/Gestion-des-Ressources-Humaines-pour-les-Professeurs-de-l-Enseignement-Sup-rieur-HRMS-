<style>
    thead th {
        position: sticky;
        top: 0;
        background-color: #000;
        color: white;
        z-index: 2;
    }
</style>

<!-- Bootstrap CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div><?php echo $__env->make('import_exel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
<br><br>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm">
        <thead class="table-dark">
            <tr>
                <th>Doti</th>
                <th>Nom & Prénom</th>
                <th>Nom Arabe</th>
                <th>Prénom Arabe</th>
                <th>CIN</th>
                <th>Cadre</th>
                <th>Grade </th>
                <th>Sexe</th>
                <th>Date Naissance</th>
                <th>Date Retraite</th>
                <th>Spécialité</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($employee->tpr); ?></td>

                    <!-- Nom & Prénom avec lien pour afficher la modale -->
                    <td>
                        <a href="#" class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#employeeModal<?php echo e($employee->id); ?>">
                            <strong><?php echo e($employee->NOM_ET_PRENOM ?? $employee->first_name . ' ' . $employee->last_name); ?></strong>
                        </a>

                        <!-- Modal de détails -->
                        <div class="modal fade" id="employeeModal<?php echo e($employee->id); ?>" tabindex="-1" aria-labelledby="employeeModalLabel<?php echo e($employee->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="employeeModalLabel<?php echo e($employee->id); ?>">
                                            <?php echo e($employee->NOM_ET_PRENOM ?? $employee->first_name . ' ' . $employee->last_name); ?>

                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">

                                                <p><strong>Nom Ar :</strong> <?php echo e($employee->nomar); ?></p>
                                                <p><strong>Prénom Ar :</strong> <?php echo e($employee->prenomar); ?></p>
                                                <p><strong>Spécialité :</strong> <?php echo e($employee->specialite); ?></p>
                                                <p><strong>D, R, M, C :</strong> <?php echo e($employee->drmc); ?></p>
                                                <p><strong>D, R, M, ATT, S :</strong> <?php echo e($employee->drm_att_s); ?></p>
                                                <p><strong>Date Effet 1 :</strong> <?php echo e($employee->date_effet1); ?></p>
                                                <p><strong>Date Effet 2 :</strong> <?php echo e($employee->date_effet2); ?></p>
                                                <p><strong>Grade :</strong> <?php echo e($employee->grade); ?></p>

                                                <hr>
                                                <a href="<?php echo e(route('employee.show', ['employee' => $employee->id])); ?>" class="btn btn-primary">
                                                    Voir les détails complets
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td><?php echo e($employee->nomar); ?></td>
                    <td><?php echo e($employee->prenomar); ?></td>
                    <td><?php echo e($employee->national_id); ?></td>
                    <td><?php echo e($employee->cadre); ?></td>
                    <td><?php echo e($employee->grade); ?></td>
                    <td><?php echo e($employee->sex ?? $employee->gender); ?></td>
                    <td><?php echo e($employee->date_of_birth); ?></td>
                    <td><?php echo e($employee->date_retarite); ?></td>
                    <td><?php echo e($employee->specialite); ?></td>

                    <td>
                        


                            <div class="btn-group" role="group">
                                <!-- View Button -->
                                <a href="<?php echo e(route('employee.show', ['employee' => $employee->id])); ?>" class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="<?php echo e(route('employee.edit', ['employee' => $employee->id])); ?>" class="btn btn-outline-dark" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="<?php echo e(route('employee.destroy', $employee->id)); ?>" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </div>


                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    <?php echo e($data->links('vendor.pagination.bootstrap-5')); ?>

</div>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/private/employee/components/table.blade.php ENDPATH**/ ?>