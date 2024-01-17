<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales manage')): ?>
    <a href="#sales-print-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('Quote Print Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
     </a>
     <a href="#salesorder-print-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('Sales Order Print Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
     </a>
     <a href="#salesinvoice-print-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('Sales Invoice Print Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
     </a>
<?php endif; ?>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/setting/sidebar.blade.php ENDPATH**/ ?>