<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category manage')): ?>
    <a href="#category-settings" class="list-group-item list-group-item-action dash-link "><?php echo e(__('Category')); ?> <div
            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/ProductService\Resources/views/category/sidenav.blade.php ENDPATH**/ ?>