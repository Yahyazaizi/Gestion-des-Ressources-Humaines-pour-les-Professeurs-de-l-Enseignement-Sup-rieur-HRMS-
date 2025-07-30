<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Modifier un employé</h2>

    <form action="<?php echo e(route('employee.update', $employee->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>TPR</label>
                <input type="text" name="tpr" class="form-control" value="<?php echo e(old('tpr', $employee->tpr)); ?>">
            </div>


            <div class="col-md-6 mb-3">
                <label>Prénom</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo e(old('first_name', $employee->first_name)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Nom</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo e(old('last_name', $employee->last_name)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Nom et Prénom</label>
                <input type="text" name="NOM_ET_PRENOM" class="form-control" value="<?php echo e(old('NOM_ET_PRENOM', $employee->NOM_ET_PRENOM)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Nom Prénom (AR)</label>
                <input type="text" name="nom_prenom" class="form-control" value="<?php echo e(old('nom_prenom', $employee->nom_prenom)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>الاسم</label>
                <input type="text" name="nomar" class="form-control" value="<?php echo e(old('nomar', $employee->nomar)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>النسب</label>
                <input type="text" name="prenomar" class="form-control" value="<?php echo e(old('prenomar', $employee->prenomar)); ?>">
            </div>


            <div class="col-md-6 mb-3">
                <label>CIN</label>
                <input type="text" name="national_id" class="form-control" value="<?php echo e(old('national_id', $employee->national_id)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>DRMC</label>
                <input type="date" name="drmc" class="form-control" value="<?php echo e(old('drmc', $employee->drmc)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>DRM/ATT/S</label>
                <input type="date" name="drm_att_s" class="form-control" value="<?php echo e(old('drm_att_s', $employee->drm_att_s)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Cadre</label>
                <input type="text" name="cadre" class="form-control" value="<?php echo e(old('cadre', $employee->cadre)); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" value="<?php echo e(old('grade', $employee->grade)); ?>">
            </div>


            <div class="col-md-6 mb-3">
                <label>Date Effet 1</label>
                <input type="date" name="date_effet1" class="form-control" value="<?php echo e(old('date_effet1', $employee->date_effet1)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Date Effet 2</label>
                <input type="date" name="date_effet2" class="form-control" value="<?php echo e(old('date_effet2', $employee->date_effet2)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Échelon</label>
                <input type="text" name="ech" class="form-control" value="<?php echo e(old('ech', $employee->ech)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Indice</label>
                <input type="text" name="indice" class="form-control" value="<?php echo e(old('indice', $employee->indice)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Département</label>
                <input type="text" name="dep" class="form-control" value="<?php echo e(old('dep', $employee->dep)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Spécialité</label>
                <input type="text" name="specialite" class="form-control" value="<?php echo e(old('specialite', $employee->specialite)); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Sexe</label>
                <select name="sex" class="form-control">
                    <option value="M" <?php echo e(old('sex', $employee->sex) == 'M' ? 'selected' : ''); ?>>Masculin</option>
                    <option value="F" <?php echo e(old('sex', $employee->sex) == 'F' ? 'selected' : ''); ?>>Féminin</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Date de naissance</label>
                <input type="date" name="date_of_birth" class="form-control" value="<?php echo e(old('date_of_birth', $employee->date_of_birth)); ?>">
            </div>
        </div>

       <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
        <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/private/employee/edit.blade.php ENDPATH**/ ?>