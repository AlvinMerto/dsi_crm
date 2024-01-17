
<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('account_type.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('account_type*') ? 'active' : '')); ?>"><?php echo e(__('Account Type')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('account_industry.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('account_industry*') ? 'active' : '')); ?>"><?php echo e(__('Account Industry')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('opportunities_stage.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('opportunities_stage*') ? 'active' : '')); ?>"><?php echo e(__('Opportunities Stage')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('case_type.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('case_type*') ? 'active' : '')); ?>"><?php echo e(__('Case Type')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('shipping_provider.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('shipping_provider*') ? 'active' : '')); ?>"><?php echo e(__('Shipping Provider')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('salesdocument_type.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('salesdocument_type*') ? 'active' : '')); ?>"><?php echo e(__('Document Type')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('salesdocument_folder.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('salesdocument_folder*') ? 'active' : '')); ?>"><?php echo e(__('Document Folder')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    </div>
</div>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/layouts/system_setup.blade.php ENDPATH**/ ?>