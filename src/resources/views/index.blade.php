 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>@yield('title')</title>

     <!-- Global stylesheets -->
     <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
     <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('global_assets/css/icons/material/styles.min.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
     <!-- /global stylesheets -->

     <!-- Core JS files -->
     <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
     <!-- /core JS files -->

     <!-- Theme JS files -->
     <script src="{{ asset('global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
     <script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>

     <!-- Table -->

     <!-- Theme JS files -->
     <script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/demo_pages/datatables_advanced.js') }}"></script>

     <!-- Theme JS files -->
     <script src="{{ asset('global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/demo_pages/form_select2.js') }}"></script>

     <!-- /theme JS files -->

     <!-- Form input file -->
     <!-- Theme JS files -->
     <script src="{{ asset('global_assets/js/plugins/uploaders/bs_custom_file_input.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/demo_pages/form_floating_labels.js') }}"></script>
     <!-- Form input file -->

     <!-- Select Multiple -->
     <!-- Theme JS files -->
     <script src="{{ asset('global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>
     <script src="{{ asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>

     <script src="{{ asset('assets/js/app.js') }}"></script>
     <script src="{{ asset('global_assets/js/demo_pages/form_multiselect.js') }}"></script>
     <!-- Select Multiple -->

     <!-- Chart  -->
     <style>
         input[type="date"]::-webkit-calendar-picker-indicator {
             background: transparent;
             bottom: 0;
             color: transparent;
             cursor: pointer;
             height: auto;
             left: 0;
             position: absolute;
             right: 0;
             top: 0;
             width: auto;
         }

         input[type="datetime-local"]::-webkit-calendar-picker-indicator {
             background: transparent;
             bottom: 0;
             color: transparent;
             cursor: pointer;
             height: auto;
             left: 0;
             position: absolute;
             right: 0;
             top: 0;
             width: auto;
         }
     </style>


 </head>

 <body>

     <!-- Main navbar -->
     <div class="navbar navbar-expand-lg navbar-light navbar-static">

         <div class="navbar-brand text-center text-lg-left">
             <a href="/" class="d-inline-block">
                 <img src="../../../../global_assets/images/logo_light.png" class="d-none d-sm-block" alt="">
                 <img src="../../../../global_assets/images/logo_icon_light.png" class="d-sm-none" alt="">
             </a>
         </div>

         <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">

         </div>

         <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">


             <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
                 <a href="#"
                     class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100"
                     data-toggle="dropdown">
                     {{-- <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-pill"
                        height="34" alt=""> --}}
                     <span class="d-none d-lg-inline-block ml-2">
                         @auth
                             {{ optional(optional(Auth::user())->staf)->staf->name ?? 'профиль' }}
                         @endauth
                     </span>
                 </a>

                 <div class="dropdown-menu dropdown-menu-right">
                     <a href="/edit" class="dropdown-item"><i class="icon-user-plus"></i>Кабинет</a>
                     <form action="{{ route('logout') }}" method="post">
                         @csrf
                         <button type="submit" class="dropdown-item"><i class="icon-switch2"></i> Выход
                             {{ Auth::user()->name }}</button>
                     </form>
                 </div>
             </li>
         </ul>
     </div>
     <!-- /main navbar -->


     <!-- Page content -->
     <div class="page-content">

         @auth
             <!-- Main sidebar -->
             <div class="sidebar sidebar-light sidebar-main sidebar-expand-lg">

                 <!-- Sidebar content -->
                 <div class="sidebar-content">

                     <!-- User menu -->
                     <div class="sidebar-section sidebar-user my-1">
                         <div class="sidebar-section-body">
                             <div class="media">
                                 <a href="/user-list" class="mr-3">
                                     <img src="../../../../global_assets/images/placeholders/placeholder.jpg"
                                         class="rounded-circle" alt="">
                                 </a>

                                 <div class="media-body">
                                     <div class="font-weight-semibold">
                                         @auth
                                             {{-- {{ Auth::user()->name }} --}}
                                             {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                                             @foreach (Auth::user()->permissions as $item)
                                                 <li>{{ $item->name }} </li>
                                             @endforeach
                                         @endauth
                                     </div>
                                 </div>

                                 <div class="ml-3 align-self-center">
                                     <button type="button"
                                         class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                         <i class="icon-transmission"></i>
                                     </button>

                                     <button type="button"
                                         class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                                         <i class="icon-cross2"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- /user menu -->


                     <!-- Main navigation -->
                     <div class="sidebar-section">

                         <ul class="nav nav-sidebar" data-nav-type="accordion">
                             <li class="nav-item">
                                 <a href="/" class="nav-link active">
                                     <i class="icon-home4"></i>
                                     <span>
                                         Dashboard
                                     </span>
                                 </a>
                             </li>

                             @if (Auth::user()->hasPermissionTo('user.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>Пользователи</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                         @if (Auth::user()->hasPermissionTo('user.list'))
                                             {{-- <li class="nav-item"><a href="{{ route('user.list') }}"
                                                class="nav-link">Пользователи</a>
                                        </li> --}}
                                         @endif
                                         @if (Auth::user()->hasPermissionTo('role'))
                                             <li class="nav-item"><a href="{{ route('role') }}" class="nav-link">Роли
                                                     пользователей</a>
                                             </li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif

                             @if (Auth::user()->hasPermissionTo('admin'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Админ</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                         @if (Auth::user()->hasPermissionTo('admin'))
                                             <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Админ</a>
                                             </li>
                                         @endif
                                         @if (Auth::user()->hasPermissionTo('admin'))
                                             <li class="nav-item"><a href="{{ route('kassa') }}" class="nav-link">Касса</a>
                                             </li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif

                             {{-- @if (Auth::user()->hasPermissionTo('customer.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Клиенты</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                         @if (Auth::user()->hasPermissionTo('customer.list'))
                                             <li class="nav-item"><a href="{{ route('customer.list') }}"
                                                     class="nav-link">Клиенты</a></li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif --}}

                             @if (Auth::user()->hasPermissionTo('department.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>HR</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                         @if (Auth::user()->hasPermissionTo('tabel'))
                                             <li class="nav-item"><a href="{{ route('tabel') }}"
                                                     class="nav-link">Табел</a>
                                             </li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('department.list'))
                                             <li class="nav-item"><a href="{{ route('department.list') }}"
                                                     class="nav-link">Отделение</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('salarytype.list'))
                                             <li class="nav-item"><a href="{{ route('salarytype.list') }}"
                                                     class="nav-link">Типы зарплат</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('staf.list'))
                                             <li class="nav-item"><a href="{{ route('staf.list') }}"
                                                     class="nav-link">Список
                                                     сотрудниковr</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('courier.list'))
                                             <li class="nav-item"><a href="{{ route('courier.list') }}"
                                                     class="nav-link">Курьеры</a></li>
                                         @endif

                                     </ul>
                                 </li>
                             @endif

                             @if (Auth::user()->hasPermissionTo('shot.factura'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>Бухгалтер</span></a>
                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                         {{-- <li class="nav-item"><a href="{{ route('material_stoks.list') }}"
                                            class="nav-link">Material Stok</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('nakladnoy.list') }}"
                                            class="nav-link">Nakladnoy</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('prixod.list') }}"
                                            class="nav-link">Prihod /
                                            Maxsulot kirishi</a></li> --}}
                                         @if (Auth::user()->hasPermissionTo('shot.factura'))
                                             <li class="nav-item"><a href="{{ route('shot.factura') }}"
                                                     class="nav-link">
                                                     Счёт-фактура</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('salary.list'))
                                             <li class="nav-item"><a href="{{ route('salary.list') }}" class="nav-link">
                                                     Ежемесячно зарплат</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('rashod'))
                                             <li class="nav-item"><a href="{{ route('rashod') }}" class="nav-link">
                                                     Расходы</a></li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif

                             @if (Auth::user()->hasPermissionTo('material.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>Склад сырья</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                                         @if (Auth::user()->hasPermissionTo('material.list'))
                                             <li class="nav-item"><a href="{{ route('material.list') }}"
                                                     class="nav-link">Материал</a>
                                             </li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('material_stoks.list'))
                                             <li class="nav-item"><a href="{{ route('material_stoks.list') }}"
                                                     class="nav-link">Склад
                                                     сырья</a>
                                             </li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('nakladnoy.list'))
                                             <li class="nav-item"><a href="{{ route('nakladnoy.list') }}"
                                                     class="nav-link">Накладной</a>
                                             </li>
                                         @endif
                                         {{-- <li class="nav-item"><a href="{{ route('prixod.list') }}"
                                            class="nav-link">Prihod /
                                            Maxsulot kirishi</a></li> --}}
                                     </ul>
                                 </li>
                             @endif

                             {{-- @if (Auth::user()->hasRole('Stanok')) --}}
                             {{-- @endif --}}
                             @if (Auth::user()->hasPermissionTo('equipment.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>Производство продукции</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                         @if (Auth::user()->hasPermissionTo('equipment.list'))
                                             <li class="nav-item"><a href="{{ route('equipment.list') }}"
                                                     class="nav-link">Станок</a>
                                             </li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('product_model.list'))
                                             <li class="nav-item"><a href="{{ route('product_model.list') }}"
                                                     class="nav-link">Модель
                                                     продукта</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('order_app.list'))
                                             <li class="nav-item"><a href="{{ route('order_app.list') }}"
                                                     class="nav-link">Входящие
                                                     заявки</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('product_production.list'))
                                             <li class="nav-item"><a href="{{ route('product_production.list') }}"
                                                     class="nav-link">Производство продукции</a></li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif

                             @if (Auth::user()->hasPermissionTo('product_production_order.list'))
                                 <li class="nav-item nav-item">
                                     <a href="{{ route('product_production_order.list') }}" class="nav-link"><i
                                             class="icon-stack"></i><span>Заказы</span>
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->hasPermissionTo('product_stoks.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>Склад продукции</span></a>

                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                         @if (Auth::user()->hasPermissionTo('product_stoks.list'))
                                             <li class="nav-item"><a href="{{ route('product_stoks.list') }}"
                                                     class="nav-link {{ request()->routeIs('product_stoks.list') ? 'active' : '' }}">Склад
                                                     продукции</a></li>
                                         @endif

                                         @if (Auth::user()->hasPermissionTo('product_stok_value.list'))
                                             <li class="nav-item"><a href="{{ route('product_stok_value.list') }}"
                                                     class="nav-link {{ request()->routeIs('product_stok_value.list') ? 'active' : '' }}">Продукты
                                                     на склад</a></li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif

                             @if (Auth::user()->hasPermissionTo('applications.list'))
                                 <li class="nav-item nav-item-submenu">
                                     <a href="#" class="nav-link"><i class="icon-stack"></i>
                                         <span>Отдел продаж</span></a>
                                     <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                        @if (Auth::user()->hasPermissionTo('customer.list'))
                                             <li class="nav-item"><a href="{{ route('customer.list') }}"
                                                     class="nav-link">Клиенты</a></li>
                                         @endif
                                         @if (Auth::user()->hasPermissionTo('applications.list'))
                                             <li class="nav-item"><a href="{{ route('applications.list') }}"
                                                     class="nav-link">Отдел
                                                     продаж</a></li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif
                             <!-- /page kits -->

                         </ul>

                     </div>
                     <!-- /main navigation -->

                 </div>
                 <!-- /sidebar content -->

             </div>
             <!-- /main sidebar -->
         @endauth


         <!-- Main content -->
         <div class="content-wrapper">

             <!-- Inner content -->
             <div class="content-inner">

                 <!-- Page header -->

                 @yield('con')
                 <!-- /content area -->


                 <!-- Footer -->
                 <div class="navbar navbar-expand-lg navbar-light">
                     <div class="text-center d-lg-none w-100">
                         <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                             data-target="#navbar-footer">
                             <i class="icon-unfold mr-2"></i>
                             Footer
                         </button>
                     </div>

                     <div class="navbar-collapse collapse" id="navbar-footer">

                         <ul class="navbar-nav ml-lg-auto">
                             <li class="nav-item"><a href=""
                                     class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i
                                             class="icon-cart2 mr-2"></i> Purchase</span></a></li>
                         </ul>
                     </div>
                 </div>
                 <!-- /footer -->

             </div>
             <!-- /inner content -->

         </div>
         <!-- /main content -->

     </div>
     <!-- /page content -->

 </body>

 </html>
