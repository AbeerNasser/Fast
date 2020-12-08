

@extends('layouts.header')

@section('title', 'التقارير')
@section('content')

      <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form class="card">
                            <div class="card-body">
                                <h3>تقارير المطاعم</h3>
                                <hr /><br />
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <!--<a href="{{url('admin/restaurantsReport')}}">-->
                                            <a href="{{url('admin/restsReport')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-shopping-cart" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> طلبات المطاعم</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <!--<a href="{{url('admin/restDetailedReport')}}">-->
                                                                                    <a href="{{url('admin/restaurantsReport')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-university" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> تقرير مفصل للمطعم</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <a href="{{url('admin/bestSellingRestaurant')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-sort-amount-desc" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> المطاعم الأكثر مبيعاً</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form class="card">
                            <div class="card-body">
                                <h3>تقارير المناديب</h3>
                                <hr /><br />
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <!--<a href="{{url('admin/delegatsReport')}}">-->
                                            <a href="{{url('admin/delgReport')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-shopping-cart" style="font-size:25px; margin-bottom:20px;"></i>
                                                <i class="fa fa-male" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> توصيلات المناديب</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <!--<a href="{{url('admin/delegateDetailedReport')}}">-->
                                            <a href="{{url('admin/delegatsReport')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-male" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> تقرير مفصل للمندوب</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <a href="{{url('admin/agentsInteract')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-sort-amount-desc" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> المناديب الأكثر فاعلية</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form class="card">
                            <div class="card-body">
                                <h3>تقارير المدن والأحياء</h3>
                                <hr /><br />
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <a href="{{url('admin/cityOrdersReport')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-shopping-cart" style="font-size:25px; margin-bottom:20px;"></i>
                                                <i class="fa fa-map" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> طلبات المدينة</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <a href="{{url('admin/destrictOrdersReport')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-shopping-cart" style="font-size:25px; margin-bottom:20px;"></i>
                                                <i class="fa fa-map-marker" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> طلبات الحي</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <a href="{{url('admin/requestedCities')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-sort-amount-desc" style="font-size:25px; margin-bottom:20px;"></i>
                                                <i class="fa fa-map" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> المدن الأكثر طلباً</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <a href="{{url('admin/requestedDistricts')}}">
                                            <div style="background-color:#e21e32; padding:20px; text-align:center; color:white; border-radius:50px;">
                                                <i class="fa fa-sort-amount-desc" style="font-size:25px; margin-bottom:20px;"></i>
                                                <i class="fa fa-map-marker" style="font-size:25px; margin-bottom:20px;"></i>
                                                <p> الأحياء الأكثر طلباً</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start page footer -->
        <div class="section-body">
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            جميع الحقوق محفوظة © 2020 تطبيق التوصيل الأسرع, تطوير  <a href="https://sedrait.com" target="_blank">شركة سِدره للبرمجيات</a>.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

@endsection