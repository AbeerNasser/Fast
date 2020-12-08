@php
    $flag = 0;
    if(isset($city)) $flag=1;
@endphp
@extends('layouts.header')

@section('title', 'إضافة مدينة جديدة')
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
                        <form class="card" method="POST" action="{{$flag? url('admin/cities/'.$city->id):url('admin/cities')}}">
                            @if($flag)
                                @method('put')
                            @endif
                            @csrf
                            <div class="card-body">
                                <h3>{{$flag ? 'تعديل بيانات المدينة' : 'إضافة مدينه جديدة'}} </h3>
                                <hr /><br />
                                
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">الجروب</label>
                                            <select class="form-control custom-select" name="group" value="{{ $flag ? $city->group : ''}}">
                                                <option value="">إختر ....</option>
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">إسم المدينة</label>
                                            <input type="text" class="form-control" name="name" value="{{ $flag ? $city->name : ''}}">
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
