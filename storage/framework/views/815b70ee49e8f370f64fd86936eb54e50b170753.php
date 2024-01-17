<?php
    $temp_lang = \App::getLocale('lang');
    if($temp_lang == 'ar' || $temp_lang == 'he'){
        $rtl = 'on';
    }
    else {
        $rtl = company_setting('site_rtl',$company_id,$workspace_id);
    }
?>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($rtl == 'on'?'rtl':''); ?>">
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
<head>

<title><?php echo $__env->yieldContent('page-title'); ?> | <?php echo e(!empty(company_setting('title_text',$company_id,$workspace_id)) ? company_setting('title_text',$company_id,$workspace_id) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo')); ?></title>

<meta name="title" content="<?php echo e(!empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash'); ?>">
<meta name="keywords" content="<?php echo e(!empty(admin_setting('meta_keywords')) ? admin_setting('meta_keywords') : 'WorkDo Dash,SaaS solution,Multi-workspace'); ?>">
<meta name="description" content="<?php echo e(!empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'); ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
<meta property="og:title" content="<?php echo e(!empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash'); ?>">
<meta property="og:description" content="<?php echo e(!empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'); ?> ">
<meta property="og:image" content="<?php echo e(get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  )); ?><?php echo e('?'.time()); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
<meta property="twitter:title" content="<?php echo e(!empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash'); ?>">
<meta property="twitter:description" content="<?php echo e(!empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'); ?> ">
<meta property="twitter:image" content="<?php echo e(get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  )); ?><?php echo e('?'.time()); ?>">

<meta name="author" content="Workdo.io">

<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

 <!-- Favicon icon -->
 <link rel="icon" href="<?php echo e(get_file(favicon())); ?><?php echo e('?'.time()); ?>" type="image/x-icon" />

 <!-- font css -->
 <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

 <!-- vendor css -->
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">

 <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>" id="main-style-link">
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/datepicker-bs5.min.css')); ?>" >
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/flatpickr.min.css')); ?>" >
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('css/custome.css')); ?>">
 <?php echo $__env->yieldPushContent('css'); ?>

 <?php if( $rtl == 'on'): ?>
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
<?php endif; ?>

<?php if(company_setting('cust_darklayout',$company_id,$workspace_id) == 'on'): ?>
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>" id="main-style-link">
<?php endif; ?>

<?php if( $rtl != 'on' && company_setting('cust_darklayout',$company_id,$workspace_id) != 'on'): ?>
 <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
<?php endif; ?>

 <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
 <link rel="stylesheet" href="<?php echo e(asset('Modules/Account/Resources/assets/css/nprogress.css')); ?>" >
<script src="<?php echo e(asset('Modules/Account/Resources/assets/js/nprogress.js')); ?>"></script>
</head>

<body class="<?php echo e(!empty(company_setting('color',$company_id,$workspace_id))?company_setting('color',$company_id,$workspace_id):'theme-1'); ?>">
    <div class="container">
        <div class="dash-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                  <div class="page-block">
                      <div class="row align-items-center">
                          <div class="col-md-12 mt-5 mb-4">
                              <div class="d-block d-sm-flex align-items-center justify-content-between">
                                  <div>
                                      <div class="page-header-title">
                                          <h4 class="m-b-10"><?php echo $__env->yieldContent('page-title'); ?></h4>
                                      </div>
                                      <ul class="breadcrumb">
                                              <?php echo $__env->yieldContent('breadcrumb'); ?>
                                      </ul>
                                  </div>
                                  <div>
                                    <?php echo $__env->yieldContent('action-btn'); ?>
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            <!-- <div class="row"> -->
                   <?php echo $__env->yieldContent('content'); ?>

            <!-- </div> -->

        </div>
    </div>
    <div  id="commonModal" class="modal" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-modal="true" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"> </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/tinymce/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dash.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/simple-datatables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap-switch-button.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/datepicker-full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.form.js')); ?>"></script>



<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<?php if($message = Session::get('success')): ?>
    <script>
        toastrs('Success', '<?php echo $message; ?>', 'success');
    </script>
<?php endif; ?>
<?php if($message = Session::get('error')): ?>
    <script>
        toastrs('Error', '<?php echo $message; ?>', 'error');
    </script>
<?php endif; ?>
<?php if(admin_setting('enable_cookie') == 'on'): ?>
<?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/resources/views/layouts/invoicepayheader.blade.php ENDPATH**/ ?>