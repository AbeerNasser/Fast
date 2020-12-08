@extends('layouts.header')

@section('title', 'تقرير مفصل للمندوب ')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>إسم  المندوب</th>
                                        <th>رقم الجوال</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>إسم المندوب</th>
                                        <th>رقم الجوال</th>
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($delegates)==0)
                                        <tr>
                                            <td colspan="4" class="text-center">No Delegates</td>
                                        </tr>
                                    @else
                                        @foreach ($delegates as $delegate)
                                            <tr>
                                                <td>{{$delegate->id}}</td>
                                                <td>{{$delegate->name}}</td>
                                                <td>{{$delegate->phone}}</td>
                                                <td>
                                                    <a href="{{url('admin/delegatsReport/'.$delegate->id)}}" class="btn btn-danger"> عرض الطلبات</a>         
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