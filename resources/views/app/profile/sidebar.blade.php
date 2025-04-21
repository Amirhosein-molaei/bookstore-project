   <!-- Desktop sidebar -->
   <div class="sticky top-32 hidden w-full overflow-hidden rounded-lg bg-muted shadow-base lg:block">
       <div dir="ltr" class="max-h-[calc(90vh_-_100px)] overflow-y-auto p-4 xl:p-6">
           <div dir="rtl">
               <!-- Head -->
               <div class="mb-2 flex items-center justify-between border-b pb-6 dark:border-white/10">
                   <div class="flex items-center gap-x-4">
                       <div>
                           <img src="{{ asset('assets/images/user.png') }}" class="h-12 w-12 rounded-full"
                               alt="" />
                       </div>
                       <div class="flex flex-col">
                           <div class="line-clamp-1">{{ Auth::user()->name }}</div>
                           <div class="line-clamp-1 text-text/90">
                               {{ Auth::user()->mobile ?? Auth::user()->email }}
                           </div>
                       </div>
                   </div>

               </div>

               <ul class="space-y-1">
                   <li>
                       <a href="{{ route('user-profile.') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#home" />
                               </svg>
                               <div>پیشخوان</div>
                           </div>
                       </a>
                   </li>
                   <li>
                       <a href="./profile-orders.html"
                           class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#order" />
                               </svg>
                               <div>سفارش ها</div>
                           </div>
                       </a>
                   </li>

                   <li>
                       <a href="./profile-favorite.html"
                           class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#heart" />
                               </svg>
                               <div>محصولات محبوب</div>
                           </div>
                       </a>
                   </li>

                   <li>
                       <a href="./profile-favorite.html"
                           class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#heart" />
                               </svg>
                               <div>نویسندگان محبوب</div>
                           </div>
                       </a>
                   </li>

                   <li>
                       <a href="{{ route('user-profile.tickets') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.tickets' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#notification" />
                               </svg>
                               <div> تیکت ها</div>
                           </div>
                       </a>
                   </li>


                   <li>
                       <a href="./profile-recent.html"
                           class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#recent" />
                               </svg>
                               <div>بازدید های اخیر</div>
                           </div>
                       </a>
                   </li>
                   <li>
                       <a href="./profile-notification.html"
                           class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#notification" />
                               </svg>
                               <div>پیام ها</div>
                           </div>
                           <div
                               class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary text-sm font-bold text-white dark:bg-emerald-600">
                               10
                           </div>
                       </a>
                   </li>

                   <li>
                       <a href="./profile-edit.html"
                           class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#user-setting" />
                               </svg>
                               <div>اطلاعات حساب کاربری</div>
                           </div>
                       </a>
                   </li>
                   <li>
                       <form
                           class="flex items-center justify-between rounded-lg p-4 text-red-500 hover:bg-warning/10 dark:text-red-400 dark:hover:bg-red-400/10 cursor-pointer"
                           action="{{ route('logout') }}" method="post">
                           @csrf
                           <div class="flex items-center gap-x-2">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#exit"></use>
                               </svg>
                               <button type="submit"> خروج </button>
                           </div>
                       </form>
                   </li>
               </ul>
           </div>
       </div>
   </div>
