<!doctype html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ورود / ثبت نام</title>

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />

    <script src=" {{ asset('assets/scripts/mount.js') }}"></script>
</head>

<body>

    @include('app.layouts.partials.icons')

    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="relative mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Return -->
                <a href="./login.html"
                    class="absolute -top-3.5 -right-3.5 shadow-base hover:dark:bg-muted hover:bg-muted text-white hover:text-primary transition-all duration-200 hover: w-10 h-10 flex items-center justify-center rounded-full bg-primary">
                    <svg class="w-8 h-8">
                        <use xlink:href="#chevron-right" />
                    </svg>
                </a>
                <!-- Logo -->
                <a href="./index.html">
                    <img src="./assets/images/logo.svg" class="mx-auto mb-10 w-40" alt="" />
                </a>
                <h1 class="mb-10 text-lg">کد تایید را وارد کنید</h1>
                <div class="mb-4 space-y-4">
                    <form action="{{ route('otp.verify') }}" method="post" id="otp-form" dir="ltr">
                        @csrf
                        <div class="flex items-center justify-between gap-x-2">
                            <input type="number" inputmode="numeric"
                                class="otp-input h-14 w-14 rounded-lg border bg-muted text-center text-lg outline-none xs:h-16 xs:w-16 md:text-xl"
                                maxlength="1" />

                            <input type="number" inputmode="numeric"
                                class="otp-input h-14 w-14 rounded-lg border bg-muted text-center text-lg outline-none xs:h-16 xs:w-16 md:text-xl"
                                maxlength="1" />

                            <input type="number" inputmode="numeric"
                                class="otp-input h-14 w-14 rounded-lg border bg-muted text-center text-lg outline-none xs:h-16 xs:w-16 md:text-xl"
                                maxlength="1" />

                            <input type="number" inputmode="numeric"
                                class="otp-input h-14 w-14 rounded-lg border bg-muted text-center text-lg outline-none xs:h-16 xs:w-16 md:text-xl"
                                maxlength="1" />

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="otp" id="hiddenInput" value="">
                        </div>
                        <div class="mt-6">
                            <button type="submit" id="verify-btn" class="btn-primary w-full py-3">
                                تایید
                            </button>
                        </div>
                    </form>
                    <p class="h-5 text-sm text-red-500 dark:text-red-400">
                        @if (session('error'))
                            {{ session('error') }}
                        @endif
                    </p>
                </div>
                <ul class="mb-8 space-y-4">
                    <li>
                        <p class="text-primary text-sm" id="countdownSection">
                            زمان باقی‌مانده تا ارسال مجدد
                            <span id="countdown" class="font-bold">2:00</span>
                        </p>
                        <button id="resendButton" onclick="resendOTP()" class="!hidden btn-primary-nobg text-sm w-fit">
                            <span> ارسال مجدد </span>
                            <span>
                                <svg class="h-5 w-5">
                                    <use xlink:href="#chevron-left" />
                                </svg>
                            </span>
                        </button>
                    </li>
                    <li>
                        <a href="#" class="btn-primary-nobg text-sm w-fit">
                            <span>ورود با کلمه عبور </span>
                            <span>
                                <svg class="h-5 w-5">
                                    <use xlink:href="#chevron-left" />
                                </svg>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        // Time for Resend OTP , Current : 2 minutes
        let countdownMinutes = 2;
        let countdownSeconds = 0;
        let countdownInterval;

        function updateCountdown() {
            const countdownElement = document.getElementById("countdown");
            countdownElement.textContent = `${countdownMinutes}:${countdownSeconds
          .toString()
          .padStart(2, "0")}`;
        }

        function startCountdown() {
            countdownInterval = setInterval(function() {
                if (countdownMinutes === 0 && countdownSeconds === 0) {
                    clearInterval(countdownInterval);
                    document.getElementById("resendButton").classList.remove("!hidden");
                    document.getElementById("resendButton").disabled = false;
                    document.getElementById("countdownSection").classList.add("hidden");
                } else {
                    if (countdownSeconds === 0) {
                        countdownMinutes--;
                        countdownSeconds = 59;
                    } else {
                        countdownSeconds--;
                    }
                    updateCountdown();
                }
            }, 1000);
        }

        function resendOTP() {
            if (countdownMinutes != 0 || countdownSeconds != 0) return;
            // Add your OTP resend logic here
            // For demonstration, let's just reset the countdown and disable the button
            countdownMinutes = 2;
            countdownSeconds = 0;
            updateCountdown();
            document.getElementById("resendButton").classList.add("!hidden");
            document.getElementById("resendButton").disabled = true;
            document.getElementById("countdownSection").classList.remove("hidden");

            startCountdown();
        }

        startCountdown(); // Start the countdown when the page loads

        // Otp Input Section Start
        const form = document.querySelector("#otp-form");
        const inputs = document.querySelectorAll(".otp-input");
        const verifyBtn = document.querySelector("#verify-btn");

        inputs[0].focus();

        const isAllInputFilled = () => {
            return Array.from(inputs).every((item) => item.value);
        };

        const getOtpText = () => {
            let text = "";
            inputs.forEach((input) => {
                text += input.value;
            });
            return text;
        };
        
        let otp = document.getElementById('hiddenInput');
        const verifyOTP = () => {
            const text = getOtpText();
            if (isAllInputFilled()) {
                otp.value = text;
            }
        };

        const toggleFilledClass = (field) => {
            if (field.value) {
                field.classList.add("!border-emerald-500");
                field.classList.add("!border-emerald-400");
            } else {
                field.classList.remove("!border-emerald-500");
                field.classList.remove("!border-emerald-400");
            }
        };
        form.addEventListener("input", (e) => {
            const target = e.target;
            const value = target.value;

            toggleFilledClass(target);
            if (target.nextElementSibling) {
                target.nextElementSibling.focus();
            }
            verifyOTP();
        });
        inputs.forEach((input, currentIndex) => {
            // fill check
            toggleFilledClass(input);
            // paste event
            input.addEventListener("paste", (e) => {
                e.preventDefault();
                const text = e.clipboardData.getData("text");

                inputs.forEach((item, index) => {
                    if (index >= currentIndex && text[index - currentIndex]) {
                        item.focus();
                        item.value = text[index - currentIndex] || "";
                        toggleFilledClass(item);
                        verifyOTP();
                    }
                });
            });
            // backspace event
            input.addEventListener("keydown", (e) => {
                if (e.keyCode === 8) {
                    e.preventDefault();
                    input.value = "";
                    // console.log(input.value);
                    toggleFilledClass(input);
                    if (input.previousElementSibling) {
                        input.previousElementSibling.focus();
                    }
                } else {
                    if (input.value && input.nextElementSibling) {
                        input.nextElementSibling.focus();
                    }
                }
            });
        });
        verifyBtn.addEventListener("click", () => {
            verifyOTP();
        });
        // Otp Input Section End
    </script>
</body>

</html>
