@php
    $flag = 0;
    if(isset($delegate)) $flag=1;
@endphp
@extends('layouts.header')

@section('title', 'تقرير مفصل للمندوب ')

@section('content')
        <div class="section-body">
            <div class="container-fluid">
                @if(!$flag)
                <form  method="POST" action="{{url('admin/delegateDetailedReport')}}">
                    @csrf
                   
                    <div class="row" style="margin:50px 0 50px 0; padding:20px; background-color:white;">
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control" name="delegate_id" id="delegate">
                                    <option>-- إختر المندوب --</option>
                                    @foreach($delegates as $delegate )
                                        <option value="{{$delegate->id}}">{{$delegate->name}}</option>
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
                    <div class="col-lg-6">
                        <div class="card">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">المندوب  :  {{$delegate->name}}  </li>
                            <li class="list-group-item">رقم الهوية  :    {{$delegate->sn_no}} </li>
                            <li class="list-group-item">رقم الجوال : {{$delegate->phone}} </li>
                            <li class="list-group-item">رصيده الحالي في المحفظة  : {{$delegate->total_price}} </li>
                            @if($delegate->temp_disable ==1)
                            <li class="list-group-item">تم تعطيل مهامه مؤقتا</li>
                            @endif
                           
                          </ul>
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">عدد الطلبات التي قام بتوصيلها   :  {{count($orders)}}</li>
                            <li class="list-group-item">عدد الطلبات التي معه الان   :{{count($myOrders)}}</li>
                            
                            <li class="list-group-item">
                                المطاعم التي تعامل معها :
                                <br><br>
                                @foreach($restaurants as $restaurant )
                                
                                <p>مطعم : {{$restaurant->restaurant}} / حي:{{$restaurant->district}}</p>
                                @endforeach
                            </li>
                            
                        </ul>
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