<!doctype html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ورود / ثبت نام</title>

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Logo -->
                <a href="./index.html">
                    <img src="./assets/images/logo.svg" class="mx-auto mb-10 w-40" alt="" />
                </a>
                <h1 class="mb-10 text-center text-lg">ورود | ثبت نام</h1>
                <p class="text-center text-sm text-text/90">
                    کاربر گرامی، به بوک استور خوش آمدید. کد تایید شما : 
                    <span class="text-primary font-bold">
                        {{ $otp->otp_code }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
