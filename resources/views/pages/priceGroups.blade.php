@extends('layouts.header')

@section('title', 'مجموعات التسعير')
@section('content')

        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>إسم المجموعة</th>
                                        <th>المدينة</th>
                                        <th>الأحياء</th>
                                        <th>سعر التوصيل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>إسم المجموعة</th>
                                        <th>المدينة</th>
                                        <th>الأحياء</th>
                                        <th>سعر التوصيل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                     @if (count($groups)==0)
                                        <tr>
                                            <td colspan="5" class="text-center">No Groups</td>
                                        </tr>
                                    @else
                                        @foreach ($groups as $group)
                                            <tr>
                                                <td>{{$group->name}}</td>
                                                <td>{{$group->city_name}}</td>
                                                <td>{{$group->district_name}}</td>
                                                <th>{{$group->price}}</th>
                                                <td>
                                                    <button type="button" data-id="{{$group->id}}" class="btn btn-success" data-toggle="modal" data-target="#disableModalGroup">{{$group->status==1 ? 'تم التعطيل': 'تعطيل مؤقت'}}</button>
                                                    <button type="button" data-id="{{$group->cell_id}}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalGroup">حذف</button>
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
    <div class="modal fade" id="deleteModalGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form id="deleteGroup" action="" method="post">
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
    <div class="modal fade" id="disableModalGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعطيل مؤقت</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من تعطيل هذه المجموعة ؟</p>
            </div>
            <div class="modal-footer">
                <form id="activeGroup" action="" method="POST">
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
