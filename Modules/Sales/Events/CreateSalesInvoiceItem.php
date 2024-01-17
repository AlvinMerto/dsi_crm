<?php

namespace Modules\Sales\Events;

use Illuminate\Queue\SerializesModels;

class CreateSalesInvoiceItem
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $invoice;
    public $invoiceitem;
    public function __construct($invoice,$invoiceitem)
    {
        $this->invoice     = $invoice;
        $this->invoiceitem = $invoiceitem;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
