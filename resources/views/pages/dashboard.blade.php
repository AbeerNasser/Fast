@extends('layouts.header')

@section('title', 'الصفحة الرئيسية')
@section('content')

            <div class="section-body mt-3">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <h2>رئيسية لوحة تحكم النظام</h2>                            
                                <small>الصفحة الرئيسية للوحة تحكم نظام تطبيق Faster Delivery</small>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body ribbon">
                                    <div class="ribbon-box green counter">{{count($restaurants)}}</div>
                                    <a href="{{url('admin/restaurants')}}" class="my_sort_cut text-muted">
                                        <i class="icon-rocket"></i>
                                        <span>المطاعم</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body ribbon">
                                    <div class="ribbon-box green counter">{{count($delegates)}}</div>
                                    <a href="{{url('admin/delegats')}}" class="my_sort_cut text-muted">
                                        <i class="icon-users"></i>
                                        <span>المناديب</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body ribbon">
                                    <div class="ribbon-box green counter">{{count($cities)}}</div>
                                    <a href="{{url('admin/cities')}}" class="my_sort_cut text-muted">
                                        <i class="icon-map"></i>
                                        <span>المدن</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body ribbon">
                                    <div class="ribbon-box green counter">{{count($districts)}}</div>
                                    <a href="{{url('admin/districts')}}" class="my_sort_cut text-muted">
                                        <i class="icon-globe"></i>
                                        <span>الأحياء</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body ribbon">
                                    <div class="ribbon-box green counter">{{count($groups)}}</div>
                                    <a href="{{url('admin/groups')}}" class="my_sort_cut text-muted">
                                        <i class="icon-layers"></i>
                                        <span>المجموعات</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body ribbon">
                                    <div class="ribbon-box green counter">{{count($users)}}</div>
                                    <a href="{{url('admin/users')}}" class="my_sort_cut text-muted">
                                        <i class="icon-user"></i>
                                        <span>المستخدمين</span>
                                    </a>
                                </div>
                            </div>
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
           
@endsection
