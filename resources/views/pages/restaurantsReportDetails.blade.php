

@extends('layouts.header')

@section('title', 'تقرير طلبات المطاعم')
@section('content')

        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>وقت وتاريخ الطلب</th>
                                        <th>رقم الطلب</th>
                                        <th>قيمة الطلب</th>
                                        <th>رسوم التوصيل</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        {{-- <th>#</th> --}}
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
                                                {{-- <td>{{$ors=$ors+1}}</td> --}}
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