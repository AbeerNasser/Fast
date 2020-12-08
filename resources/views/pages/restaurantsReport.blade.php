@php
    $flag = 0;
    if(isset($orders)) $flag=1;
@endphp
@extends('layouts.header')

@section('title', 'تقرير طلبات المطاعم')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
                @if(!$flag)
                <form  method="POST" action="{{url('admin/restsReport')}}">
                    @csrf
                   
                    <div class="row" style="margin:50px 0 50px 0; padding:20px; background-color:white;">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                <label>الفترة الزمنية من</label>
                                <input type="date" class="form-control" name="datefrom" />
                            </div>
                            <div class="col-md-6">
                                <label>الفترة الزمنية الى</label>
                                <input type="date" class="form-control" name="dateto" />
                            </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="submit" class="mt-1 btn btn-danger btn-block">عرض الطلبات</button>
                        </div>
                    </div>
                </form>
                @endif
                @if($flag)
                <div class="row clearfix">
                     <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>اسم المطعم</th>
                                        <th>اسم المندوب</th>
                                        <th>وقت وتاريخ الطلب</th>
                                        <th>رقم الطلب</th>
                                        <th>قيمة الطلب</th>
                                        <th>رسوم التوصيل</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>اسم المطعم</th >
                                        <th>اسم المندوب</th >
                                        <th>وقت وتاريخ الطلب</th>
                                        <th>رقم الطلب</th>
                                        <th>قيمة الطلب</th>
                                        <th>رسوم التوصيل</th>                                    
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($orders)==0)
                                        <tr>
                                            <td colspan="6" class="text-center">No Orders</td>
                                        </tr>
                                    @else
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order->restaurant['name']}}</td>
                                                <td>{{$order->delegate['name']}}</td>
                                                <td>{{$order->created_at}}</td>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->order_price}}</td>
                                                <td>{{$order->p}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>             
                </div>
                @endif
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