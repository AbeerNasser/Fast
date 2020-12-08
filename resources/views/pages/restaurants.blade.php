@extends('layouts.otherHeader')

@section('title', 'المطاعم')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
            <a href="restaurants/create" class="btn btn-danger btn-block">إضافة مطعم جديد</a><br />
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table id="dtBasicExample" class="table table-hover js-basic-example dataTable table_custom ">
                                <thead>
                                    <tr>
                                        <th>إسم المطعم</th>
                                        <th>عنوان المطعم</th>
                                        <th>الإيميل</th>
                                        <th>رقم الجوال</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>إسم المطعم</th>
                                        <th>عنوان المطعم</th>
                                        <th>الإيميل</th>
                                        <th>رقم الجوال</th>
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
                                                <td>{{$restaurant->name}}</td>
                                                <td>{{$restaurant->district_name}},{{$restaurant->city_name}}</td>
                                                <td>{{$restaurant->email}}</td>
                                                <th>{{$restaurant->phone}}</th>
                                                <td>
                                                    <a href="{{url('restaurants/'.$restaurant->id)}}" class="btn btn-danger">عرض</a>                                   
                                                    <a href="{{url('restaurants/'.$restaurant->id.'/edit')}}" class="btn btn-secondary">تعديل</a>
                                                    <a href="{{url('showGroups/'.$restaurant->id)}}" class="btn btn-secondary"><i class="fa fa-usd"></i> مجموعات التسعير </a>
                                                    <button type="button" data-id="{{$restaurant->id}}" class="btn btn-success mt-1" data-toggle="modal" data-target="#disableModal">{{$restaurant->temp_disable==1 ? 'تم التعطيل': 'تعطيل مؤقت'}}</button>
                                                    <!--<button type="button" data-id="{{$restaurant->id}}" class="btn btn-success mt-1" data-toggle="modal" data-target="#deleteModal">حذف</button>-->
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

<!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form id="activeForm" action="" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">تأكيد</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </div>
</div> 

@endsection
