   <!-- Desktop sidebar -->
   <div
                class="sticky top-32 hidden w-full overflow-hidden rounded-lg bg-muted shadow-base lg:block"
              >
                <div
                  dir="ltr"
                  class="max-h-[calc(90vh_-_100px)] overflow-y-auto p-4 xl:p-6"
                >
                  <div dir="rtl">
                    <!-- Head -->
                    <div
                      class="mb-2 flex items-center justify-between border-b pb-6 dark:border-white/10"
                    >
                      <div class="flex items-center gap-x-4">
                        <div>
                          <img
                            src="./assets/images/user.png"
                            class="h-12 w-12 rounded-full"
                            alt=""
                          />
                        </div>
                        <div class="flex flex-col">
                          <div class="line-clamp-1">تایماز اکبری</div>
                          <div class="line-clamp-1 text-text/90">
                            09000000000
                          </div>
                        </div>
                      </div>
                      <a href="./profile-edit.html">
                        <svg class="h-6 w-6 text-primary">
                          <use xlink:href="#edit" />
                        </svg>
                      </a>
                    </div>

                    <ul class="space-y-1">
                      <li>
                        <a
                          href="./profile-dashboard.html"
                          class="profile-menu profile-menu-active flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#home" />
                            </svg>
                            <div>پیشخوان</div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a
                          href="./profile-orders.html"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#order" />
                            </svg>
                            <div>سفارش ها</div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a
                          href="{{ route('user-profile.favorit-writers') }}"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#heart" />
                            </svg>
                            <div> نویسنده های مورد علاقه</div>
                          </div>
                        </a>
                      </li>

                      <li>
                        <a
                          href="{{route('user-profile.ticket')}}"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#notification" />
                            </svg>
                            <div> تیکت ها</div>
                          </div>
                        </a>
                      </li>


                      <li>
                        <a
                          href="./profile-recent.html"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#recent" />
                            </svg>
                            <div>بازدید های اخیر</div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a
                          href="./profile-notification.html"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#notification" />
                            </svg>
                            <div>پیام ها</div>
                          </div>
                          <div
                            class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary text-sm font-bold text-white dark:bg-emerald-600"
                          >
                            10
                          </div>
                        </a>
                      </li>
                      <li>
                        <a
                          href="./profile-address.html"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#address" />
                            </svg>
                            <div>آدرس ها</div>
                          </div>
                        </a>
                      </li>

                      <li>
                        <a
                          href="./profile-edit.html"
                          class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4"
                        >
                          <div class="flex items-center gap-x-4">
                            <svg class="h-6 w-6">
                              <use xlink:href="#user-setting" />
                            </svg>
                            <div>اطلاعات حساب کاربری</div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a
                          class="flex items-center justify-between rounded-lg p-4 text-red-500 hover:bg-warning/10 dark:text-red-400 dark:hover:bg-red-400/10"
                          href="#"
                        >
                          <div class="flex items-center gap-x-2">
                            <svg class="h-6 w-6">
                              <use xlink:href="#exit"></use>
                            </svg>
                            <span> خروج </span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>