<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sales\Entities\SalesAccount;
use Modules\Sales\Entities\SalesInvoice;
use Modules\Sales\Entities\SalesOrder;
use Modules\Sales\Entities\Quote;
use Modules\Sales\Entities\SalesQuote;

class ReportController extends Controller
{
    protected $startDate;
    protected $endDate;
    protected $monthsDiff;
    protected $interval;
    protected $timeType;
    protected $dateFormat;

    public function __construct(Request $request)
    {
        $this->startDate  = Carbon::parse($request->startDate);
        $this->endDate    = Carbon::parse($request->endDate);


        $this->monthsDiff = $this->endDate->diffInMonths($this->startDate);

        if ($this->monthsDiff >= 0 && $this->monthsDiff < 3) {
            // Group by day
            $this->endDate    = $this->endDate->addDay();
            $this->interval   = CarbonInterval::day();
            $this->timeType   = "date";
            $this->dateFormat = "DATE_FORMAT(sales_quotes.issue_date, '%Y-%m-%d') AS date";
        } elseif ($this->monthsDiff >= 3 && $this->monthsDiff < 11) {
            // Group by month
            $this->interval   = CarbonInterval::month();
            $this->timeType   = "month";
            $this->dateFormat = "DATE_FORMAT(sales_quotes.issue_date, '%Y-%m') AS month";
        } else {
            $this->interval   = CarbonInterval::year();
            $this->timeType   = "year";
            $this->dateFormat = "YEAR(sales_quotes.issue_date) AS year";
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sales::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sales::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sales::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sales::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function invoiceanalytic(Request $request)
    {
        $report['account'] = __('All');
        $report['status']  = __('All');
        $account           = SalesAccount::where('created_by', '=', creatorId())->where('workspace', '=', getActiveWorkSpace())->get()->pluck('name', 'id');
        $account->prepend('Select Account', '');
        $status = SalesInvoice::$status;

        $data = [];

        if(!empty($request->start_month) && !empty($request->end_month))
        {
            $start = strtotime($request->start_month);
            $end   = strtotime($request->end_month);
        }
        else
        {
            $start = strtotime(date('Y-01'));
            $end   = strtotime(date('Y-12'));
        }
        $invoice = SalesInvoice::selectRaw('sales_invoices.*,MONTH(date_quoted) as month,YEAR(date_quoted) as year')->orderBy('id');

        $invoice->where('date_quoted', '>=', date('Y-m-01', $start))->where('date_quoted', '<=', date('Y-m-t', $end));
        if(!empty($request->account))
        {
            $invoice->where('account', $request->account);
        }
        if(!empty($request->status))
        {
            $invoice->where('status', $request->status);
        }

        $invoice->where('created_by', creatorId())->where('workspace', '=', getActiveWorkSpace());
        $invoice = $invoice->get();

        $totalInvoice      = 0;
        $totalDueInvoice   = 0;
        $invoiceTotalArray = [];
        foreach($invoice as $invoic)
        {
            $totalInvoice                        += $invoic->getTotal();
            $invoiceTotalArray[$invoic->month][] = $invoic->getTotal();
        }

        for($i = 1; $i <= 12; $i++)
        {
            $invoiceTotal[] = array_key_exists($i, $invoiceTotalArray) ? array_sum($invoiceTotalArray[$i]) : 0;
        }
        $monthList = $month = $this->yearMonth();

        $report['startDateRange'] = date('M-Y', $start);
        $report['endDateRange']   = date('M-Y', $end);

        return view('sales::report.invoiceanalytic', compact('monthList', 'data', 'report', 'invoice', 'account', 'status', 'totalInvoice', 'invoiceTotal'));
    }

    public function yearMonth()
    {

        $month[] = __('January');
        $month[] = __('February');
        $month[] = __('March');
        $month[] = __('April');
        $month[] = __('May');
        $month[] = __('June');
        $month[] = __('July');
        $month[] = __('August');
        $month[] = __('September');
        $month[] = __('October');
        $month[] = __('November');
        $month[] = __('December');

        return $month;
    }

    public function salesorderanalytic(Request $request)
    {
        $status = SalesOrder::$status;

        $data = [];

        if(!empty($request->start_month) && !empty($request->end_month))
        {
            $start = strtotime($request->start_month);
            $end   = strtotime($request->end_month);
        }
        else
        {
            $start = strtotime(date('Y-01'));
            $end   = strtotime(date('Y-12'));
        }
        $salesorder = SalesOrder::selectRaw('sales_orders.*,MONTH(date_quoted) as month,YEAR(date_quoted) as year')->orderBy('id');

        $salesorder->where('date_quoted', '>=', date('Y-m-01', $start))->where('date_quoted', '<=', date('Y-m-t', $end));

        if(!empty($request->status))
        {
            $salesorder->where('status', $request->status);
        }

        $salesorder->where('created_by', creatorId())->where('workspace', '=', getActiveWorkSpace());
        $salesorder = $salesorder->get();

        $totalSalesorder      = 0;
        $salesorderTotalArray = [];
        foreach($salesorder as $salesord)
        {
            $totalSalesorder                          += $salesord->getTotal();
            $salesorderTotalArray[$salesord->month][] = $salesord->getTotal();
        }

        for($i = 1; $i <= 12; $i++)
        {
            $salesorderTotal[] = array_key_exists($i, $salesorderTotalArray) ? array_sum($salesorderTotalArray[$i]) : 0;
        }
        $monthList = $month = $this->yearMonth();

        $report['startDateRange'] = date('M-Y', $start);
        $report['endDateRange']   = date('M-Y', $end);

        return view('sales::report.salesorderanalytic', compact('monthList', 'data', 'report', 'salesorder', 'status', 'totalSalesorder', 'salesorderTotal'));

    }

    public function quoteanalytic(Request $request)
    {
        $status = Quote::$status;

        $data = [];

        if(!empty($request->start_month) && !empty($request->end_month))
        {
            $start = strtotime($request->start_month);
            $end   = strtotime($request->end_month);
        }
        else
        {
            $start = strtotime(date('Y-01'));
            $end   = strtotime(date('Y-12'));
        }
        $quote = Quote::selectRaw('quotes.*,MONTH(date_quoted) as month,YEAR(date_quoted) as year')->orderBy('id');

        $quote->where('date_quoted', '>=', date('Y-m-01', $start))->where('date_quoted', '<=', date('Y-m-t', $end));
        if(!empty($request->status))
        {
            $quote->where('status', $request->status);
        }

        $quote->where('created_by', creatorId())->where('workspace', '=', getActiveWorkSpace());
        $quote = $quote->get();
        $totalQuote = 0;
        $quoteTotalArray = [];
        foreach($quote as $quot)
        {
            $totalQuote                     += $quot->getTotal();
            $quoteTotalArray[$quot->month][] = $quot->getTotal();
        }

        for($i = 1; $i <= 12; $i++)
        {
            $quoteTotal[] = array_key_exists($i, $quoteTotalArray) ? array_sum($quoteTotalArray[$i]) : 0;
        }
        $monthList = $month = $this->yearMonth();

        $report['startDateRange'] = date('M-Y', $start);
        $report['endDateRange']   = date('M-Y', $end);

        return view('sales::report.quoteanalytic', compact('monthList', 'data', 'report','quote', 'totalQuote', 'status', 'quoteTotal'));
    }

    public function salesquotesummary(Request $request)
    {

        $employee           = User::where('type', '=', 'staff')->where('workspace_id', '=', getActiveWorkSpace())->get()->pluck('name', 'id');
        $employee->prepend('Select Employee', '');

        $salesquotes = SalesQuote::join('sales_quotes_items', 'sales_quotes_items.quote_id', 'sales_quotes.id')
                                 ->selectRaw("$this->dateFormat, sales_quotes.id, sales_quotes.quote_id, sales_quotes.issue_date, SUM(sales_quotes_items.extended) as exteneddata")
                                 ->where('sales_quotes_items.type','substart')
                                 ->whereBetween('sales_quotes.issue_date', [$this->startDate, $this->endDate])
                                 ->where('sales_quotes.created_by', creatorId())
                                 ->where('sales_quotes.workspace', '=', getActiveWorkSpace())
                                 ->orderBy($this->timeType)
                                 ->groupBy($this->timeType);
        if(isset($request->employee) && ($request->employee != null))
        {
            $salesquotes->where('sales_quotes.contact_person',$request->employee);
        }
        $salesquotes=$salesquotes->get();


        $salesquotes1=SalesQuote::join('sales_quotes_items', 'sales_quotes_items.quote_id', 'sales_quotes.id')
            ->join('taxes','taxes.id','sales_quotes_items.tax')
            ->selectRaw("$this->dateFormat,SUM(((taxes.rate/100) * (sales_quotes_items.price * sales_quotes_items.quantity))) as taxes")
            ->where('sales_quotes_items.type','subitem')
            ->whereBetween('sales_quotes.issue_date', [$this->startDate, $this->endDate])
            ->where('sales_quotes.created_by', creatorId())
            ->where('sales_quotes.workspace', '=', getActiveWorkSpace())
            ->orderBy($this->timeType)
            ->groupBy($this->timeType);
        if(isset($request->employee) && ($request->employee != null))
        {
            $salesquotes1->where('sales_quotes.contact_person',$request->employee);
        }
        $salesquotes1=$salesquotes1->get();


        $totalSalesQuote      = 0;
        $totalDueInvoice   = 0;
        $SalesQuoteTotalArray = [];

        $chartData = [];
        foreach($salesquotes as $key => $salesquote)
        {
            $tax=0;
            if((count($salesquotes1)!=0) && (count($salesquotes1) > $key))
            {
                $tax=$salesquotes1[$key]['taxes'];
            }
            $formattedDate = $salesquote[$this->timeType];
            $sales=$salesquote->exteneddata+$tax;
            $totalSalesQuote                     += $salesquote->grandtotal();
            $chartData[] = [
                'Date' => $formattedDate,
                'Sales' => $sales,
            ];
        }

        $resultArray = [
            "date" => [],
            "series" => [],
        ];

        foreach ($chartData as $item) {
            // Add date to the "date" array
            $resultArray["date"][] = $item["Date"];

            foreach ($item as $key => $value) {
                // Skip the "Date" field
                if ($key === "Date") continue;

                // Check if the series already exists in the result array
                $seriesExists = false;
                foreach ($resultArray["series"] as &$seriesItem) {
                    if ($seriesItem["name"] === $key) {
                        $seriesItem["data"][] = $value;
                        $seriesExists = true;
                        break;
                    }
                }

                // If the series doesn't exist, create a new series entry
                if (!$seriesExists) {
                    $newSeries = [
                        "name" => $key,
                        "data" => [$value],
                    ];
                    $resultArray["series"][] = $newSeries;
                }
            }
        }
        $chartData['order'] = $resultArray;
        return view('sales::report.salesquotesummary', compact('employee','chartData', 'salesquotes','totalSalesQuote',));
    }

    public function salesquotetotalprofit(Request $request)
    {
        $salesquotes=SalesQuote::join('sales_quotes_items','sales_quotes_items.quote_id','sales_quotes.id')
            ->where('sales_quotes_items.type','substart')
            ->selectRaw("$this->dateFormat,sales_quotes.id,sales_quotes.quote_id,sales_quotes.issue_date,SUM(sales_quotes_items.profit) as totalprofit")
            ->whereBetween('sales_quotes.issue_date', [$this->startDate, $this->endDate])
            ->where('sales_quotes.created_by', creatorId())->where('sales_quotes.workspace', '=', getActiveWorkSpace())
            ->orderBy($this->timeType)->groupBy($this->timeType)
            ->get();



        $totalSalesQuote      = 0;
        $totalDueInvoice   = 0;
        $SalesQuoteTotalArray = [];

        $chartData = [];
        foreach($salesquotes as $salesquote)
        {
            $formattedDate = $salesquote[$this->timeType];
            $sales=$salesquote->totalprofit;
            $totalSalesQuote                     += $salesquote->totalProfit();
            $chartData[] = [
                'Date' => $formattedDate,
                'Total Profit' => $sales,
            ];
        }

        $resultArray = [
            "date" => [],
            "series" => [],
        ];

        foreach ($chartData as $item) {
            // Add date to the "date" array
            $resultArray["date"][] = $item["Date"];

            foreach ($item as $key => $value) {
                // Skip the "Date" field
                if ($key === "Date") continue;

                // Check if the series already exists in the result array
                $seriesExists = false;
                foreach ($resultArray["series"] as &$seriesItem) {
                    if ($seriesItem["name"] === $key) {
                        $seriesItem["data"][] = $value;
                        $seriesExists = true;
                        break;
                    }
                }

                // If the series doesn't exist, create a new series entry
                if (!$seriesExists) {
                    $newSeries = [
                        "name" => $key,
                        "data" => [$value],
                    ];
                    $resultArray["series"][] = $newSeries;
                }
            }
        }
        $chartData['order'] = $resultArray;
        $timetype=$this->timeType;

        return view('sales::report.salesquoteprofit', compact('chartData', 'salesquotes','totalSalesQuote','timetype'));
    }

    public function salesquotetotalcost(Request $request)
    {
        $salesquotes=SalesQuote::join('sales_quotes_items','sales_quotes_items.quote_id','sales_quotes.id')
                               ->where('sales_quotes_items.type','substart')
                               ->selectRaw("$this->dateFormat,sales_quotes.id,sales_quotes.quote_id,sales_quotes.issue_date,SUM(sales_quotes_items.totalmaincost) as totalcost")
                               ->whereBetween('sales_quotes.issue_date', [$this->startDate, $this->endDate])
                               ->where('sales_quotes.created_by', creatorId())->where('sales_quotes.workspace', '=', getActiveWorkSpace())
                               ->orderBy($this->timeType)->groupBy($this->timeType)
                               ->get();



        $totalSalesQuote      = 0;
        $totalDueInvoice   = 0;
        $SalesQuoteTotalArray = [];

        $chartData = [];
        foreach($salesquotes as $salesquote)
        {
            $formattedDate = $salesquote[$this->timeType];
            $sales=$salesquote->totalcost;
            $totalSalesQuote                     += $salesquote->totalProfit();
            $chartData[] = [
                'Date' => $formattedDate,
                'Total Cost' => $sales,
            ];
        }

        $resultArray = [
            "date" => [],
            "series" => [],
        ];

        foreach ($chartData as $item) {
            // Add date to the "date" array
            $resultArray["date"][] = $item["Date"];

            foreach ($item as $key => $value) {
                // Skip the "Date" field
                if ($key === "Date") continue;

                // Check if the series already exists in the result array
                $seriesExists = false;
                foreach ($resultArray["series"] as &$seriesItem) {
                    if ($seriesItem["name"] === $key) {
                        $seriesItem["data"][] = $value;
                        $seriesExists = true;
                        break;
                    }
                }

                // If the series doesn't exist, create a new series entry
                if (!$seriesExists) {
                    $newSeries = [
                        "name" => $key,
                        "data" => [$value],
                    ];
                    $resultArray["series"][] = $newSeries;
                }
            }
        }
        $chartData['order'] = $resultArray;
        $timetype=$this->timeType;

        return view('sales::report.salesquotecost', compact('chartData', 'salesquotes','totalSalesQuote','timetype'));
    }
}
