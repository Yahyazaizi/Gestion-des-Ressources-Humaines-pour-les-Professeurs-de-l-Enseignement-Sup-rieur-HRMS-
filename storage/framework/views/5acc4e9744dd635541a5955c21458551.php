<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
   :root {
    --primary: #2d6a4f; /* Vert foncé */
    --primary-light: #3a8d7b; /* Vert clair */
    --secondary: #1b4332; /* Vert foncé secondaire */
    --success: #52b788; /* Vert de succès */
    --warning: #f8961e;
    --danger: #f72585;
    --light: #f8f9fa;
    --dark: #212529;
    --gray: #6c757d;
    --white: #ffffff;
    --dark-blue: #1a237e;
}

    .notifications-container {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        margin: 2rem auto;
        max-width: 1200px;
        margin-left: 20px
    }

    .page-title {
        color: var(--dark-blue);
        font-weight: 700;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.8rem;
    }

    .page-title i {
        color: var(--primary);
    }

    .filter-card {
        background-color: #f8fafc;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
    }

    .filter-btn {
        background-color: var(--primary);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-left: 20px
    }

    .filter-btn:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .notification-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 2rem;
    }

    .notification-table thead th {
        background-color: var(--primary);
        color: white;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border: none;
        position: sticky;
        top: 0;
    }

    .notification-table tbody tr {
        transition: all 0.2s;
    }

    .notification-table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.03);
    }

    .notification-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .badge-grade {
        display: inline-block;
        padding: 0.4em 0.7em;
        font-size: 0.8em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 6px;
        background-color: var(--primary-light);
        color: white;
    }

    .badge-echelon {
        display: inline-block;
        padding: 0.4em 0.7em;
        font-size: 0.8em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 6px;
        background-color: var(--success);
        color: white;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
        background-color: rgba(248, 150, 30, 0.05);
        border-radius: 10px;
        border-left: 4px solid var(--warning);
    }

    .empty-state i {
        font-size: 2rem;
        color: var(--warning);
        margin-bottom: 1rem;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .page-link {
        color: var(--primary);
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem;
        margin: 0 4px;
        border-radius: 6px;
        transition: all 0.3s;
    }

    .page-link:hover {
        color: var(--secondary);
        background-color: #f8fafc;
        border-color: #e2e8f0;
    }

    @media (max-width: 992px) {
        .notifications-container {
            padding: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .filter-card .row > div {
            margin-bottom: 1rem;
        }

        .notification-table {
            display: block;
            overflow-x: auto;
        }

        .notification-table thead {
            display: none;
        }

        .notification-table tbody tr {
            display: block;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
        }

        .notification-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
            padding: 0.75rem 1rem;
        }

        .notification-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--primary);
            margin-right: 1rem;
        }
    }
</style>

<div class="notifications-container container-fluid">
    <h1 class="page-title text-dark">
        <i class="fas fa-bell"></i> Notifications
    </h1>

    <!-- Filtrer par année et enseignant -->
    <div class="filter-card">
        <form action="<?php echo e(route('notifications.index')); ?>"  method="get">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-3">
                    <label for="year" class="form-label">Année</label>
                    <input type="number" name="year" id="year" class="form-control"
                        value="<?php echo e(request('year', date('Y'))); ?>" min="2000" max="2100">
                </div>

                <div class="col-md-3">
                    <label for="employee_id" class="form-label">Enseignant</label>
                    <select name="employee_id" id="employee_id" class="form-control select2">
                        <option value="">-- Tous les enseignants --</option>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->id); ?>" <?php echo e(request('employee_id') == $employee->id ? 'selected' : ''); ?>>
                                <?php echo e($employee->NOM_ET_PRENOM); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="tpr" class="form-label">Doti</label>
                    <input type="number" name="tpr" id="tpr" class="form-control"
                        value="<?php echo e(request('tpr')); ?>" min="0" max="9999999" step="1" placeholder="Filtrer par Doti">
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- Afficher les notifications -->
    <?php if($notifications->count()): ?>
    <div class="table-responsive">
        <table style="margin-left: 25px;" class=" notification-table table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Enseignant</th>
                    <th>Ancien Cadre</th>
                    <th>Nouveau Cadre</th>
                    <th>Notification</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td data-label="Enseignant">
                            <strong><?php echo e($notification->employee->NOM_ET_PRENOM ?? '-'); ?></strong>
                        </td>
                        <td data-label="Ancien Grade">
                            <span class="badge-grade"><?php echo e($notification->ancien_grade); ?></span>
                            <span class="badge-echelon"><?php echo e($notification->ancien_echelon); ?></span>
                        </td>
                        <td data-label="Nouveau Grade">
                            <span class="badge-grade"><?php echo e($notification->nouveau_grade); ?></span>
                            <span class="badge-echelon"><?php echo e($notification->nouveau_echelon); ?></span>
                        </td>
                        <td data-label="Notification">
                            <div class="notification-message">
                                <?php echo e($notification->message); ?>

                            </div>
                        </td>
                        <td data-label="Date">
                            <span class="text-muted">
                                <?php echo e(\Carbon\Carbon::parse($notification->date_changement)->format('d/m/Y H:i')); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container">
            <?php echo e($notifications->links('vendor.pagination.bootstrap-4')); ?>

        </div>
    </div>
    <?php else: ?>
    <div class="empty-state">
        <i class="fas fa-exclamation-circle"></i>
        <h3>Aucune notification trouvée</h3>
        <p class="text-muted">Veuillez ajuster les filtres pour voir les résultats</p>
    </div>
    <?php endif; ?>
</div>

<!-- Select2 pour les champs de sélection -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.select2').select2({
        placeholder: "Choisir un enseignant",
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Aucun résultat trouvé";
            }
        }
    });

    function fetchTeachers() {
        var cadreSelectionne = $('#cadre').val();
        var tpr = $('#tpr').val();

        $.ajax({
            url: "<?php echo e(route('notifications.getTeachersByCadre')); ?>",
            type: "GET",
            data: {
                cadre: cadreSelectionne,
                tpr: tpr
            },
            dataType: "json",
            success: function(data) {
                var select = $('#employee_id');
                select.empty();

                // Ajouter une option vide
                select.append('<option value="">-- Tous les enseignants --</option>');

                $.each(data, function(index, teacher) {
                    select.append('<option value="' + teacher.id + '">' + teacher.NOM_ET_PRENOM + '</option>');
                });

                select.trigger('change.select2');
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement des enseignants: " + error);
            }
        });
    }

    // Lorsque le cadre ou le TPR changent -> rafraîchir la liste
    $('#cadre, #tpr').on('change keyup', function() {
        fetchTeachers();
    });

    // Animation d’apparition des lignes (conservation de ton code)
    $('.notification-table tbody tr').each(function(i) {
        $(this).css('opacity', 0)
               .delay(i * 100)
               .animate({opacity: 1}, 300);
    });

    // Mise en évidence des dates récentes (conservation de ton code)
    $('.notification-table td[data-label="Date"]').each(function() {
        const dateText = $(this).text().trim();
        const notificationDate = new Date(dateText.split('/').reverse().join('-'));
        const daysDiff = Math.floor((new Date() - notificationDate) / (1000 * 60 * 60 * 24));

        if (daysDiff <= 1) {
            $(this).find('span').addClass('text-danger fw-bold');
        } else if (daysDiff <= 7) {
            $(this).find('span').addClass('text-warning');
        }
    });
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/notifications/index.blade.php ENDPATH**/ ?>