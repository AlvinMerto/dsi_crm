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
<title> Quotation </title>
<style>
    * {
        font-family:"calibri";
    }

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

    .quoteviewtbl thead tr {
        border-bottom:2px solid #333;
    }

    .quoteviewtbl tbody tr:nth-child(2n+2) {
       
    }

    .quoteviewtbl tbody tr {
        
    }

    .quoteviewtbl tr td {
        
    }

    .quoteviewtbl tr td span {
        padding: 0px !important;
        color: #000 !important;
        font-style: normal !important;
    }

    .float_nav{
        position: fixed;
  width: 20%;
  background: #e7e4e4;
  border-radius: 5px;
    }

    .float_nav p {
        width:90%;
    }

    .float_nav ul {
        padding:0px;
        margin:0px;
    }

    .float_nav ul li {
        padding:0px;
        text-align:left;
        list-style:none;
        padding:8px 20px;
    }
    
    .float_nav ul li:hover {
        background:#ccc;
    }

    .float_nav ul li a {
        text-decoration:none;
        color:#333;
    }

    .desc_div {
        text-align:left;
    }

    .theinfo_box table {
        width: 100%;
    }

    .theinfo_box table th {
        vertical-align: top;
        text-align:right;
        padding-right:15px;
    }

    .theinfo_box table th p, 
    .theinfo_box table td p {
        margin:0px;
    }
</style>
<center>
    <div class="col-md-10">
        <div class="row">
            <div class="container">
                <div class="card_">
                    <div class="_card-body">
                        <!-- <dl class="row">
                            <div class="col-12"> -->
                                <div class="row">
                                    <div class='col-md-3' style='position:relative;'>
                                        <div class='float_nav mt-3'>
                                            <ul>
                                                <li> <a href='#quotation'> Your Quotation </a> </li>
                                                <li> <a href='#aboutus'> About Us </a> </li>
                                                <li> <a href='#pricing'> Pricing </a> </li>
                                                <li> <a href='#howtoorder'> How to Order </a> </li>
                                                <li> <a href='#contact'> Contact Us </a> </li>
                                            </ul>
                                            <hr/>
                                            <?php echo $qt_validity; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div id='quotation'>
                                            <h3 class="px-2 py-2" style="text-align:left;">Your Quotation</h3> 
                                                <!-- <div class="desc_div px-2 py-2">
                                                         
                                                </div> -->
                                                <div class="row px-2 py-2 theinfo_box">
                                                    <div class="col-md-6">
                                                        <table>
                                                            <tr>
                                                                <th> Customer: </th>
                                                                <td class='px-2'> <?php echo $salesquote[0]->customer->name; ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th class='py-3'> Bill To:</th>
                                                                <td class='px-2 py-3'> 
                                                                    <p> <?php echo $salesquote[0]->customer->name; ?> </p>
                                                                    <p> <i class="ti ti-map-pins"></i> &nbsp; <?php echo $salesquote[0]->customer->shipping_address; ?> </p>
                                                                    <p> <i class="ti ti-user"></i> &nbsp; <?php echo $salesquote[0]->contactperson->name; ?> </p>
                                                                    <p> <i class="ti ti-phone"></i> &nbsp; <?php echo $salesquote[0]->contactperson->phone; ?> </p>
                                                                    <p> <i class="ti ti-mail"></i> &nbsp; <?php echo $salesquote[0]->contactperson->email; ?> </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table>
                                                            <tr>
                                                                <th> Your Contact: </th>
                                                                <td> 
                                                                    <p> <?php echo $salesquote[0]->cont_person->name; ?> </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th> Quote Date: </th>
                                                                <td> <?php echo date("M. d, Y", strtotime($salesquote[0]->issue_date)); ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th> Expiration Date: </th>
                                                                <td> <?php echo date("l - M. d, Y", strtotime($salesquote[0]->quote_validity)); ?> </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                        </div>
                                        <div id='aboutus'>
                                            <h3 class="px-2 py-2" style="text-align:left;">About Us</h3> 
                                                <div class="desc_div px-2 py-2">
                                                    <p> Lorem ipsum dolor set amit </p>        
                                                </div>
                                        </div>
                                        <div id='pricing'>
                                            <h3 class="px-2 py-2" style="text-align:left;"><?php echo e(__('Pricing')); ?></h3>
                                            <table class="quoteviewtbl">
                                                <?php echo $quote; ?>
                                            </table>
                                            <div>
                                                <?php if (isset($show['tax'])) { ?>
                                                    <p style="text-align: right;padding: 0px 0px; margin:10px;"> <strong> Subtotal </strong> &nbsp; &nbsp; &nbsp; <span> <?php echo e(company_setting('defult_currancy_symbol')); ?><?php echo $total['subtotal']; ?> </span> </p>
                                                    <p style="text-align: right;padding: 0px 0px; margin:10px;"> Tax &nbsp; &nbsp; &nbsp; <span> <?php echo $total['tax']; ?> </span> </p>
                                                <?php } else { ?>
                                                    <p style="text-align: right;padding: 0px 0px; margin:10px;"> <strong> Subtotal </strong> &nbsp; &nbsp; &nbsp; <span> <?php echo e(company_setting('defult_currancy_symbol')); ?><?php echo $total['totalamount']; ?> </span> </p>
                                                <?php } ?>
                                                <p style="text-align: right;padding: 0px 0px; margin:10px;">  <strong> Total </strong> &nbsp; &nbsp; &nbsp; <span> <?php echo e(company_setting('defult_currancy_symbol')); ?><?php echo $total['totalamount']; ?> </span> </p>
                                            </div>
                                        </div>
                                        <?php if ($qt_valid) { ?>
                                            <div class="card my-5">
                                                <div class="card-body">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6 order-md-2 mb-4 mb-md-0">
                                                            <div class="d-flex align-items-center justify-content-md-end">
                                                                <a href="<?php echo e(route('salesquote.respond',[$quote_id])); ?>" class='btn btn-primary'> Accept </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 order-md-1">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div id='howtoorder'>
                                            <h3 class="px-2 py-2" style="text-align:left;">How to Order</h3> 
                                                <div class="desc_div px-2 py-2">
                                                    <p> Lorem ipsum dolor set amit </p>        
                                                </div>
                                        </div>
                                        <div id='contact'>
                                            <h3 class="px-2 py-2" style="text-align:left;">Contact Us</h3> 
                                                <div class="desc_div px-2 py-2">
                                                    <p> Lorem ipsum dolor set amit </p>        
                                                </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- </div>
                        </dl> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

<style>
    .quoteviewtbl th, .quoteviewtbl tr td{
        padding:3px 10px;
    }
</style><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/quote/quoteview.blade.php ENDPATH**/ ?>