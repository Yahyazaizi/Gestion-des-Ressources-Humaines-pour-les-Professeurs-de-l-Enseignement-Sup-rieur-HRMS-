<div class="sidebar close">
    <div class="logo-details">
        <i class="bi bi-people"></i>

        <span class="logo_name">Hrms</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="/home">
                <i class='home-icon bx bx-home'></i>
                <span class="link_name">Accueil</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/home">Accueil</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='user-icon bx bx-user'></i>
                    <span class="link_name">Employees</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Enseignants</a></li>

                <li><a href="<?php echo e(route('employee.index')); ?>">Tous les enseignants</a></li>
                <li><a href="<?php echo e(route('employee.create')); ?>">Ajouter un enseignant</a></li>
                <li><a href="<?php echo e(route('employees.statistics')); ?>">Statistiques</a></li>
                <li><a href="<?php echo e(route('positions.index')); ?>">Postes</a></li>
                <li><a href="<?php echo e(route('schedules.index')); ?>">Emplois</a></li>
                
                <li><a href="<?php echo e(route('about')); ?>">À propos</a></li>
            </ul>


            
            
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    
                </div>
                <div class="name-job">
                    <div class="profile_name"><?php echo e(Auth::user()->username); ?></div>
                    <div class="job"><?php echo e(Auth::user()->first_name); ?></div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="background: none ; border-style: none"><i
                            class='bx bx-log-out'></i></button>
                </form>
            </div>
        </li></ul>
</div>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/components/private/sidebar.blade.php ENDPATH**/ ?>