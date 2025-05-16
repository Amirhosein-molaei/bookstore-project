@extends('app.layouts.master')
@section('title', 'نویسندگان')
@section('scripts')
@parent
<!-- <script>
    const csrf = '{{ csrf_token() }}';
</script> -->

<script>
    function loadWriterDetails(writerId) {

        document.getElementById('writerDetailsContainer').innerHTML = `
        <div class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary"></div>
        </div>
    `;


        fetch(`/writers/${writerId}/details`)
            .then(response => response.json())
            .then(data => {

                document.getElementById('writerDetailsContainer').innerHTML = `
                <div class="mb-6">
                    <ul class="-mb-px flex justify-between gap-x-2 border-b text-center text-sm font-medium xs:justify-start xs:gap-x-4 xs:text-base">
                        <li>
                            <a href="#description" class="inline-block rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover:text-text/90 dark:hover:text-zinc-300">
                                معرفی
                            </a>
                        </li>
                        <li>
                            <a href="#specs" class="inline-block rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover:text-text/90 dark:hover:text-zinc-300">
                                مشخصات
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-16 divide-y">
                    <div class="py-6" id="description">
                        <div class="relative mb-16 w-fit text-xl font-medium">
                            معرفی
                            <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary"></span>
                        </div>
                        <div class="mb-6 max-h-[500px] overflow-hidden md:mb-10" id="descriptionContainer">
                            <div class="space-y-4 text-sm leading-loose text-text/90 lg:text-base">
                                <p>${data.description}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-6" id="specs">
                        <div class="relative mb-16 w-fit text-xl font-medium">
                            مشخصات
                            <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary"></span>
                        </div>
                        <div class="mb-6 max-h-[500px] overflow-hidden md:mb-10" id="specsContainer">
                            <ul class="space-y-6 text-sm">
                                <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                    <div class="col-span-1 text-text/60">نام</div>
                                    <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                        <ul class="space-y-4">
                                            <li>${data.name !== null ? data.name : '-'}</li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                    <div class="col-span-1 text-text/60">نام انگلیسی</div>
                                    <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                        <ul class="space-y-4">
                                            <li>${data.english_name !== null ? data.english_name : '-'}</li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                    <div class="col-span-1 text-text/60">ملیت</div>
                                    <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                        <ul class="space-y-4">
                                            <li>${data.nationality !== null ? data.nationality : '-'}</li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                    <div class="col-span-1 text-text/60">تاریخ تولد</div>
                                    <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                        <ul class="space-y-4">
                                            <li>${data.birth_year !== null ? data.birth_year : '-'}</li>
                                        </ul>
                                    </div>
                                </li>
                              <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                    <div class="col-span-1 text-text/60">تاریخ وفات</div>
                                    <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                        <ul class="space-y-4">
                                            <li>${data.death_year !== null ? data.death_year : '-'}</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;

                // اسکرول به بخش جزئیات
                document.getElementById('writerDetailsContainer').scrollIntoView({
                    behavior: 'smooth'
                });
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('writerDetailsContainer').innerHTML = `
                <div class="text-center py-8 text-red-500">
                    خطا در بارگذاری اطلاعات نویسنده
                </div>
            `;
            });
    }
</script>
@endsection
@section('content')
<main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
    <div class="container">
        <div class="mb-6">
            <div>


                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">نویسنده ها</h3>
                </div>
                <!-- Section Content -->
                <div class="swiper product-slider p-px">
                    <div class="swiper-wrapper">
                        @foreach($writers as $writer)
                        <div class="swiper-slide">
                            <!-- Product Card -->
                            <div class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                    <!-- image -->
                                    <div class="mb-2 md:mb-5" draggable="false">
                                        <a href="javascript:void(0)" onclick="loadWriterDetails({{$writer->id}})">
                                            <img alt="" class="mx-auto w-32 rounded-lg md:w-auto" src="{{ asset($writer->avatar) }}" />
                                        </a>
                                    </div>
                                    <!-- title -->
                                    <div class="mb-2">
                                        <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base" href="javascript:void(0)" onclick="loadWriterDetails({{$writer->id}})">
                                            {{$writer->name}}
                                        </a>
                                    </div>
                                    <!-- Prices -->
                                    <div class="flex flex-col">
                                        <div class="flex items-center justify-between">
                                            <span class="btn-yellow py-1 px-4">
                                                {{$writer->nationality}}
                                            </span>
                                            {{-- <!-- New price -->
                                                    <div class="text-sm font-bold text-primary md:text-base">
                                                        {{$writer->english_name}}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- description / specs / commment  -->
    <div class="rounded-lg bg-muted p-4 shadow-base" id="writerDetailsContainer">
        <!-- محتوای این بخش به صورت پویا با JavaScript پر خواهد شد -->
    </div>
    </div>
</main>

@endsection