@php
    $flag = 0;
    if(isset($restaurant)) $flag=1;
@endphp
@extends('layouts.header')

@section('title', 'تقرير مفصل للمطعم ')

@section('content')
        <div class="section-body">
            <div class="container-fluid">
                @if(!$flag)
                <form  method="POST" action="{{url('admin/restDetailedReport')}}">
                    @csrf
                   
                    <div class="row" style="margin:50px 0 50px 0; padding:20px; background-color:white;">
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control" name="restaurant_id" id="restaurant">
                                    <option>-- إختر المطعم --</option>
                                    @foreach($restaurants as $restaurant )
                                        <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="ajaxSubmit" class="mt-1 btn btn-danger btn-block">إظهار النتائج</button>
                        </div>
                    </div>
                </form>
                @endif
                @if($flag)
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">المطعم  :  {{$restaurant->name}}  </li>
                            <li class="list-group-item">البريد الالكتروني :    {{$restaurant->email}} </li>
                            <li class="list-group-item">رقم الجوال : {{$restaurant->phone}} </li>
                            <li class="list-group-item">الحي  : {{$restaurant->district}} </li>
                           
                          </ul>
                        </div>
                        <div class="card">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">عدد الطلبات لهذا المطعم  :  {{count($allOrders)}}</li>
                            <li class="list-group-item">عدد الطلبات التي تم توصيلها للعميل   :{{count($orders)}}</li>
                            <li class="list-group-item">عدد الطلبات التي تم خروجها من المطعم مع المناديب  :{{count($ord)}}</li>
                            
                          </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @foreach($groups as $group )
                        <div class="card">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item"> مجموعات المطعم  : {{$group->name}} </li>
                            <li class="list-group-item"> سعر التوصيل بالمجموعة  :{{$group->price}}</li>
                            <li class="list-group-item">االحي التابع له المجموعة  :{{$group->district}}</li>
                            
                          </ul>
                        </div>
                        @endforeach
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