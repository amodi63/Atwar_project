<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if(request()->url() === route('admin.dashboard')) active @endif"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.main')}} </span>
                </a>
            </li>
            <li class="nav-item @if(request()->url() === route('index.product')) active @endif"><a href="{{route('index.product')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.products')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Product::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.users')) active @endif"><a href="{{route('index.users')}}"><i class="la la-group"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.users_dashboard')}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Admin::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.category')) active @endif"><a href="{{route('index.category')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.category')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Category::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.company')) active @endif"><a href="{{route('index.company')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.company')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Company::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.model')) active @endif"><a href="{{route('index.model')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.models')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Models::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('orders')) active @endif"><a href="{{route('orders')}}"><i class="la la-opera"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.orders')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Purchase::count()}}</span>

                </a>
            </li>

            <li class="nav-item @if(request()->url() === route('index.partner')) active @endif"><a href="{{route('index.partner')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.partners')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Partner::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.main_partner')) active @endif"><a href="{{route('index.main_partner')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.main_partners')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\MainPartner::count()}}</span>

                </a>

            </li>


            <li class="nav-item @if(request()->url() === route('index.blog')) active @endif"><a href="{{route('index.blog')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.blog')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Blog::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.service')) active @endif"><a href="{{route('index.service')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.service')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Service::count()}}</span>

                </a>

            </li>


            <li class="nav-item @if(request()->url() === route('contactus')) active @endif"><a href="{{route('contactus')}}"><i class="la la-opera"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.contacts')}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\ContactUs::count()}}</span>

                </a>
            </li>

            <li class="nav-item @if(request()->url() === route('index.sliders')) active @endif"><a href="{{route('index.sliders')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.slider')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Slider::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.about_us')) active @endif"><a href="{{route('index.about_us')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.about_us')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\AboutUs::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.news_tap')) active @endif"><a href="{{route('index.news_tap')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.news_tap')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\NewsTap::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.useful_links')) active @endif"><a href="{{route('index.useful_links')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.useful_links')}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\UsefulLink::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.social_link')) active @endif"><a href="{{route('index.social_link')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.social_link')}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\SocialLink::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.contact_information')) active @endif"><a href="{{route('index.contact_information')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.contact_information')}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\ContactInformation::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.coordinates')) active @endif"><a href="{{route('index.coordinates')}}"><i class="la la-sliders"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.coordinates')}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Coordinates::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.tax')) active @endif"><a href="{{route('index.tax')}}"><i class="la la-taxi"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.tax')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Tax::count()}}</span>

                </a>

            </li>



{{--            <li class="nav-item @if(request()->url() === route('index.coupon')) active @endif"><a href="{{route('index.coupon')}}"><i class="la la-sliders"></i><span--}}
{{--                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.coupon')}} </span>--}}
{{--                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Coupon::count()}}</span>--}}

{{--                </a>--}}

{{--            </li>--}}








        </ul>
    </div>
</div>
