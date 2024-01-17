<div class=" bg-none card-box">
    <?php echo e(Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT'])); ?>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

                    <?php if(in_array($role->name, \App\Models\User::$not_edit_role)): ?>
                        <?php echo e(Form::text('role_name', $role->name, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Role Name')])); ?>

                        <?php echo e(Form::hidden('name', $role->name, ['class' => 'form-control'])); ?>

                    <?php else: ?>
                        <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required','placeholder' => __('Enter Role Name')])); ?>

                    <?php endif; ?>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-name" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row justify-content-center">
                <!-- [ sample-page ] start -->
                <?php if(!empty($permissions)): ?>
                    <div class="col-sm-12 col-md-10 col-xxl-12 col-md-12">
                        <div class="p-3 card">
                            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(module_is_active($module) || $module == 'General'): ?>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link text-capitalize <?php echo e($loop->index == 0 ? 'active' : ''); ?>"
                                                id="pills-<?php echo e(strtolower($module)); ?>-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-<?php echo e(strtolower($module)); ?>"
                                                type="button"><?php echo e(Module_Alias_Name($module)); ?></button>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                            <div class="card-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(module_is_active($module) || $module == 'General'): ?>
                                            <div class="tab-pane text-capitalize fade show <?php echo e($loop->index == 0 ? 'active' : ''); ?>"
                                                id="pills-<?php echo e(strtolower($module)); ?>" role="tabpanel"
                                                aria-labelledby="pills-<?php echo e(strtolower($module)); ?>-tab">
                                                <input type="checkbox" class="form-check-input pointer"
                                                    name="checkall-<?php echo e(strtolower($module)); ?>"
                                                    id="checkall-<?php echo e(strtolower($module)); ?>"
                                                    onclick="Checkall('<?php echo e(strtolower($module)); ?>')">
                                                <small class="text-muted mx-2">
                                                    <?php echo e(Form::label('checkall-' . strtolower($module), 'Assign ' .  Module_Alias_Name($module)  . ' Permission to Roles', ['class' => 'form-check-label pointer'])); ?>

                                                </small>
                                                <table class="table table-striped mb-0  mt-3" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th><?php echo e(__('Module')); ?> </th>
                                                        <th><?php echo e(__('Permissions')); ?> </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $permissions = get_permission_by_module($module);
                                                            $m_permissions = array_column($permissions->toArray(),'name');
                                                            $module_list = [];
                                                                foreach ($m_permissions as $key => $value) {
                                                                    array_push($module_list,strtok($value, " "));
                                                                }
                                                            $module_list =  array_unique($module_list)
                                                        ?>
                                                     <?php $__currentLoopData = $module_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck pointer" onclick="CheckModule('module_checkbox_<?php echo e($key); ?>_<?php echo e($list); ?>')"  id="module_checkbox_<?php echo e($key); ?>_<?php echo e($list); ?>"></td>
                                                            <td><?php echo e(Form::label('module_checkbox_'.$key.'_'.$list, $list, ['class' => 'form-check-label pointer'])); ?></td>
                                                            <td class="module_checkbox_<?php echo e($key); ?>_<?php echo e($list); ?>">
                                                                <div class="row">
                                                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                            $check = strtok($prermission->name, " ");
                                                                            $name =str_replace($check,"",$prermission->name);
                                                                        ?>
                                                                        <?php if($list == $check): ?>
                                                                            <div class="col-lg-3 col-md-6 form-check mb-2">
                                                                                <?php echo e(Form::checkbox('permissions[]', $prermission->id, $role->permission, ['class' => 'form-check-input checkbox-' . strtolower($module), 'id' => 'permission_' . $key . '_' . $prermission->id])); ?>

                                                                                <?php echo e(Form::label('permission_' . $key . '_' . $prermission->id, $name, ['class' => 'form-check-label'])); ?>

                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/resources/views/role/edit.blade.php ENDPATH**/ ?>