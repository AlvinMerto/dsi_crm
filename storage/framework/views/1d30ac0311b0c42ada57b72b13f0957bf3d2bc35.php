<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Reset Password')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('language-bar'); ?>
    <li class="dropdown dash-h-item drp-language nav-item">
        <a class="dash-head-link dropdown-toggle btn btn-primary text-white" data-bs-toggle="dropdown" href="#">
            <span class="drp-text hide-mob text-white"><?php echo e(Str::upper($lang)); ?></span>
        </a>
        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url('/forgot-password',$key)); ?>" class="dropdown-item <?php if($lang == $key): ?> text-primary  <?php endif; ?>">
                    <span><?php echo e(Str::ucfirst($language)); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
     </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="row align-items-center text-start">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="">
                    <h2 class="mb-3 f-w-600"><?php echo e(__('Forgot Password')); ?></h2>
                    <?php if(session('status')): ?>
                        <div class="alert alert-primary">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                  <p class="text-xs text-muted"><?php echo e(__('We will send a link to reset your password')); ?></p>
                </div>
                <form method="POST" action="<?php echo e(route('password.email')); ?>" id="form_data">
                    <?php echo csrf_field(); ?>
                    <div class="">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><?php echo e(__('Email')); ?></label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error invalid-email text-danger" role="alert">
                                <small><?php echo e($message); ?></small>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <?php if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' ): ?>
                            <div class="form-group col-lg-12 col-md-12 mt-3">
                                <?php echo NoCaptcha::display(); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error small text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-submit btn-block mt-2"><?php echo e(__('Send Password Reset Link')); ?>  </button>
                        </div>
                        <p class="my-4 text-center"><?php echo e(__('Or')); ?>

                            <a href="<?php echo e(route('login',$lang)); ?>" class="my-4 text-primary"><?php echo e(__('Login')); ?></a><?php echo e(__(' With')); ?>

                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6 img-card-side">
            <div class="auth-img-content">
                <img src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>" alt="" class="img-fluid">
                <h3 class="text-white mb-4 mt-5"> <?php echo e(__('“Attention is the new currency”')); ?></h3>
                <p class="text-white"> <?php echo e(__('The more effortless the writing looks, the more effort the writer
                    actually put into the process.')); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
<?php if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' ): ?>
        <?php echo NoCaptcha::renderJs(); ?>

<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>