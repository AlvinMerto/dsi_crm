<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('supportticket setting')): ?>
    <div class="card" id="supportticket_sidenav">
        <?php echo e(Form::open(['route' => 'support-ticket.store', 'enctype' => 'multipart/form-data'])); ?>

        <div class="custom-fields" data-value="<?php echo e(json_encode($fields)); ?>">
            <div class="card-header row d-flex align-items-center justify-content-between">
                <div class="col-lg-5 col-md-6 col-sm-6 form-group  mb-1">
                    <h5 class=""><?php echo e(__('Ticket Fields Settings')); ?></h5>
                    <label class="form-check-label pe-5 text-muted"
                        for="enable_chat"><?php echo e(__('You can easily change order of fields using drag & drop.')); ?></label>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 text-end form-group  mb-1">
                    <label><?php echo e(__('FAQ')); ?></label>
                    <div class="form-check form-switch custom-switch-v1 float-end ms-2">
                        <input type="checkbox" name="faq_is_on" class="form-check-input input-primary" id="faq_is_on" <?php echo e(company_setting('faq_is_on')=='on'?' checked ':''); ?>>
                        <label class="form-check-label" for="faq_is_on"></label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-6 text-end form-group mb-1">
                        <label><?php echo e(__('Knowledge Base')); ?></label>
                    <div class="form-check form-switch custom-switch-v1 float-end ms-2">
                        <input type="checkbox" name="knowledge_base_is_on" class="form-check-input input-primary" id="knowledge_base_is_on" <?php echo e(company_setting('knowledge_base_is_on')=='on'?' checked ':''); ?>>
                        <label class="form-check-label" for="knowledge_base_is_on"></label>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 text-end mb-1">
                    <button data-repeater-create type="button" class="btn btn-sm btn-primary btn-icon m-1 float-end ms-2"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Custom Field')); ?>">
                        <i class="ti ti-plus mr-1"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive m-0 custom-field-table">

                    <table class="table dataTable-table" id="pc-dt-simple" data-repeater-list="fields">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th><?php echo e(__('Labels')); ?></th>
                                <th><?php echo e(__('Placeholder')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Require')); ?></th>
                                <th><?php echo e(__('Width')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-repeater-item>
                                <td><i class="ti ti-arrows-maximize sort-handler"></i></td>
                                <td>
                                    <input type="hidden" name="id" id="id" />
                                    <input type="hidden" class="custom_id" name="custom_id" id="custom_id" />

                                    <input type="text" name="name" class="form-control mb-0"
                                        required />
                                </td>
                                <td>
                                    <input type="text" name="placeholder" class="form-control mb-0"
                                        required />
                                </td>
                                <td>
                                    <select class="form-control select-field field_type mr-2"
                                        name="type">
                                        <?php $__currentLoopData = \Modules\SupportTicket\Entities\TicketField::$fieldTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control select-field field_type" name="status">
                                        <option value="1"><?php echo e(__('Yes')); ?></option>
                                        <option value="0"><?php echo e(__('No')); ?></option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control select-field" name="width">
                                        <option value="3">25%</option>
                                        <option value="4">33%</option>
                                        <option value="6">50%</option>
                                        <option value="8">66%</option>
                                        <option value="12">100%</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <a data-repeater-delete class="delete-icon"><i
                                            class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-print-invoice  btn-primary m-r-35"
                            type="submit"><?php echo e(__('Save Changes')); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="<?php echo e(Module::asset('SupportTicket:Resources/assets/js/editorplaceholder.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('SupportTicket:Resources/assets/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('SupportTicket:Resources/assets/js/repeater.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            var $dragAndDrop = $("body .custom-fields tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeater = $('.custom-fields').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function() {
                    $(this).slideDown();
                    var eleId = $(this).find('input[type=hidden]').val();


                    if (eleId > 6 || eleId == '') {
                        $(this).find(".field_type option[value='file']").remove();
                        $(this).find(".field_type option[value='select']").remove();
                    }
                },
                hide: function(deleteElement) {
                    if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function(setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });

            var value = $(".custom-fields").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

            $.each($('[data-repeater-item]'), function(index, val) {
                var elementId = $(this).find('.custom_id').val();
                if (elementId <= 6) {
                    $.each($(this).find('.field_type'), function(index, val) {
                        $(this).prop('disabled', 'disabled');
                    });
                    $(this).find('.delete-icon').remove();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/SupportTicket\Resources/views/settings/nav_containt_div.blade.php ENDPATH**/ ?>