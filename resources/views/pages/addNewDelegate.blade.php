
@php
$flag = 0;
if(isset($delegate)) $flag=1;
@endphp
@extends('layouts.header')

@section('title', 'إضافة مندوب جديد')
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
                        <form class="card" method="POST"  enctype="multipart/form-data" action="{{$flag? url('delegats/'.$delegate->id):url('delegats')}}">
                            @if($flag)
                                @method('put')
                            @endif
                            @csrf
                            <div class="card-body">
                                <h3>{{$flag ? ' تعديل بيانات المندوب' : 'إضافة مندوب جديد'}} </h3>
                                <hr /><br />
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">إسم المندوب</label>
                                            <input type="text" class="form-control" name="name" value="{{ $flag ? $delegate->name : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">رقم الهوية</label>
                                            <input type="text" class="form-control" name="sn_no" value="{{ $flag ? $delegate->sn_no : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">صورة الهوية</label>
                                            <input id="Upload" type="file" class="form-control" name="sn_img" value="{{ $flag ? $delegate->sn_img : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">رقم الجوال</label>
                                            <input type="phone" class="form-control" name="phone" value="{{ $flag ? $delegate->phone : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">الرقم السري</label>
                                            <input type="password" class="form-control" name="password" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">تأكيد الرقم السري</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label class="form-label">ملاحظات إضافية</label>
                                            <textarea rows="5" class="form-control" name="notes" value="notes">
                                                {{ $flag ? $delegate->notes : ''}}
                                            </textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">{{$flag ? 'تعديل البيانات' : 'حفظ البيانات'}} </button>
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
