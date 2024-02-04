<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Quote')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
<a href="">
     <span class="btn-inner--icon text-white"><i class="fa fa-print"></i></span>
    <span class="btn-inner--text text-white"><?php echo e(__('Accept')); ?></span>
</a>
<a href="">
     <span class="btn-inner--icon text-white"><i class="fa fa-print"></i></span>
    <span class="btn-inner--text text-white"><?php echo e(__('Reject')); ?></span>
</a>
<a href="<?php echo e(route('quote.pdf',\Crypt::encrypt(1))); ?>" target="_blank" class="btn btn-sm btn-primary btn-icon ">
    <span class="btn-inner--icon text-white"><i class="fa fa-print"></i></span>
    <span class="btn-inner--text text-white"><?php echo e(__('Print')); ?></span>
</a>
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>
    input,textarea,select {
        border:none !important;
        resize:none !important;
        pointer-events:none !important;
        overflow: hidden !important;
    }

    select::-ms-expand {
        display: none;
    }

    #tblLocations tbody tr td {
        border:1px solid #ccc;
        padding-left:3px !important;
        padding-right:3px !important;
    }

    #tblLocations tbody tr td select {
        padding: 0px;
        font-size:12px;
        text-align:center;
    }

    #tblLocations tbody tr td textarea {
        resize:none;
    }

    #tblLocations tbody tr td,
    #tblLocations tbody tr td input,
    #tblLocations tbody tr td textarea {
        padding: 0px;
        font-size:12px;
        text-align:right;
        background:transparent;
    }

    #tblLocations tbody tr td input, 
    #tblLocations tbody tr td select {
        padding:4px;
        background:transparent;
    }

    td.number {
        text-align:right;
    }

    td p {
        padding-right:10px;    
    }

    .expired_item {
        border:2px solid red;
        color:red;
    }

    .textsubtotal, .markupchange {
        border:0px;
        outline:none;
    }

    .bold_input {
        font-weight:bold;
    }
    
    .border-right {
        border: 1px solid #e0e0e0;
        color: #767575;
        padding: 7px 15px;
        margin-right: -1px;
        background: #fff;
    }

    .border-right i {
        font-size: 18px;
        position: relative;
        top: 2px;
        margin-right: 5px;
    }

    .selectedTr {
        background:#eee !important;
    }

    .with_as a:hover {
        cursor:pointer;
        box-shadow: 0px 2px 3px #d1c9c9;
        position: relative;
        background: #fff;
    }

    .with_as a:first-child{
        border-radius: 8px 0px 0px 8px;
    }

    .with_as a:last-child {
        border-radius: 0px 8px 8px 0px;
    }

    .quoteviewtbl {
        width: 100%;
    }

    .quoteviewtbl tbody tr:nth-child(2n+2) {
        background:#ebebeb;
    }

    .quoteviewtbl tr td {
        padding:10px 2px;
    }

</style>
<center>
    <div class="col-md-10">
        <div class="row">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <div class="col-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Quote')); ?></h6>

                                            <span class="badge bg-primary p-2 px-3 rounded"> test  </span>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-8">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Quote ID')); ?></h6>
                                        <span class="col-sm-8"><span class="text-sm"> </span></span>
                                    </div>

                                    <div class="col-lg-6 text-end">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Assigned User :')); ?></h6>
                                        <span class="text-sm"> </span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-lg-6 col-md-8">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Quote Date')); ?></h6>
                                        <span class="col-sm-8"><span class="text-sm"> </span></span>
                                    </div>
                                    <div class="col-lg-6 text-end">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Created :')); ?></h6>
                                        <span class="text-sm"> </span>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-12 col-md-4">
                                        <h5><?php echo e(__('From')); ?></h5>
                                        <div class="row mt-4 align-items-center">
                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Company Address')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Company City')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Zip Code')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Company Country')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Company Contact')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <h5><?php echo e(__('Billing Address')); ?></h5>
                                        <div class="row mt-4 align-items-center">
                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing Address')); ?></div>
                                            <div class="col-sm-8 text-m">  </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing City')); ?></div>
                                            <div class="col-sm-8 text-m">  </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Zip Code')); ?></div>
                                            <div class="col-sm-8 text-m">  </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing Country')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing Contact')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <h5><?php echo e(__('Shipping Address')); ?></h5>
                                        <dl class="row mt-4 align-items-center">
                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping Address')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping City')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Zip Code')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping Country')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>

                                            <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping Contact')); ?></div>
                                            <div class="col-sm-8 text-m"> </div>
                                        </dl>
                                    </div>
                                
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="px-2 py-2" style="text-align:left;"><?php echo e(__('Item List')); ?></h5>
                                        <div class="table-responsive mt-2">
                                            <table class="mb-0 quoteviewtbl">
                                            
                                                <?php echo $quote; ?>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                    <td></td>
                                                    <td><strong><?php echo e(__('Sub Total')); ?></strong></td>
                                                    <td class="text- subTotal"></td>

                                                </tr>

                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                    <td></td>
                                                    <td><strong><?php echo e(__('Discount')); ?></strong></td>
                                                    <td class="text- subTotal"></td>

                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="4">&nbsp;</td>
                                                    <td></td>
                                                    <td><strong><?php echo e(__('Total')); ?></strong></td>
                                                    <td class="text- subTotal"></td>
                                                </tr>
                                                </tfoot>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card my-5 bg-secondary">
                                            <div class="card-body">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="col-md-6 order-md-2 mb-4 mb-md-0">
                                                        <div class="d-flex align-items-center justify-content-md-end">
                                                            <span class="h6 text-muted d-inline-block mr-3 mb-0"><?php echo e(__('Total value')); ?>:</span>
                                                            <span class="h4 mb-0"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 order-md-1">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>
<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/quote/quoteview.blade.php ENDPATH**/ ?>