<?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.831)), url('<?php echo e(asset("bcg.jpg")); ?>'),no-repeat;
        font-family: 'Segoe UI', sans-serif;
        background-size: cover;
        background-position: left;
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        backdrop-filter: blur(2px);
    }

    .login-box {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 450px;
        text-align: center;
    }

    .login-box img {
        width: 100px;
        margin-bottom: 20px;
    }

    .login-box h2 {
        font-size: 22px;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .login-box p {
        color: #7f8c8d;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .form-control {
        margin-bottom: 15px;
        height: 45px;
        border-radius: 8px;
    }

    .btn-login {
        background-color: #004d33;
        color: white;
        width: 100%;
        border-radius: 8px;
        padding: 12px;

        font-weight: bold;
    }

    .btn-login:hover {
        background-color: #003322;
        color: white
    }

    .footer-links {
        margin-top: 20px;
        font-size: 14px;
        color: #555;
    }

    .footer-links a {
        color: #2980b9;
        text-decoration: none;
    }
</style>

<div class="login-wrapper">
    <div class="login-box">
        <img class="logo-fssm" src="<?php echo e(asset('logo.jpg')); ?>"  alt="Logo">

        <h2>Bienvenue</h2>
        <p>Connexion à la plateforme RH des enseignants</p>

       

        <form action="<?php echo e(route('auth')); ?>" method="post">
            <?php echo csrf_field(); ?>

            <input type="text" name="username" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Identifiant" value="<?php echo e(old('username')); ?>">
            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Mot de passe">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <button type="submit" class="btn btn-login mt-3">Connexion</button>
        </form>

        <?php if($errors->has('credentials')): ?>
            <div class="alert alert-danger mt-3">
                <?php echo e($errors->first('credentials')); ?>

            </div>
        <?php endif; ?>


    </div>
</div>

<?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/auth/login.blade.php ENDPATH**/ ?>