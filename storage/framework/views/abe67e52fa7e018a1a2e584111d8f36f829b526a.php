<div style='font-family:arial; font-size:.8rem;'>
                                        <div id='quotation' style="margin-bottom:20px;">
                                            <h1 class="px-2 py-2" style="text-align:right; border-bottom:2px solid #ccc;">Proposal</h1>
                                                <table style="width:100%;">
                                                    <td style='vertical-align:top;'>
                                                        <table>
                                                            <tr>
                                                                <th style='text-align:right;'> Customer: </th>
                                                                <td style='text-align:left;'> &nbsp; <?php echo "Alvin Merto"; ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th style='text-align:right;'> Bill To:</th>
                                                                <td style='text-align:left;'>
                                                                    &nbsp; <?php echo "test company"; ?> <br/>
                                                                    <i class="ti ti-map-pins"></i> &nbsp; <?php echo "Test customer"; ?> <br/>
                                                                    <i class="ti ti-user"></i> &nbsp; <?php echo "the name"; ?> <br/>
                                                                    <i class="ti ti-phone"></i> &nbsp; <?php echo "2398423"; ?> <br/>
                                                                    <i class="ti ti-mail"></i> &nbsp; <?php echo "ajbmerto@gmail.com"; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style='vertical-align:top;'>
                                                        <table>
                                                            <tr>
                                                                <th style='text-align:right;'> Your Contact: </th>
                                                                <td style='text-align:left;'> 
                                                                    &nbsp; <?php echo "Test Worker"; ?> 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th style='text-align:right;'> Quote Date: </th>
                                                                <td style='text-align:left;'> &nbsp;  <?php echo date("M. d, Y", strtotime(date("M d. Y"))); ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th style='text-align:right;'> Expiration Date: </th>
                                                                <td style='text-align:left;'> &nbsp; <?php echo date("l - M. d, Y", strtotime(date("M d. Y"))); ?> </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </table>
                                        </div>
<?php
    echo "<table style='width: 100%; text-align:right;'>".$quote."</table>";
?>
</div><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/quote/templates/quotepdf.blade.php ENDPATH**/ ?>