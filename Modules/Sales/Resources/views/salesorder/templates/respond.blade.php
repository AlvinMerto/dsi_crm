<html>
    <head>
        <title> <?php echo $title; ?> </title>
    </head>
    <body>
        <?php if ($template == "thankyou") { ?>
            <div style='font-family:calibri; text-align:center;'>
                <div style="width:50%;margin:30px auto;border: 1px solid #ccc;border-radius: 15px;background: #c3ffec;">
                <br/>
                <h1> Thank you. </h1>
                <h3> This is inform you that we have received your order.</h3>
                <h3> One of our staff will contact you as soon as possible.</h3>
                <br/> <br/>
                </div>
            </div>
        <?php } ?>

        <?php if ($template == "expired") { ?>
            <div style='font-family:calibri; text-align:center;'>
                <div style="width:50%;margin:30px auto;border: 1px solid #ccc;border-radius: 15px;background: #ffc3c3;">
                <br/>
                <h1> Expired. </h1>
                <h3> This quotation has already been expired.</h3>
                <h3> Please contact us to get new quotation.</h3>
                <br/> <br/>
                </div>
            </div>
        <?php } ?>
    </body>
</html>