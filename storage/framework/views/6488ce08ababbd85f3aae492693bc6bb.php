<div class="sidebar close">
    <div class="logo-details">
        <i class="bi bi-people"></i>        <span class="logo_name">Hrms</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="<?php echo e(route("moderator.index")); ?>">
                <i class='home-icon bx bx-home'></i>
                <span class="link_name">Accueil</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="<?php echo e(route("moderator.index")); ?>">Accueil</a></li>
            </ul>
        </li>
        
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <!--<img src="image/profile.jpg" alt="profileImg">-->
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
        </li>
    </ul>
</div>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/moderator/components/private/sidebar.blade.php ENDPATH**/ ?>