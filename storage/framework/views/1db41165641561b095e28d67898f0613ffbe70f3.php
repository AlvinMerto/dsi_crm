
<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('pipelines.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('pipelines*') ? 'active' : '')); ?>"><?php echo e(__('Pipelines')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('lead-stages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('lead-stages*') ? 'active' : '')); ?>"><?php echo e(__('Lead Stages')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('deal-stages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('deal-stages*') ? 'active' : '')); ?>"><?php echo e(__('Deal Stages')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('labels.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('labels*') ? 'active' : '')); ?>"><?php echo e(__('Label')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('sources.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('sources*') ? 'active' : '')); ?>"><?php echo e(__('Sources')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Lead\Resources/views/layouts/system_setup.blade.php ENDPATH**/ ?>