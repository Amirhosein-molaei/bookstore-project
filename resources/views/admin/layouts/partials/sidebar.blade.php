<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <a href="{{route('admin.')}}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش محتوی</section>
            
            <a href="{{ route('admin.content.writer.index') }}" class="sidebar-link">
                <i class="fa fa-pen"></i>
                <span>نویسندگان</span>
            </a>
            
            <a href="{{route('admin.content.menu.index')}}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>منو ها  </span>
            </a>
            
            <a href="{{route('admin.content.faq.index')}}" class="sidebar-link">
                <i class="fas fa-question"></i>
                <span> سوالات متداول  </span>
            </a>
            <a href="{{route('admin.content.publisher.index')}}" class="sidebar-link">
                <i class="fas fa-pen"></i>
                <span>  ناشران  </span>
            </a>
            
            
            
            
            
            <section class="sidebar-part-title">بخش فروشگاه</section>
            
            <a href="{{route('admin.market.product-category.index')}}" class="sidebar-link">
                <i class="fas fa-shopping-bag"></i>
                <span>دسته بندی محصولات</span>
            </a>
            <a href="{{ route('admin.market.payment.index') }}" class="sidebar-link">
                <i class="fas fa-key"></i>
                <span>پرداخت ها</span>
            </a>





            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>نوشته ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">مقالات</a>
                    <a href="#">پست ها</a>
                    <a href="#">دوره ها</a>
                </section>
            </section>

            <section class="sidebar-part-title">بخش کاربران</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-users icon"></i>
                    <span>کاربران</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">ادمین</a>
                    <a href="#">مدرس ها</a>
                    <a href="#">دانشجو </a>
                </section>
            </section>

            <section class="sidebar-part-title">بخش کاربران</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-cogs icon"></i>
                    <span>تنظیمات </span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">منوی هدر</a>
                    <a href="#">منوی فوتر</a>
                    <a href="{{route('admin.setting.')}}"> تنظیمات اصلی سایت</a>

                </section>
            </section>


        </section>
    </section>
</aside>