@extends('layouts.header')
 
@section('title', 'الدعم الفني')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                     @if (session('alert'))
                        <div class="alert alert-success">
                            {{ session('alert') }}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>إسم المطعم</th>
                                        <th>رقم جوال المطعم</th>
                                        <th>إسم المندوب</th>
                                        <th>رقم جوال المندوب</th>
                                        <th>قيمة الطلب</th>
                                        <th>موقع العميل</th>
                                        <th>رقم العميل </th>
                                        <th>وقت قبول الطلب</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>إسم المطعم</th>
                                        <th>رقم جوال المطعم</th>
                                        <th>إسم المندوب</th>
                                        <th>رقم جوال المندوب</th>
                                        <th>قيمة الطلب</th>
                                        <th>موقع العميل</th>
                                        <th>رقم العميل </th>
                                        <th>وقت قبول الطلب</th>
                                     </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>{{$supports->restaurant_name}}</td>
                                        <td>{{$supports->restaurant_phone}}</td>
                                        <td>{{$supports->delegate_name}}</td>
                                        <td>{{$supports->delegate_phone}}</td>
                                        <td>{{$supports->order_price}}</td>
                                        <td>{{$supports->address}}</td>
                                        <td>{{$supports->phone}}</td>
                                        <!--<td>{{date("Y-m-d H:i:s", $supports->date)}}</td>-->
                                       <td>{{$supports->applay_date}} </td>
                                    </tr>
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