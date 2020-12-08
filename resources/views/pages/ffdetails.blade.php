

@extends('layouts.header')

@section('title', 'تقرير مفصل للمطعم ')
@section('content')

        <div class="section-body">
            <div class="container-fluid">
                @if($restaurant_id ?? '')
                <form action="{{url('admin/restaurantsReport/'.$restaurant_id ?? '')}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row" style="margin:50px 0 50px 0; padding:20px; background-color:white;">
                        <div class="col-md-5">
                            <label>الفترة الزمنية من</label>
                            <input type="date" class="form-control" name="datefrom" />
                        </div>
                        <div class="col-md-5">
                            <label>الفترة الزمنية الى</label>
                            <input type="date" class="form-control" name="dateto" />
                        </div>
                        <input type="hidden" id="restId" name="restId" value="{{ $restaurant_id ?? '' }}"/>
                        <div class="col-md-2">
                            <label>بحث</label><br />
                            <button type="submit" class="btn btn-danger btn-block">إظهار النتائج</button>
                        </div>
                    </div>
                </form>
                @endif
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>اسم المندوب</th>
                                        <th>وقت وتاريخ الطلب</th>
                                        <th>رقم الطلب</th>
                                        <th>قيمة الطلب</th>
                                        <th>رسوم التوصيل</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                  <th>اسم المندوب</th>
                                        <th>وقت وتاريخ الطلب</th>
                                        <th>رقم الطلب</th>
                                        <th>قيمة الطلب</th>
                                        <th>رسوم التوصيل</th>                                    
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($orders)==0)
                                        <tr>
                                            <td colspan="5" class="text-center">No Orders</td>
                                        </tr>
                                    @else
                                        @foreach ($orders as $order)
                                            <tr>
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