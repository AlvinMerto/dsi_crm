<style>
    .qt_tbl {
        width: 100%;
        border-collapse:collapse;
    }

    .qt_tbl th {
        background:#ccc;
        border:1px solid;
        padding:4px 10px;
        font-size:14px;
        text-align:left;
    }

    .qt_tbl td {
        padding:4px 10px;
    }

    .number {
        text-align:right !important;
    }
</style>
<div style='font-family:arial; font-size:.8rem;'>
                                        <div id='quotation' style="margin-bottom:20px;">
                                            <h1 class="px-2 py-2" style="text-align:right; border-bottom:2px solid #ccc;">Quotation</h1>
                                                <table style="width:100%;">
                                                    <tr>
                                                        <td style='vertical-align:top;'>
                                                            <table>
                                                                <tr>
                                                                    <td style='text-align:right;'> 
                                                                        <!-- <img src='<?php //echo $logo; ?>'/> -->
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style='text-align:left;'>
                                                                        P.O. Box 6458 <br/>
                                                                        Tamuning, Guam 969391 <br/>
                                                                        Tel: (671) 646-2007 <br/>
                                                                        Fax: (671) 646-2006 <br/>
                                                                        email: Sales@DimensionSystems.com
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style='vertical-align:top;'>
                                                            <table style='float:right; border-collapse:collapse;'>
                                                                <tr>
                                                                    <th style='text-align:center; background:#ccc; border:1px solid; padding:4px 10px;'> Quote #: </th>
                                                                    <th style='text-align:center; background:#ccc; border:1px solid; padding:4px 10px;'> Date </th>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <td style='text-align:center; border:1px solid; padding:4px 10px;'> 
                                                                        <?php echo $qt_num; ?>
                                                                    </td>
                                                                    <td style='text-align:center; border:1px solid; padding:4px 10px;'> 
                                                                        <?php echo (isset($salesquote[0]->issue_date)?$salesquote[0]->issue_date:null); ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th style='text-align:center; background:#ccc; border:1px solid; padding:4px 10px;' colspan='2'> Sales Rep: </th>
                                                                </tr>
                                                                <tr>
                                                                    <td style='text-align:center; border:1px solid; padding:4px 10px;' colspan='2'>
                                                                        <p style='margin:0px;'> <?php echo (isset($salesquote[0]->cont_person->name)?$salesquote[0]->cont_person->name:null); ?> </p>
                                                                        <p style='margin:0px;'> <?php echo (isset($salesquote[0]->cont_person->email)?$salesquote[0]->cont_person->email:null); ?> </p>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr> <td colspan='2' style='padding:5px;'> &nbsp; </td> </tr>
                                                    <tr>
                                                        <td style='vertical-align:top;'>
                                                            <table style='width:100%; border-collapse:collapse;'>
                                                                <tr>
                                                                    <th style='text-align:left;background:#ccc; border:1px solid; padding:4px 10px;'> For: </th>
                                                                    <th style='text-align:left;border:1px solid; padding:4px 10px;'> Customer #: <?php echo (isset($salesquote[0]->customer->id)?$salesquote[0]->customer->id:null); ?> </th>
                                                                </tr>
                                                                <tr>
                                                                    <td style='text-align:left;border:1px solid; padding:4px 10px;' colspan='2'>
                                                                        &nbsp; <?php echo (isset($salesquote[0]->customer->name)?$salesquote[0]->customer->name:null); ?> <br/>
                                                                        &nbsp; <?php echo (isset($salesquote[0]->contactperson->name)?$salesquote[0]->contactperson->name:null); ?> <br/>
                                                                        &nbsp; <?php echo (isset($salesquote[0]->contactperson->phone)?$salesquote[0]->contactperson->phone:null); ?> <br/>
                                                                        &nbsp; <?php echo (isset($salesquote[0]->contactperson->email)?$salesquote[0]->contactperson->email:null); ?> <br/>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style='vertical-align:top;'>
                                                            <table style='width:100%; border-collapse:collapse;'>
                                                                <tr>
                                                                    <th style='text-align:left;background:#ccc; border:1px solid; padding:4px 10px;' colspan='4'> Phone </th>
                                                                </tr>
                                                                <tr>
                                                                    <td style='text-align:left;border:1px solid; padding:4px 10px;' colspan='4'>
                                                                        <?php echo (isset($salesquote[0]->customer->phone)?$salesquote[0]->customer->phone:null); ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style='background:#ccc; border:1px solid; padding:4px 10px;'> PO # </td>
                                                                    <td style='background:#ccc; border:1px solid; padding:4px 10px;'> Terms </td>
                                                                    <td style='background:#ccc; border:1px solid; padding:4px 10px;'> Ship Date </td>
                                                                    <td style='background:#ccc; border:1px solid; padding:4px 10px;'> Ship Via </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style='border:1px solid; padding:4px 10px;'> &nbsp; </td>
                                                                    <td style='border:1px solid; padding:4px 10px;'> &nbsp; </td>
                                                                    <td style='border:1px solid; padding:4px 10px;'> &nbsp; </td>
                                                                    <td style='border:1px solid; padding:4px 10px;'> &nbsp; </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                        </div>
<?php
    echo "<table class='qt_tbl'>".$quote."</table>";
?>

<div style='border-top:5px double;'>
    <?php if (isset($show['tax'])) { ?>
        <p style="text-align: right;padding: 0px 0px; margin:10px;"> <strong> Subtotal </strong> &nbsp; &nbsp; &nbsp; <span> &nbsp; <?php echo $total['subtotal']; ?> </span> </p>
        <p style="text-align: right;padding: 0px 0px; margin:10px;"> Tax &nbsp; &nbsp; &nbsp; <span> <?php echo $total['tax']; ?> </span> </p>
    <?php } else { ?>
        <p style="text-align: right;padding: 0px 0px; margin:10px;"> <strong> Subtotal </strong> &nbsp; &nbsp; &nbsp; <span> &nbsp; <?php echo $total['totalamount']; ?> </span> </p>
    <?php } ?>
        <p style="text-align: right;padding: 0px 0px; margin:10px;">  <strong> Total </strong> &nbsp; &nbsp; &nbsp; <span> &nbsp; <?php echo $total['totalamount']; ?> </span> </p>
</div>
</div>