
@extends('layouts.header')

@section('title', 'العروض')
@section('content')
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>إسم المطعم</th>
                                        <th>الإيميل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>إسم المطعم</th>
                                        <th>الإيميل</th>
                                        <th>عمليات</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if (count($offers)==0)
                                        <tr>
                                            <td colspan="3" class="text-center">No Offers</td>
                                        </tr>
                                    @else
                                        @foreach ($offers as $offer)
                                            <tr>
                                                <td>{{$offer->name}}</td>
                                                <td>{{$offer->email}}</td>
                                                <td>
                                                    <button type="button" data-id="{{$offer->id}}" class="btn btn-success" data-toggle="modal" data-target="#addModal">إضافة عرض</button>
                                                    
                                                    <form action="{{url('admin/users/'.$offer->id)}}" method="POST" class="d-inline-block">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" class="btn btn-danger">{{$offer->has_offer==0 ? 'تم التعطيل': 'تعطيل مؤقت'}}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tr>
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
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة عرض توصيل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="color:red;">عروض التوصيل تقوم بخصم كامل قيمة التوصيل من المطعم ولكن تضاف للمندوب من الحساب الخاص للتطبيق</p>
                {{-- <form class="card" method="put" action="{{url('admin/offers/'.$offer->id)}}"> --}}
                <form class="card" method="post" id="userForm" action="">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <label>نسبة الخصم (نسبة مئوية)</label>
                        <input type="text" name="discount_per" class="form-control" />
                    </div>
                    <div class="col-md-12 my-4">
                        <label>تطبيق الخصم حتى تاريخ</label>
                        <input type="date" name="date_per" class="form-control" />
                    </div>
                    <hr> 
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-success">تأكيد تطبيق العرض</button>
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">إلغاء</button>
                    </div> 
                </form>    
            </div>
        </div>
    </div>

@endsection