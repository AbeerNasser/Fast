
@extends('layouts.header')

@section('title', 'تقريرالمدن الاكثر طلبا ')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>إسم المدينة</th>
                                        <th>عدد الطلبات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>إسم المدينة</th>
                                        <th>عدد الطلبات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->order}}</td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
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
    </div>
</div>

@endsection