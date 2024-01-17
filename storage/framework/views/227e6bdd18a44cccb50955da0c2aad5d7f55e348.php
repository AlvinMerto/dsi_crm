<?php if($type=="pdf"): ?>
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
            filename: '<?php echo e(Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by)); ?>',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save().then(closeScript);
    });
</script>
<?php endif; ?>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/salesquote/script.blade.php ENDPATH**/ ?>