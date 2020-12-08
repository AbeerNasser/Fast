@php
    $flag = 0;
    if(isset($user)) $flag=1;
@endphp
@extends('layouts.header')

{{--{{$flag ? ' تعديل بيانات المستخدم' : 'إضافة مستخدم جديد'}}--}}
@section('title', 'إضافة مستخدم جديد')
@section('content')

        <div class="section-body">
            <div class="container-fluid">
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
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form class="card" method="POST" action="{{$flag? url('admin/users/'.$user->id):url('admin/users')}}">
                            @if($flag)
                                @method('put')
                            @endif
                            @csrf
                            <div class="card-body">
                                <h3>{{$flag ? ' تعديل بيانات المستخدم' : 'إضافة مستخدم جديد'}} </h3>
                                <hr /><br />
                                <div class="row">

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">إسم المستخدم</label>
                                            <input type="text" class="form-control" name="name" value="{{ $flag ? $user->name : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">الرتبة</label>
                                            <select class="form-control custom-select" name="role" value="{{ $flag ? $user->role : ''}}">
                                                <option value="">إختر ....</option>
                                                @foreach($roles as $role )
                                                <option value="{{$role}}">{{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" name="email"  value="{{ $flag ? $user->email : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">الرقم السري</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">تأكيد الرقم السري</label>
                                            <input type="password" class="form-control" name="password_confirmation">
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