<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Hrm')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('Modules/Hrm/Resources/assets/css/main.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="row">
    <?php if(!in_array(Auth::user()->type, Auth::user()->not_emp_type)): ?>
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xxl-7">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(__("Holiday's ")); ?></h5>
                    </div>
                    <div class="card-body">
                        <div id='calendar' class='calendar'></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-5">
                <div class="card" style="height: 232px;">
                    <div class="card-header">
                        <h5><?php echo e(__('Mark Attandance ')); ?><span><?php echo e(company_date_formate(date('Y-m-d'))); ?></span></h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted pb-0-5">
                            <?php echo e(__('My Office Time: ' . $officeTime['startTime'] . ' to ' . $officeTime['endTime'])); ?></p>
                            <div class="row">
                                <div class="col-md-6 float-right border-right">
                                    <?php echo e(Form::open(['url' => 'attendance/attendance', 'method' => 'post'])); ?>


                                    <?php if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00'): ?>
                                        <button type="submit" value="0" name="in" id="clock_in"
                                            class="btn btn-primary"><?php echo e(__('CLOCK IN')); ?></button>
                                    <?php else: ?>
                                        <button type="submit" value="0" name="in" id="clock_in"
                                            class="btn btn-primary disabled"
                                            disabled><?php echo e(__('CLOCK IN')); ?></button>
                                    <?php endif; ?>
                                    <?php echo e(Form::close()); ?>

                                </div>
                                <div class="col-md-6 float-left">
                                    <?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00'): ?>
                                        <?php echo e(Form::model($employeeAttendance, ['route' => ['attendance.update', $employeeAttendance->id], 'method' => 'PUT'])); ?>

                                        <button type="submit" value="1" name="out" id="clock_out"
                                            class="btn btn-danger"><?php echo e(__('CLOCK OUT')); ?></button>
                                    <?php else: ?>
                                        <button type="submit" value="1" name="out" id="clock_out"
                                            class="btn btn-danger disabled"
                                            disabled><?php echo e(__('CLOCK OUT')); ?></button>
                                    <?php endif; ?>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-body table-border-style">
                        <h5><?php echo e(__('Announcement List')); ?></h5>
                    </div>
                    <div class="card-body" style="height: 270px; overflow:auto">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Start Date')); ?></th>
                                        <th><?php echo e(__('End Date')); ?></th>
                                        <th><?php echo e(__('Description')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($announcement->title); ?></td>
                                            <td><?php echo e(company_date_formate($announcement->start_date)); ?></td>
                                            <td><?php echo e(company_date_formate($announcement->end_date)); ?></td>
                                            <td><?php echo e($announcement->description); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="col-xxl-12">
        <div class="col-xxl-12">
            <div class="row">
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header card-body table-border-style">
                        <h5><?php echo e(__("Today's Not Clock In")); ?></h5>
                    </div>
                    <div class="card-body" style="height: 290px; overflow:auto">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Name')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $__currentLoopData = $notClockIns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notClockIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($notClockIn->name); ?></td>
                                            <td><span class="absent-btn"><?php echo e(__('Absent')); ?></span></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-header card-body table-border-style">
                            <h5><?php echo e(__('Announcement List')); ?></h5>
                        </div>
                        <div class="card-body" style="height: 270px; overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Start Date')); ?></th>
                                            <th><?php echo e(__('End Date')); ?></th>
                                            <th><?php echo e(__('Description')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($announcement->title); ?></td>
                                                <td><?php echo e(company_date_formate($announcement->start_date)); ?></td>
                                                <td><?php echo e(company_date_formate($announcement->end_date)); ?></td>
                                                <td><?php echo e($announcement->description); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(__("Holiday's & Event's")); ?></h5>
                    </div>
                    <div class="card-body card-635 "  >
                        <div id='calendar' class='calendar'></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('Modules/Hrm/Resources/assets/js/main.min.js')); ?>"></script>
    <script type="text/javascript">
        (function() {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    timeGridDay: "<?php echo e(__('Day')); ?>",
                    timeGridWeek: "<?php echo e(__('Week')); ?>",
                    dayGridMonth: "<?php echo e(__('Month')); ?>"
                },
                themeSystem: 'bootstrap',
                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: <?php echo json_encode($events); ?>,
            });
            calendar.render();
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Hrm\Resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>