@php
    $flag = 0;
    if(isset($district)) $flag=1;
@endphp
@extends('layouts.header')

@section('title', 'إضافة حي جديد')
@section('content')

        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    @if (Session::has('success'))
                        {{Session::get('success')}}
                        @php
                            Session::forget('success');
                        @endphp
                    @endif
                    @if (count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                <li>{{$err}}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="col-md-12 col-lg-12">
                        <form class="card" method="POST" action="{{$flag? url('admin/districts/'.$district->id):url('admin/districts')}}">
                            @if($flag)
                                @method('put')
                            @endif
                            @csrf
                            <div class="card-body">
                                <h3>{{$flag ? ' تعديل بيانات الحي' : 'إضافة حي جديد'}} </h3>
                                <hr /><br />
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">المدينة</label>
                                            <select class="form-control custom-select" name="city" value="{{ $flag ? $district->city : ''}}">
                                            <option value="">إختر ....</option>
                                                @foreach($cities as $city )
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">إسم الحي</label>
                                            <input type="text" class="form-control" name="name" value="{{ $flag ? $district->name : ''}}">
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">{{$flag ? 'تعديل البيانات' : 'حفظ البيانات'}}</button>
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
    

@endsection