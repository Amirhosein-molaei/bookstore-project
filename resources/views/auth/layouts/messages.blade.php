<div class="flex justify-center w-3/4 mx-auto my-4">
    @if (session('success'))
        <button class="btn-indigo px-4 py-4">
            {{ session('success') }}
            <svg class="h-5 w-5" onclick="removeButton()">
                <use xlink:href="#close"></use>
            </svg>
        </button>
    @endif
</div>

<div class="flex justify-center w-3/4 mx-auto my-4">
    @if (session('error'))
        <button class="btn-rose px-4 py-4">
            {{ session('error') }}
            <svg class="h-5 w-5" onclick="removeButton()">
                <use xlink:href="#close"></use>
            </svg>
        </button>
    @endif
</div>
<script>
    // تابع برای حذف دکمه
    function removeButton() {
        const successButton = document.querySelector('.btn-indigo');
        const errorButton = document.querySelector('.btn-rose');

        if (successButton) {
            successButton.remove();
        }
        
        if (errorButton) {
            errorButton.remove();
        }
    }

    // حذف خودکار دکمه پس از 5 ثانیه
    setTimeout(() => {
        removeButton();
    }, 5000);
</script>