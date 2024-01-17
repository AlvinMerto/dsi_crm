<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bug Stages')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-action'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="bug-stages-settings" class="row">
    <div class="col-md-3">
        <?php echo $__env->make('taskly::layouts.system_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="col-md-9">
        <div class="card bug-stages" data-value="<?php echo e(json_encode($bugStages)); ?>">
            <div class="card-header">
                <div class="row">
                    <div class="col-11">
                        <h5 class="">
                            <?php echo e(__('Bug Stages')); ?>


                        </h5>
                        <small
                            class=""><?php echo e(__('System will consider the last stage as a completed / done project or bug status.')); ?></small>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bugstage manage')): ?>
                        <div class=" col-1 text-end">
                            <button data-repeater-create type="button" class="btn-submit btn btn-sm btn-primary "
                                data-toggle="tooltip" title="<?php echo e(__('Add')); ?>">
                                <i class="ti ti-plus"></i>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo e(route('bugstages.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <table class="table table-hover" data-repeater-list="stages">
                        <thead>
                            <th>
                                <div data-toggle="tooltip" data-placement="left"
                                    data-title="<?php echo e(__('Drag Stage to Change Order')); ?>" data-original-title=""
                                    title="">
                                    <i class="fas fa-crosshairs"></i>
                                </div>
                            </th>
                            <th><?php echo e(__('Color')); ?></th>
                            <th><?php echo e(__('Name')); ?></th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bugstage delete')): ?>
                                <th class="text-right"><?php echo e(__('Delete')); ?></th>
                            <?php endif; ?>
                        </thead>
                        <tbody>
                            <tr data-repeater-item>
                                <td><i class="fas fa-crosshairs sort-handler"></i></td>
                                <td>
                                    <input type="color" name="color">
                                </td>
                                <td>
                                    <input type="hidden" name="id" id="id" />
                                    <input type="text" name="name" class="form-control mb-0"
                                        <?php if(!auth()->user()->can('bugstage edit')): ?> readonly <?php endif; ?> required />
                                </td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bugstage delete')): ?>
                                    <td class="text-right">
                                        <a data-repeater-delete
                                            class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center"
                                            data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                class="ti ti-trash text-white"></i></a>
                                    </td>
                                <?php endif; ?>

                            </tr>
                        </tbody>
                    </table>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bugstage manage')): ?>
                    <div class="row">
                        <div class="text-sm col-6 pt-2">
                            <?php echo e(__('Note : You can easily change order of Bug stage using drag & drop.')); ?>

                        </div>
                        <div class="text-end col-6 pt-2">
                            <button class="btn-submit btn btn-primary" type="submit"><?php echo e(__('Save Changes')); ?></button>
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(Module::asset('Taskly:Resources/assets/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('Taskly:Resources/assets/js/repeater.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('Taskly:Resources/assets/js/colorPick.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pages/wow.min.js')); ?>"></script>
    <script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>


    <script>
        $(document).ready(function () {
            var $dragAndDropBug = $("body .bug-stages tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeaterBug = $('.bug-stages').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDropBug.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });


            var valuebug = $(".bug-stages").attr('data-value');
            if (typeof valuebug != 'undefined' && valuebug.length != 0){
                valuebug = JSON.parse(valuebug);
                $repeaterBug.setList(valuebug);
            }
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Taskly\Resources/views/stages/bug_stage.blade.php ENDPATH**/ ?>