@extends('app.layouts.master')
@section('title', 'صفحه  سوالات متداول')
@section('content')
<main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
        <div class="container rounded-lg bg-muted p-5">
          <div class="mb-8">
            <div class="mb-5 flex">
              <h1 class="relative select-none pb-2 text-lg md:text-xl">
                سوالات متداول
                <span
                  class="absolute bottom-0 right-0 h-0.5 w-full rounded-full bg-primary"
                ></span>
              </h1>
            </div>
            <p class="mb-5 text-sm text-text/90 xs:text-base">
              سوال خود را پیدا نکردید ؟
              <a href="#" class="text-primary">با ما تماس بگیرید</a>
            </p>
          </div>
          <div class="mb-16 grid grid-cols-12 gap-y-8 md:gap-x-8">
           
            <div class="col-span-12 space-y-8 md:col-span-8">
              <div>
             
                <ul class="mr-2 space-y-4">
                    @foreach ($faqs as $faq)
                    
                  <li class="relative border-b bg-muted" data-accordion-item>
                    <div
                      class="w-full px-4 py-3 text-right md:px-6 md:py-5 cursor-pointer"
                      data-accordion-button
                    >
                      <div
                        class="flex items-center justify-between gap-2 text-sm md:text-base"
                      >
                        <span>
                            {{ $faq->question }}
                        </span>
                        <div class="min-w-fit">
                          <svg
                            data-accordion-chevron
                            class="h-5 w-5 duration-300"
                          >
                            <use xlink:href="#chevron-left"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div
                      class="relative max-h-0 overflow-hidden transition-all duration-300"
                      data-accordion-content
                    >
                      <div class="px-4 py-4 text-sm text-text/80 lg:text-base">
                        {{$faq->answer}}
                      </div>
                    </div>
                  </li>
                  @endforeach

                </ul>
              </div>
              <div>
              
             
              </div>
            </div>
          </div>
          <!-- Footer -->
          <div class="flex justify-center">
            <p class="mb-5 text-sm text-text/90 xs:text-base">
              سوال خود را پیدا نکردید ؟
              <a href="#" class="text-primary">با ما تماس بگیرید</a>
            </p>
          </div>
        </div>
      </main>

@endsection