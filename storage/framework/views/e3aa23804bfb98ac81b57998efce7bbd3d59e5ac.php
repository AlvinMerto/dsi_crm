<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('supportticket setting')): ?>
<a href="#supportticket_sidenav" class="list-group-item list-group-item-action">
       <?php echo e(__('Support Ticket')); ?>

       <div class="float-end"><i class="ti ti-chevron-right"></i></div>
</a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/SupportTicket\Resources/views/settings/sidebar.blade.php ENDPATH**/ ?>