@php
    $flag = 0;
    if(isset($orders)) $flag=1;
@endphp
@extends('layouts.header')

@section('title','طلبات الحي')

@section('content')
        <div class="section-body">
            <div class="container-fluid">
                @if(!$flag)
                <form  method="POST" action="{{url('admin/destrictOrdersReport')}}">
                    @csrf
                   
                    <div class="row" style="margin:50px 0 50px 0; padding:20px; background-color:white;">
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control" name="district_id" id="district">
                                    <option>-- إختر الحي --</option>
                                    @foreach($districts as $district )
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="mt-1 btn btn-danger btn-block">إظهار النتائج</button>
                        </div>
                    </div>
                </form>
                @endif
                @if($flag)
                <div class="row clearfix">
                    @foreach($orders as $order )
                        <div class="col-lg-6">
                            
                            <div class="card">
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item">المطعم  :  {{$order->restaurant}}  </li>
                                <li class="list-group-item">قيمة الطلب   :  {{$order->order_price}}  </li>
                                <li class="list-group-item">القيمة الكليه باضافة رسوم التوصيل  :  {{$order->total_price}}  </li>
                                <li class="list-group-item">  رقم جوال العميل : {{$order->phone}} </li>
                                <li class="list-group-item">طريقة الدفع  : {{$order->payment_way}} </li>
                                
                                <li class="list-group-item">   تم طلب هذا الطلب في الوقت  : {{$order->created_at}} </li>
                                @if($order->order_status ==0)
                                <li class="list-group-item">مازال الطلب بالمطعم </li>
                                @elseif($order->order_status ==1)
                                <li class="list-group-item">تم اخذ الطلب لمندوب </li>
                                <li class="list-group-item">المندوب  :  {{$order->delegate}}  </li>
                                 @else
                                <li class="list-group-item">تم تسليم الطلب للعميل </li>
                                <li class="list-group-item">المندوب  :  {{$order->delegate}}  </li>
                                @endif
                              </ul>
                            </div>
                           
                        </div>
                    @endforeach
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