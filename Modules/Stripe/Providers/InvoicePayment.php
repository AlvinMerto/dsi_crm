<?php

namespace Modules\Stripe\Providers;

use App\Models\Invoice;
use Illuminate\Support\ServiceProvider;

class InvoicePayment extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */


    public function boot(){

        view()->composer(['invoice.invoicepay'], function ($view)
        {
            $route = \Request::route()->getName();
            if($route == "pay.invoice")
            {
                try {
                    $ids = \Request::segment(3);
                    if(!empty($ids))
                    {
                        try {
                            $id = \Illuminate\Support\Facades\Crypt::decrypt($ids);
                            $invoice = Invoice::where('id',$id)->first();
                            $type = 'invoice';
                            if(module_is_active('Stripe', $invoice->created_by) && (company_setting('stripe_is_on', $invoice->created_by,$invoice->workspace)  == 'on') && (company_setting('stripe_key', $invoice->created_by,$invoice->workspace)) && (company_setting('stripe_secret', $invoice->created_by,$invoice->workspace)))
                            {
                                $view->getFactory()->startPush('invoice_payment_tab', view('stripe::payment.sidebar'));
                                $view->getFactory()->startPush('invoice_payment_div', view('stripe::payment.nav_containt_div',compact('type','invoice')));
                            }
                        } catch (\Throwable $th)
                        {
                            
                        }
                    }
                } catch (\Throwable $th) {

                }
            }
        });
    }
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
