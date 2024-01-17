<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact import')): ?>
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Contact Import')); ?>"
                data-url="<?php echo e(route('contact.file.import')); ?>" data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i
                    class="ti ti-file-import"></i>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('contact.grid')); ?>" class="btn btn-sm btn-primary"
            data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact create')): ?>
            <a data-url="<?php echo e(route('contact.create', ['contact', 0])); ?>" data-size="lg" data-ajax-popup="true"
                data-bs-toggle="tooltip"data-title="<?php echo e(__('Create New Contact')); ?>"title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Email')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Phone')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('City')); ?></th>
                                    <th scope="col" class="sort" data-sort="account"><?php echo e(__('Account')); ?></th>
                                    </th>
                                    <?php if(Gate::check('contact show') || Gate::check('contact edit') || Gate::check('contact delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('contact.edit', $contact->id)); ?>" data-size="md"
                                                data-title="<?php echo e(__('Contact Details')); ?>" class="action-item text-primary">
                                                <?php echo e(ucfirst($contact->name)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <span class="budget">
                                                <?php echo e($contact->email); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="budget">
                                                <?php echo e($contact->phone); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="budget "><?php echo e(ucfirst($contact->contact_city)); ?></span>
                                        </td>
                                        <td><?php echo e($contact->assign_account->name); ?></td>
                                        <?php if(Gate::check('contact show') || Gate::check('contact edit') || Gate::check('contact delete')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a data-size="md" data-url="<?php echo e(route('contact.show', $contact->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                            data-ajax-popup="true" data-title="<?php echo e(__('Contact Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('contact.edit', $contact->id)); ?>"data-size="md"
                                                            class="btn btn-sm d-inline-flex align-items-center text-white "
                                                            data-bs-toggle="tooltip"data-title="<?php echo e(__('Contact Edit View')); ?>"
                                                            title="<?php echo e(__('Contact Edit View')); ?>"><i class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['contact.destroy', $contact->id]]); ?>

                                                        <a href="#!"
                                                            class="btn btn-sm   align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).on('change', '.select_account', function() {
            var id= $(this).val();
            selectaccount(id);
        });

        // $(document).ready(function () {
        //     var id = $('.select_account').val();
        //     selectaccount(id);
        // });

        function selectaccount(id)
        {
            $.ajax({
                url: '<?php echo e(route('contact.account.detail')); ?>',
                type: 'POST',
                data: {
                    "account_id": id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    if(data.is_success=="success")
                    {
                        $('.contact_address').val(data.address);
                        $('.contact_city').val(data.city);
                        $('.contact_state').val(data.state);
                        $('.contact_postalcode').val(data.postalcode);
                        $('.contact_country').val(data.country);
                    }
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/contact/index.blade.php ENDPATH**/ ?>