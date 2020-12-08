
@extends('layouts.header')

@section('title', 'الدعم الفني')
@section('content')

        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                       <div class="mb-2">
                           <form class="form-inline my-3" method="post" action="{{url('admin/support')}}">
                               @csrf
                               @method('post')
                              <div class="form-group ml-2">
                                <label>رقم الطلب</label>
                                <input type="number" class="form-control mx-4" name="order">
                              </div>
                              <button type="submit" class="btn btn-primary">عرض تفاصيل الطلب</button>
                            </form>
                       </div>
                        <div class="table-responsive mb-4">
                            <table class="table table-hover table-responsive js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>الجهة</th>
                                        <th>النوع</th>
                                        <th>النص</th>
                                        <th>رقم واتساب للتواصل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>الجهة</th>
                                        <th>النوع</th>
                                        <th>النص</th>
                                        <th>رقم واتساب للتواصل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                               
                                 <tbody>
                                    @if (count($supports)==0)
                                        <tr>
                                            <td colspan="6" class="text-center">No Customer Supports</td>
                                        </tr>
                                    @else
                                        @foreach ($supports as $support)
                                            <tr>
                                                <td>{{$support->id}}</td>
                                                @if ($support->delegate_id)
                                                    <td>مندوب:: {{$support->delegate['name']}}</td>
                                                @else
                                                    <td>مطعم::{{$support->restaurant['name']}}</td>
                                                @endif
                                                <td>{{$support->type_of_problem}}</td>
                                                <td>{{$support->details}}</td>
                                                <td>{{$support->phone}}</td>
                                                
                                                 <td>
                                                    
                                                    @if($support->type_of_problem == 'العميل الغي الطلب')
                                                        <form style="display:inline-table !important;" action="{{url('admin/deleteOrder/'.$support->id)}}" method="post">
                                                            @csrf
                                                            @method('post')
                                                            <button  type="submit" class="btn btn-danger">حذف الطلب</button>
                                                        </form>
                                                    @endif
                                                    
                                                    @if($support->type_of_problem =='تاخير المندوب')
                                                        <form style="display:inline-table !important;" action="{{url('admin/delayOrder/'.$support->id)}}" method="post">
                                                            @csrf
                                                            @method('post')
                                                            <button  type="submit" class="btn btn-info">اعاده ارسال </button>
                                                        </form>
                                                    @endif
                                                    <form style="display:inline-table !important;" action="{{url('admin/activeSupport/'.$support->id)}}" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <button  type="submit" class="btn btn-secondary">{{$support->status==1 ?'مقروءة':'غيرمقروءة'}}</button>
                                                   </form>
                                                
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
                <button type="button" class="btn btn-danger">تأكيد الحذف</button>
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