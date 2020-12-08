@extends('layouts.header')

@section('title', 'تقرير مفصل للمطعم')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
                <!--<form action="{{url('admin/ff')}}" method="POST">-->
                <!--    @csrf-->
                <!--    <div class="row" style="margin:50px 0 50px 0; padding:20px; background-color:white;">-->
                <!--        <div class="col-md-5">-->
                <!--            <label>الفترة الزمنية من</label>-->
                <!--            <input type="date" class="form-control" name="datefrom" />-->
                <!--        </div>-->
                <!--        <div class="col-md-5">-->
                <!--            <label>الفترة الزمنية الى</label>-->
                <!--            <input type="date" class="form-control" name="dateto" />-->
                <!--        </div>-->
                <!--        <div class="col-md-2">-->
                <!--            <label>بحث</label><br />-->
                <!--            <button type="submit" class="btn btn-danger btn-block">إظهار النتائج</button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</form>-->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>إسم المطعم</th>
                                        <th>الإيميل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>إسم المطعم</th>
                                        <th>الإيميل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($restaurants)==0)
                                        <tr>
                                            <td colspan="4" class="text-center">No Restaurants</td>
                                        </tr>
                                    @else
                                        @foreach ($restaurants as $restaurant)
                                            <tr>
                                                <td>{{$restaurant->id}}</td>
                                                <td>{{$restaurant->name}}</td>
                                                <td>{{$restaurant->email}}</td>
                                                <td>
                                                    <a href="{{url('admin/restaurantsReport/'.$restaurant->id)}}" class="btn btn-danger"> عرض الطلبات</a>         
                                                </td>
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

         <!--Start page footer -->
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