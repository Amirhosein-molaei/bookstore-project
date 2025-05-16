<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Models\Market\OrderItem;
use App\Http\Controllers\Controller;
use App\Models\Market\Order;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $currentJYear = Jalalian::now()->getYear();

        $startOfJYear = Jalalian::fromFormat('Y/m/d', $currentJYear . '/01/01')->toCarbon();
        $endOfJYear = Jalalian::fromFormat('Y/m/d', $currentJYear . '/12/29')->toCarbon();

        // orders of current year
        $orders = Order::whereBetween('created_at', values: [$startOfJYear, $endOfJYear])->get();
        
        // build an array with keys 1 to 12 and all values set to 0
        $salesByMonth = array_fill(1, 12, 0);

        // for each order month's value will'be added by one. value contains number of orders in the month
        foreach ($orders as $order) {
            $month = Jalalian::fromCarbon($order->created_at)->getMonth();
            $salesByMonth[$month]++;
        }

        // لیبل‌های ماه‌های شمسی به ترتیب از فروردین تا اسفند
        $labels = [
            'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور',
            'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'
        ];

        // استخراج داده‌ها به صورت آرایه مقادیر
        $data = array_values($salesByMonth);

        return view('admin.index', [
            'labels'    => json_encode($labels),
            'chartData' => json_encode($data)
        ]);

    }
}
