<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="author" content="Sedra Technology">

        <title> @yield('title')</title>
        <link rel="icon" href="{!! asset('favicon.ico') !!}"/>
        
        <!-- Bootstrap Core and vandor -->
        <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" />

        <!-- Plugins css -->
        <link rel="stylesheet" href="{{asset('assets/plugins/charts-c3/c3.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/plugins/jvectormap/jvectormap-2.0.3.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
        <style>
            td.details-control 
            {
                background: url('{{asset('assets/images/details_open.png')}}') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control 
            {
                background: url('{{asset('assets/images/details_close.png')}}') no-repeat center center;
            }
        </style>
        <!-- Core  css -->
        <link rel="stylesheet" href="{{asset('assets/css/main.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/theme1.css')}}" id="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    </head>

    <body class="font-opensans iconcolor rtl">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
            </div>
        </div>

        <!-- Start main html -->
        <div id="main_content">

            <!-- Small icon top menu -->
            <div id="header_top" class="header_top">
                <div class="container">
                    <div class="hleft">
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="{{asset('assets/images/user.png')}}" alt=""/></a>
                            <a href="{{url('admin/home')}}" class="nav-link icon"><i class="fa fa-home"></i></a>
                            <a href="{{url('admin/users')}}"  class="nav-link icon app_inbox"><i class="fa fa-users"></i></a>
                            <a href="{{url('admin/orders')}}"  class="nav-link icon xs-hide"><i class="fa fa-shopping-cart"></i></a>
                            <a href="{{url('restaurants')}}"  class="nav-link icon app_file xs-hide"><i class="fa fa-university"></i></a>
                        </div>
                    </div>
                    <div class="hright">
                        <div class="dropdown">
                            <a href="{{url('admin/reports')}}" class="nav-link icon settingbar"><i class="fa fa-file"></i></a>
                            <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-navicon"></i></a>
                        </div>            
                    </div>
                </div>
            </div>

            <!-- start User detail -->
            <div class="user_div">
                <h5 class="brand-name mb-4">
                    {{ Auth::user()->name }}
                    <a href="javascript:void(0)" class="user_btn">
                        <i class="icon-close"></i>
                    </a>
                </h5>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">بيانات {{ Auth::user()->name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ Auth::user()->email }}</li>
                        <li class="list-group-item">{{ Auth::user()->role }}</li>
                    </ul>
                </div>
            </div>

            <!-- start Main menu -->
            <div id="left-sidebar" class="sidebar">
                <div class="d-flex justify-content-between brand_name">
                    <h5 class="brand-name">التوصيل الأسرع</h5>
                    <div class="theme_btn">
                        <a class="theme1" data-toggle="tooltip" title="التصميم الأحمر" href="#" onclick="setStyleSheet('../assets/css/theme1.css', 0);"></a>
                        <a class="theme2" data-toggle="tooltip" title="التصميم الأخضر" href="#" onclick="setStyleSheet('../assets/css/theme2.css', 0);"></a>
                        <a class="theme3" data-toggle="tooltip" title="التصميم الأزرق" href="#" onclick="setStyleSheet('../assets/css/theme3.css', 0);"></a>
                        <a class="theme4" data-toggle="tooltip" title="التصميم الرمادي" href="#" onclick="setStyleSheet('../assets/css/theme4.css', 0);"></a>
                    </div>
                </div>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
                <ul class="nav nav-tabs b-none">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all-tab"> الروابط </a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting-tab">المظهر </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="all-tab">
                        <nav class="sidebar-nav">
                            <ul class="metismenu ci-effect-1">
                                <li class="g_heading">رئيسية النظام</li>
                                <li class="active">
                                    <a href="{{url('admin/home')}}"><i class="fa fa-home"></i>
                                        <span data-hover="الصفحة الرئيسية">الصفحة الرئيسية</span>
                                    </a>
                                </li>

                                <li class="g_heading">أساسيات النظام</li>
                                <li>
                                    <a href="{{url('restaurants')}}">
                                        <i class="fa fa-university"></i>
                                        <span data-hover="المطاعم">المطاعم</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('delegats')}}">
                                        <i class="fa fa-male"></i>
                                        <span data-hover="المناديب">المناديب</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('admin/cities')}}">
                                        <i class="fa fa-map"></i>
                                        <span data-hover="المدن">المدن</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('admin/districts')}}">
                                        <i class="fa fa-map-marker"></i>
                                        <span data-hover="الأحياء">الأحياء</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('admin/users')}}">
                                        <i class="fa fa-users"></i>
                                        <span data-hover="المستخدمين">المستخدمين</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('admin/offers')}}">
                                        <i class="fa fa-gift"></i>
                                        <span data-hover="العروض">العروض</span>
                                    </a>
                                </li>
                    
                                <li class="g_heading">الإدارة والتقارير</li>
                                <li>
                                    <a href="{{url('admin/support')}}">
                                        <i class="fa fa-support"></i>
                                        <span data-hover="الدعم الفني">الدعم الفني</span>
                                    </a>
                                </li>
                                <li>
                                <a href="{{url('admin/reports')}}">
                                    <i class="fa fa-file"></i>
                                    <span data-hover="التقارير">التقارير</span>
                                </a>
                                </li>
                                <li>
                                    <a href="{{url('admin/settings')}}">
                                        <i class="fa fa-cogs"></i>
                                        <span data-hover="الإعدادات">الإعدادات</span>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    </div>

                    <div class="tab-pane fade" id="setting-tab">
                        <div class="mb-4 mt-3">
                            <h6 class="font-14 font-weight-bold text-muted">نوع الخط</h6>
                            <div class="custom-controls-stacked font_setting">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font" value="font-opensans" checked="">
                                    <span class="custom-control-label">الخط الرئيسي</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font" value="font-poppins">
                                    <span class="custom-control-label">خط بوبينس</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="font-14 font-weight-bold text-muted">أيقونة القائمة المنسدلة</h6>
                            <div class="custom-controls-stacked arrow_option">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="marrow" value="arrow-a" checked="">
                                    <span class="custom-control-label">1</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                                    <span class="custom-control-label">2</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="marrow" value="arrow-c">
                                    <span class="custom-control-label">3</span>
                                </label>
                            </div>
                            <h6 class="font-14 font-weight-bold mt-4 text-muted">أيقونة القائمة الفرعية</h6>
                            <div class="custom-controls-stacked list_option">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                                    <span class="custom-control-label">1</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                                    <span class="custom-control-label">2</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                                    <span class="custom-control-label">3</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-14 font-weight-bold mt-4 text-muted">إعدادات المظهر الرئيسية</h6>
                            <ul class="setting-list list-unstyled mt-1 setting_switch">
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">الوضع الليلي</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">تثبيت الجزء العلوي</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">تعتيم الجزء العلوي</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">تعتيم القائمة الجانبية الفرعية</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">تعتيم القائمة الجانبية الأساسية</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">تلويين الأيقونات</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor" checked="">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">تدريج الألوان</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">ظل للأزرار</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">التنسيق العربي</span>
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl" checked="">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start main body part-->
            <div class="page">

                <!-- start body header -->
                <div id="page_top" class="section-body">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="left">
                                <h1 class="page-title"> تطبيق | Faster Delivery - التوصيل الأسرع</h1>
                            </div>
                            <div class="right">
                                <div class="notification d-flex">
                                    <a href="{{url('admin/support')}}" class="btn btn-facebook">
                                        <i class="fa fa-info-circle mr-2"></i>الدعم الفني
                                    </a>

                                    <a type="button" class="btn btn-facebook" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off mr-2"></i>تسجيل الخروج
                                    </a>
        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- jQuery and bootstrtap js -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
 
        <script src="{{asset('assets/bundles/lib.vendor.bundle.js')}}"></script>

        <!-- start plugin js file  -->
        <script src="{{asset('assets/bundles/apexcharts.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/counterup.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/knobjs.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/flot.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/jvectormap1.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/selectize.bundle.js')}}"></script>
        <script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script>

        <!-- Start core js and page js -->
        <script src="{{asset('assets/js/core.js')}}"></script>
        <script src="{{asset('assets/js/page/index.js')}}"></script>
        <script src="{{asset('assets/js/vendors/selectize.js')}}"></script>
        <script src="{{asset('assets/js/table/datatable.js')}}"></script>


        {{-- restaurants --}}
            <script type="text/javascript">
                $('#deleteModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    $('#deleteForm').attr("action", "{{url('restaurants')}}" + "/" + id);
                });
            </script>
            <script type="text/javascript">
                $('#disableModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    $('#activeForm').attr("action", "{{url('activeRest')}}" + "/" + id);
                });
            </script>
        
        {{--add new price group --}}
            <script type="text/javascript">
                $('#addModalGroup').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    $('#addForm').attr("action", "{{url('storeGroup')}}" + "/" + id);
                });
            </script>
            <script type="text/javascript">
                $('#deleteModalPrice').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    $('#deleteGroup').attr("action", "{{url('PricingGroup')}}" + "/" + id);
                });
            </script>
  
        {{-- delegates --}}
            <script type="text/javascript">
                $('#disableAdmindelegate').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    $('#activeDelegate').attr("action", "{{url('activeDelegate')}}" + "/" + id);
                });
            </script>
            
        <!--search-->
            <script>
                $(document).ready(function(){
                  $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
            </script>
            
            <script>
                $(document).ready(function () {
                $('#dtBasicExample').DataTable();
                $('.dataTables_length').addClass('bs-select');
                });
            </script>
    </body>
</html>
