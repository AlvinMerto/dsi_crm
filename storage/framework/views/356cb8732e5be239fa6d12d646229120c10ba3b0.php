<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label> Labor Cost </label>
                <input type='number' id="labortxt" class="form-control"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label> Quantity </label>
                <input type='number' id="qtytxt_labor" class="form-control"/>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label> Mark-up </label>
                <select class="form-control" id='markupvalue_labor'>
                    <option value='65'> 65% </option>
                    <option value='75'> 75% </option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label> is Taxable </label>
                <input type='checkbox' id="istaxable"/> 
            </div>
        </div>
        <!-- <div class="col-md-12">
            <div class="form-group">
                <label> Total Price </label>
                <input type="text" class="form-control" id="totalpricelabor"/>
            </div>
        </div> -->
        <div class="col-md-12">
            <button id="savelabor" class="btn btn-primary"> Save </button>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\DSI_crm\Modules/Sales\Resources/views/salesquote/labor.blade.php ENDPATH**/ ?>