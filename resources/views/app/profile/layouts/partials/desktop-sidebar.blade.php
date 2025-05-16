   <!-- Desktop sidebar -->
   <div class="sticky top-32 hidden w-full overflow-hidden rounded-lg bg-muted shadow-base lg:block">
       <div dir="ltr" class="max-h-[calc(90vh_-_100px)] overflow-y-auto p-4 xl:p-6">
           <div dir="rtl">
               <!-- Head -->
               <div class="mb-2 border-b pb-6 dark:border-white/10">
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
                   <div class="flex justify-between align-items-center mt-4">
                        <p>
                            <svg class="h-6 w-6">
                                <use xlink:href="#credit" />
                            </svg>
                        </p>
                        <p>{{ number_format(Auth::user()->wallet->balance) }} تومان</p>
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
                       <a href="{{ route('user-profile.wallet') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.wallet' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#credit" />
                               </svg>
                               <div>کیف پول</div>
                           </div>
                       </a>
                   </li>
                   <li>
                       <a href="{{ route('user-profile.orders') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.orders' ? 'profile-menu-active' : '' }} {{ Route::currentRouteName() == 'user-profile.order-details' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#order" />
                               </svg>
                               <div>سفارش ها</div>
                           </div>
                       </a>
                   </li>

                   <li>
                       <a href="{{ route('user-profile.product-favorite') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.product-favorite' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#heart" />
                               </svg>
                               <div>محصولات محبوب</div>
                           </div>
                       </a>
                   </li>

                   <li>
                       <a href="{{ route('user-profile.favorite-writers') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.favorite-writers' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                           <div class="flex items-center gap-x-4">
                               <svg class="h-6 w-6">
                                   <use xlink:href="#user" />
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
                       <a href="{{ route('user-profile.edit') }}"
                           class="profile-menu {{ Route::currentRouteName() == 'user-profile.edit' ? 'profile-menu-active' : '' }} flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
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
   <!-- Mobile menu -->
   <div class="rounded-lg bg-muted p-6 shadow-base lg:hidden">
       <div class="flex items-center justify-center">
           <div class="flex flex-col items-center justify-center gap-y-4">
               <div class="relative">
                   <img src="./assets/images/user.png" class="h-20 w-20 only:rounded-full" alt="" />
                   <a href="./profile-edit.html"
                       class="absolute -right-2 -top-2 rounded-full bg-primary p-2 text-sm text-white dark:bg-emerald-600">
                       <svg class="h-5 w-5">
                           <use xlink:href="#edit" />
                       </svg>
                   </a>
               </div>
               <div>
                   <p class="line-clamp-1">{{ Auth::user()->name }}</p>
                   <p class="text-text/60">{{ Auth::user()->mobile ?? Auth::user()->email }}</p>
               </div>
               <div>
                   <button class="btn-primary px-4 py-2" aria-controls="profile-menu-drawer-navigation"
                       data-drawer-show="profile-menu-drawer-navigation" data-drawer-placement="bottom"
                       data-drawer-target="profile-menu-drawer-navigation" type="button">
                       <svg class="h-6 w-6 text-white">
                           <use xlink:href="#menu" />
                       </svg>
                       منوی پنل کاربری
                   </button>
               </div>
           </div>
       </div>
   </div>
