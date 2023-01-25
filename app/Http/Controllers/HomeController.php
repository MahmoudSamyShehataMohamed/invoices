<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allinvoices = Invoice::all();
        $paidinvoices = Invoice::where('Value_Status', 1)->get();
        $unpaidinvoices = Invoice::where('Value_Status', 2)->get();
        $partialinvoices = Invoice::where('Value_Status', 3)->get();

        $paidpercent = round(($paidinvoices->count() /  $allinvoices->count() * 100), 2);
        $unpaidpercent = round(($unpaidinvoices->count() /  $allinvoices->count() * 100), 2);
        $partialpercent = round(($partialinvoices->count() /  $allinvoices->count() * 100), 2);



        $count_all = Invoice::count();
        $count_invoices1 = Invoice::where('Value_Status', 1)->count();
        $count_invoices2 = Invoice::where('Value_Status', 2)->count();
        $count_invoices3 = Invoice::where('Value_Status', 3)->count();


        if ($count_invoices1 == 0) {
            $invoices1 = 0;
        } else {
            $invoices1 = $count_invoices1 / $count_all * 100;
        }

        if ($count_invoices2 == 0) {
            $invoices2 = 0;
        } else {
            $invoices2 = $count_invoices2 / $count_all * 100;
        }

        if ($count_invoices3 == 0) {
            $invoices3 = 0;
        } else {
            $invoices3 = $count_invoices3 / $count_all * 100;
        }



        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$invoices2]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$invoices1]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$invoices3]
                ],


            ])
            ->options([]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$invoices2, $invoices1, $invoices3]
                ]
            ])
            ->options([]);


        return view('home', compact('allinvoices', 'paidinvoices', 'unpaidinvoices', 'partialinvoices', 'paidpercent', 'unpaidpercent', 'unpaidpercent', 'partialpercent', 'chartjs', 'chartjs_2'));
    }
}
