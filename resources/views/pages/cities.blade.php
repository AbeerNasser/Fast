@extends('layouts.header')

@section('title', 'المدن')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
            <a href="cities/create" class="btn btn-danger btn-block">إضافة مدينة جديدة</a><br />
                <div class="row clearfix">
                    <div class="col-lg-12"> 
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المدينة</th>
                                        {{-- <th>الجروب</th> --}}
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>المدينة</th>
                                        {{-- <th>الجروب</th> --}}
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($cities)==0)
                                        <tr>
                                            <td colspan="3" class="text-center">No Cities</td>
                                        </tr>
                                    @else
                                        @foreach ($cities as $city)
                                            <tr>
                                                <td>{{$city->id}}</td>
                                                <td>{{$city->name}}</td>
                                                {{-- <td>{{$city->group['name']}}</td> --}}
                                                <td>                                 
                                                    <a href="{{url('admin/cities/'.$city->id.'/edit')}}" class="btn btn-secondary">تعديل</a>
                                                    <button type="button" data-id="{{$city->id}}" class="btn btn-success" data-toggle="modal" data-target="#deleteModalcity">حذف</button>
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

<!-- Modal -->
    <div class="modal fade" id="deleteModalcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف عنصر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف هذا العنصر ؟</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </div>
</div>   

<!-- Disable Modal -->
    <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعطيل مؤقت</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من تعطيل هذا المطعم ؟</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">تأكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </div>
</div> 

@endsection
