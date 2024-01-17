<?php
    $modules = getshowModuleList();
?>
<div class="card align-middle p-3">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item px-1">
                <a class="nav-link text-capitalize <?php echo e(( $slug == ($module)) ? ' active' : ''); ?> " href="<?php echo e(route('marketplace.index', ($module))); ?>"><?php echo e(Module_Alias_Name($module)); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/LandingPage\Resources/views/marketplace/modules.blade.php ENDPATH**/ ?>