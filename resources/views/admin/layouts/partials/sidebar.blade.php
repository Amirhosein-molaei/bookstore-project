<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <a href="{{route('admin.')}}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش فروشگاه</section>

            <a href="{{ route('admin.market.product-category.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>دسته ها</span>
            </a>


            <section class="sidebar-part-title">بخش محتوی</section>

            <a href="{{route('admin.content.menu.index')}}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>منو ها </span>
            </a>
            <a href="{{route('admin.content.faq.index')}}" class="sidebar-link">
                <i class="fas fa-question"></i>
                <span> سوالات متداول </span>
            </a>





        </section>
        <section class="sidebar-part-title">بخش تنظیمات</section>

        <section class="sidebar-group-link">
            <section class="sidebar-dropdown-toggle">
                <i class="fas fa-cogs icon"></i>
                <span>تنظیمات سایت</span>
                <i class="fas fa-angle-left angle"></i>
            </section>
            <section class="sidebar-dropdown">
                <a href="{{ route('admin.setting.') }}">تنظیمات اصلی</a>
            </section>
        </section>
    </section>
</aside>