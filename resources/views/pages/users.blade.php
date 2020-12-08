@extends('layouts.header')

    @section('title', 'المستخدمين')
    @section('content')

        <div class="section-body">
            <div class="container-fluid">
            <a href="users/create" class="btn btn-danger btn-block">إضافة مستخدم جديد</a><br />
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>إسم المستخدم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الرتبة</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>إسم المستخدم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الرتبة</th>
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($users)==0)
                                        <tr>
                                            <td colspan="4" class="text-center">No Users</td>
                                        </tr>
                                    @else
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->role}}</td>
                                                <td>
                                                    <a href="{{url('admin/users/'.$user->id)}}" class="btn btn-danger">عرض</a>                                   
                                                    <a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-secondary">تعديل</a>
                                                    <!--{{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#disableModal">تعطيل مؤقت</button>-->
                                                    <!--<form action="{{url('admin/users/'.$user->id)}}" method="POST" class="d-inline-block">-->
                                                    <!--    @method('delete')-->
                                                    <!--    @csrf-->
                                                    <!--    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#deleteModal">حذف</button>-->
                                                    <!--</form> --}}-->

                                                    <button type="button" data-id="{{$user->id}}" class="btn btn-success" data-toggle="modal" data-target="#disableModaluser">{{$user->status==1 ? 'تم التعطيل': 'تعطيل مؤقت'}}</button>
                                                    <button type="button" data-id="{{$user->id}}" class="btn btn-success" data-toggle="modal" data-target="#deleteModaluser">حذف</button>
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
    <div class="modal fade" id="deleteModaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="disableModaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعطيل مؤقت</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من تعطيل هذا المستخدم ؟</p>
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