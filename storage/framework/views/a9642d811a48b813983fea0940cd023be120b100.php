
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Sales Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Sales Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesquote create')): ?>
            <a href="<?php echo e(route('salesquote.create')); ?>" data-bs-toggle="tooltip"
               data-title="<?php echo e(__('Create New Sales Quote')); ?>" title="<?php echo e(__('Create')); ?>"class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Sales Quote')); ?></th>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Customer')); ?></th>
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Status')); ?></th>
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Issue Date')); ?></th>
                                <!-- <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Amount')); ?></th> -->
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Created At')); ?></th>
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Contact person')); ?></th>
                                <?php if(\Auth::user()->type =="company"): ?>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Quote Status')); ?></th>
                                <?php endif; ?>
                                <?php if(Gate::check('salesquote edit') || Gate::check('salesquote delete')): ?>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $salesquotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesquote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a class="btn btn-outline-primary" href="<?php echo e(route('salesquote.showquote',$salesquote->id)); ?>"> <?php echo e(\Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquote->quote_id)); ?> </a>
                                        <!-- <a href="<?php echo e(route('salesquote.show',encrypt($salesquote->id))); ?>" class="btn btn-outline-primary"></a> -->
                                    </td>
                                    <td><?php echo e($salesquote->customer->name); ?></td>
                                    <td><?php if(date('Y-m-d') > $salesquote->quote_validity): ?>
                                            <span class="badge fix_badges bg-danger p-2 px-3 rounded">Expired</span>
                                        <?php else: ?>
                                            <span class="badge fix_badges bg-primary p-2 px-3 rounded">Active</span>
                                        <?php endif; ?></td>
                                    <td> <?php echo date("M. d, Y", strtotime($salesquote->issue_date)); ?> </td>
                                    <!-- <td></td> <?php echo e(company_date_formate($salesquote->created_at)); ?> <?php echo e(company_date_formate($salesquote->issue_date)); ?>-->
                                    <td> <?php echo date("M. d, Y", strtotime($salesquote->created_at)); ?> </td>
                                    <td><?php echo e($salesquote->contactperson->name); ?></td>
                                    <?php
                                        if(isset($salesquote->quote_status))
                                        {
                                            if($salesquote->quote_status==0)
                                            {
                                               $quotestatus="Pending";
                                            }
                                            elseif($salesquote->quote_status==1)
                                            {
                                                $quotestatus="Accept";
                                            }
                                            else
                                            {
                                                $quotestatus="Reject";
                                            }
                                        }
                                    ?>

                                    <?php if(\Auth::user()->type =="company"): ?>
                                        <td>
                                            <?php if(isset($salesquote->quote_status)): ?>
                                                <?php if($quotestatus=="Pending"): ?>
                                                    <span class="badge fix_badges bg-warning p-2 px-3 rounded"><?php echo e($quotestatus); ?></span>
                                                <?php elseif($quotestatus=="Accept"): ?>
                                                    <span class="badge fix_badges bg-primary p-2 px-3 rounded"><?php echo e($quotestatus); ?></span>
                                                <?php elseif($quotestatus=="Reject"): ?>
                                                    <span class="badge fix_badges bg-danger p-2 px-3 rounded"><?php echo e($quotestatus); ?></span>
                                                <?php else: ?>
                                                    <span class="badge fix_badges bg-warning p-2 px-3 rounded">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge fix_badges bg-danger p-2 px-3 rounded">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if(Gate::check('salesquote edit') || Gate::check('salesquote delete') || Gate::check('salesquote create')): ?>

                                        <td class="Action">
                                            <div class="action-btn bg-primary ms-2">
                                                <a style='cursor:pointer;' class="btn btn-sm  align-items-center "
                                                    data-ajax-popup="true" data-size="md" 
                                                    data-title="<?php echo e(__('Copy to new customer')); ?>" 
                                                    data-qtid = "<?php echo $salesquote->id; ?>"
                                                    data-url="<?php echo e(route('quotecontroller.copytonewcustomer',$salesquote->id)); ?>" 
                                                    data-toggle="tooltip" title="<?php echo e(__('Copy to new customer')); ?>">
                                                    <i class="ti ti-file text-white"></i>
                                                </a>
                                            </div>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesquote create')): ?>
                                                <div class="action-btn bg-secondary ms-2">
                                                    <?php echo Form::open([
                                                        'method' => 'get',
                                                        'route' => ['salesquote.duplicate', $salesquote->id],
                                                        'id' => 'duplicate-form-' . $salesquote->id,
                                                    ]); ?>


                                                    <a href="#"
                                                       class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                       data-bs-toggle="tooltip" data-title="<?php echo e(__('Duplicate')); ?>"
                                                       title="<?php echo e(__('Duplicate')); ?>"
                                                       data-confirm="<?php echo e(__('You want to confirm this action')); ?>"
                                                       data-text="<?php echo e(__('Press Yes to continue or No to go back')); ?>"
                                                       data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($salesquote->id); ?>').submit();">
                                                        <i class="ti ti-copy"></i>
                                                        <?php echo Form::close(); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if($salesquote->converted_salesorder_id == 0): ?>
                                                <div class="action-btn bg-success ms-2">
                                                    <?php echo Form::open([
                                                        'method' => 'get',
                                                        'route' => ['salesquote.convert', $salesquote->id],
                                                        'id' => 'quotes-form-' . $salesquote->id,
                                                    ]); ?>


                                                    <a href="#"
                                                       class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                       data-bs-toggle="tooltip"
                                                       data-title="<?php echo e(__('Convert to Sales Order')); ?>"
                                                       title="<?php echo e(__('Conver to Sale Order')); ?>"
                                                       data-confirm="<?php echo e(__('You want to confirm convert to sales order.')); ?>"
                                                       data-text="<?php echo e(__('Press Yes to continue or No to go back')); ?>"
                                                       data-confirm-yes="document.getElementById('quotes-form-<?php echo e($salesquote->id); ?>').submit();">
                                                        <i class="ti ti-exchange"></i>
                                                        <?php echo Form::close(); ?>

                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="action-btn bg-success ms-2">
                                                    <a href="<?php echo e(route('salesorder.show', $salesquote->converted_salesorder_id)); ?>"
                                                       class="mx-3 btn btn-sm align-items-center text-white"
                                                       data-bs-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Sales Order Details')); ?>"
                                                       title="<?php echo e(__('SalesOrders Details')); ?>">
                                                        <i class="fab fa-stack-exchange"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <!-- <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(route('salesquote.show',encrypt($salesquote->id))); ?>"
                                                   data-size="md"class="mx-3 btn btn-sm align-items-center text-white "
                                                   data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                   data-title="<?php echo e(__('SalesQuote Details')); ?>">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </div> -->
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesquote edit')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="<?php echo e(route('salesquote.showquote',$salesquote->id)); ?>"
                                                       class="mx-3 btn btn-sm  align-items-center"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesquote delete')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['salesquote.destroy', $salesquote->id]]); ?>

                                                    <a href="#!"
                                                       class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
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
            <script>
                $(document).on('click', '#billing_data', function() {
                    $("[name='shipping_address']").val($("[name='billing_address']").val());
                    $("[name='shipping_city']").val($("[name='billing_city']").val());
                    $("[name='shipping_state']").val($("[name='billing_state']").val());
                    $("[name='shipping_country']").val($("[name='billing_country']").val());
                    $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
                })

                $(document).on('change', 'select[name=opportunity]', function() {

                    var opportunities = $(this).val();
                    getaccount(opportunities);
                });

                function getaccount(opportunities_id) {
                    $.ajax({
                        url: '<?php echo e(route('quote.getaccount')); ?>',
                        type: 'POST',
                        data: {
                            "opportunities_id": opportunities_id,
                            "_token": "<?php echo e(csrf_token()); ?>",
                        },
                        success: function(data) {
                            $('#amount').val(data.opportunitie.amount);
                            $('#account_name').val(data.account.name);
                            $('#account_id').val(data.account.id);
                            $('#billing_address').val(data.account.billing_address);
                            $('#shipping_address').val(data.account.shipping_address);
                            $('#billing_city').val(data.account.billing_city);
                            $('#billing_state').val(data.account.billing_state);
                            $('#shipping_city').val(data.account.shipping_city);
                            $('#shipping_state').val(data.account.shipping_state);
                            $('#billing_country').val(data.account.billing_country);
                            $('#billing_postalcode').val(data.account.billing_postalcode);
                            $('#shipping_country').val(data.account.shipping_country);
                            $('#shipping_postalcode').val(data.account.shipping_postalcode);

                        }
                    });
                }
            </script>
                <script>
                    $(document).on("click",".cp_link",function() {
                        var value = $(this).attr('data-link');
                        var $temp = $("<input>");
                        $("body").append($temp);
                        $temp.val(value).select();
                        document.execCommand("copy");
                        $temp.remove();
                        toastrs('success', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success')
                    });
                </script>
    <?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/salesquote/index.blade.php ENDPATH**/ ?>