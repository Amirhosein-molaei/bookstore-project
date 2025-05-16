@use('Morilog\Jalali\Jalalian')
<html>

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/dependencies/swiper.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/dependencies/nouislider.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="mx-auto max-w-[900px] rounded-lg bg-muted p-5">
            <!-- Head -->
            <div class="flex flex-col items-center justify-center gap-y-4">
                <div>
                    <svg class="h-20 w-20 text-primary">
                        <use xlink:href="#check" />
                    </svg>
                </div>
                <h1 class="mb-8 text-center text-base text-primary md:text-lg lg:text-xl">
                    سفارش به شماره {{ $order->id }} با موفقیت در تاریخ
                    {{ Jalalian::forge($order->created_at)->format('%B %d، %Y') }} ثبت شد
                </h1>
            </div>

            <div class="mb-6 flex items-center justify-center text-sm">
                <div class="flex flex-col items-center gap-y-2 md:gap-y-4">
                    <p class="font-medium md:text-lg">جرئیات سفارش</p>
                    <div class="flex flex-col items-center gap-y-4">
                        @foreach ($order->orderItems as $item)
                            <p class="text-text/90">
                                نام محصول : <span class="tracking-wider">{{ $item->product->title }}</span>
                            </p>
                            <p class="text-text/90" style="border-bottom: 1px solid green;">
                                قیمت : <span>
                                    {{ $item->product->discounted_price ? number_format($item->product->discounted_price) : number_format($item->product->price) }}
                                </span>
                            </p>
                        @endforeach
                        <p class="text-text/90">
                            مبلغ کل : <span class="tracking-wider">{{ number_format($order->order_final_amount) }}</span>
                        </p>
                        <p class="text-text/90">
                            روش پرداخت : <span> {{ $order->payment_type == 0 ? 'کیف پول' : 'آنلاین' }} </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="gap-x-4">
                <div class="w-full">
                    <a href="{{ route('user-profile.order-details', $order) }}" class="btn-primary py-3"> پیگیری سفارش
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
