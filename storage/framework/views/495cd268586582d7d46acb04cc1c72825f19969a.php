<script src="<?php echo e(asset('/js/jquery.min.js')); ?> "></script>
<script type="text/javascript" src="<?php echo e(asset('/js/html2pdf.bundle.min.js')); ?>"></script>
<script>
    function closeScript() {
        setTimeout(function () {
            window.open(window.location, '_self').close();
        }, 1000);
    }

    $(window).on('load', function () {
        var element = document.getElementById('boxes');
        var opt = {
            filename: '<?php echo e(Modules\Sales\Entities\Quote::quoteNumberFormat($quote->quote_id,$quote->created_by)); ?>',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save().then(closeScript);
    });

</script>
<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/quote/script.blade.php ENDPATH**/ ?>