
<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('stages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('stages*') ? 'active' : '')); ?>"><?php echo e(__('Task Stage')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('bugstages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('bugstages*') ? 'active' : '')); ?>"><?php echo e(__('Bug Stage')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Taskly\Resources/views/layouts/system_setup.blade.php ENDPATH**/ ?>