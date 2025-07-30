<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">🔍 Rechercher des promotions prévues</h2>

    
    <form method="GET" action="<?php echo e(route('promotions.recherche')); ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="date_effet" class="form-label">Date de promotion prévue</label>
            <input type="date" id="date_effet" name="date_effet" class="form-control" value="<?php echo e(request('date_effet')); ?>">
        </div>

        <div class="col-md-4">
            <label for="nom_prof" class="form-label">Nom du professeur</label>
            <select name="nom_prof" id="nom_prof" class="form-select">
                <option value="">-- Tous les professeurs --</option>
                <?php $__currentLoopData = $professeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($prof->id); ?>" <?php echo e(request('nom_prof') == $prof->id ? 'selected' : ''); ?>>
                        <?php echo e($prof->NOM_ET_PRENOM); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
    </form>

    
    <?php if($notifications->isEmpty()): ?>
        <div class="alert alert-warning">Aucune promotion prévue trouvée.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ancien Grade</th>
                    <th>Nouveau Grade</th>
                    <th>Ancien Échelon</th>
                    <th>Nouveau Échelon</th>
                    <th>Date de Changement</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($notification->nom_complet); ?></td>
                        <td><?php echo e($notification->ancien_grade); ?></td>
                        <td><?php echo e($notification->nouveau_grade); ?></td>
                        <td><?php echo e($notification->ancien_echelon); ?></td>
                        <td><?php echo e($notification->nouveau_echelon); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($notification->date_changement)->format('d/m/Y')); ?></td>
                        <td><?php echo e($notification->message); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/promotions/prevues.blade.php ENDPATH**/ ?>