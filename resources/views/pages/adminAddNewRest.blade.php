@php
    $flag = 0;
    if(isset($restaurant)) $flag=1;
@endphp
@extends('layouts.header')

@section('title','إضافة مطعم جديد')
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
                        <form class="card" method="POST" action="{{$flag? url('admin/restaurants/'.$restaurant->id):url('admin/restaurants')}}">
                            @if($flag)
                                @method('put')
                            @endif
                            @csrf
                            <div class="card-body">
                                <h3>{{$flag ? ' تعديل بيانات المطعم' : 'إضافة مطعم جديد'}} </h3>
                                <hr /><br />
                                <div class="row">

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">إسم المطعم</label>
                                            <input type="text" class="form-control" name="name" value="{{ $flag ? $restaurant->name : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">عنوان المطعم</label>
                                            <select class="form-control custom-select" name="address">
                                                <option value="">إختر ....</option>
                                                @foreach($districts as $district )
                                                    <option value="{{$district->id}}">{{$district->name}},{{$district->city['name']}}</option>
                                                @endforeach
                                                {{-- @foreach($districts as $district)
                                                    @if($district->id == $restaurant->email)
                                                        <option selected value="{{$district->id}}">{{$district->name}},{{$district->city['name']}}</option>
                                                    @else
                                                        <option value="{{$district->id}}">{{$district->name}},{{$district->city['name']}}</option>
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" name="email"  value="{{ $flag ? $restaurant->email : ''}}">
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
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">جوال المطعم</label>
                                            <input type="text" class="form-control" name="phone"  value="{{ $flag ? $restaurant->phone : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label">عنوان المتجر</label>
                                            <textarea rows="5" class="form-control" name="notes" value="notes">
                                                {{ $flag ? $restaurant->notes : ''}}
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


        <script>
            var str = "How are you doing today?";
            var res = str.split(" ");
        </script>
@endsection