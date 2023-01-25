@extends('layouts.master')
@section('title')
    تفاصيل الفاتوره
@stop
@section('css')
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- start breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتوره</span>
            </div>
        </div>
    </div>
    <!-- end breadcrumb -->
    {{-- Start messages of error and success --}}
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
    {{-- End messages of error and success   --}}

@endsection
@section('content')
    <div class="panel panel-primary tabs-style-2">
        @error('pic')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class=" tab-menu-heading">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتوره</a></li>
                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالة الدفع</a></li>
                    <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">
                <div class="tab-pane active" id="tab4">
                    <!--Start table-->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">رقم الفاتوره</th>
                                            <th class="border-bottom-0">تاريخ الفاتوره</th>
                                            <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                            <th class="border-bottom-0">المنتج</th>
                                            <th class="border-bottom-0">القسم</th>
                                            <th class="border-bottom-0">مبلغ التحصيل</th>
                                            <th class="border-bottom-0">مبلغ العموله</th>
                                            <th class="border-bottom-0">الخصم</th>
                                            <th class="border-bottom-0">نسبة الضريبه</th>
                                            <th class="border-bottom-0">قيمة الضريبه</th>
                                            <th class="border-bottom-0">الحاله الحاليه</th>
                                            <th class="border-bottom-0">الاجمالى</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->invoice_Date }}</td>
                                            <td>{{ $invoice->Due_date }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>{{ $invoice->section->section_name }}</td>
                                            <td>{{ $invoice->Amount_collection }}</td>
                                            <td>{{ $invoice->Amount_Commission }}</td>
                                            <td>{{ $invoice->Discount }}</td>
                                            <td>{{ $invoice->Rate_VAT }}</td>
                                            <td>{{ $invoice->Value_VAT }}</td>
                                            <td>
                                                @if ($invoice->Value_Status == 1)
                                                    <p class='text-success'>{{ $invoice->Status }}</p>
                                                @elseif($invoice->Value_Status == 2)
                                                    <p class='text-danger'>{{ $invoice->Status }}</p>
                                                @else
                                                    <p class='text-warning'>{{ $invoice->Status }}</p>
                                                @endif
                                            </td>
                                            <td>{{ $invoice->Total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End table-->
                </div>
                <div class="tab-pane" id="tab5">
                    <!--Start table-->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">رقم الفاتوره</th>
                                            <th class="border-bottom-0">المنتج</th>
                                            <th class="border-bottom-0">القسم</th>
                                            <th class="border-bottom-0">حالة الدفع</th>
                                            <th class="border-bottom-0">تاريخ الدفع</th>
                                            <th class="border-bottom-0">ملاحظات</th>
                                            <th class="border-bottom-0">تاريخ الاضافه</th>
                                            <th class="border-bottom-0">المستخدم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($invoicedetails) && $invoicedetails->count() > 0)
                                            @foreach ($invoicedetails as $invoicedetail)
                                                <tr>
                                                    <td>{{ $invoicedetail->invoice_number }}</td>
                                                    <td>{{ $invoicedetail->product }}</td>
                                                    <td>{{ $invoice->section->section_name }}</td>
                                                    <td>
                                                        @if ($invoicedetail->Value_Status == 1)
                                                            <p class='text-success'>{{ $invoicedetail->Status }}</p>
                                                        @elseif($invoicedetail->Value_Status == 2)
                                                            <p class='text-danger'>{{ $invoicedetail->Status }}</p>
                                                        @else
                                                            <p class='text-warning'>{{ $invoicedetail->Status }}</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($invoicedetail->Payment_Date == null)
                                                            {{ '-----' }}
                                                        @else
                                                            {{ $invoicedetail->Payment_Date }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $invoicedetail->note }}</td>
                                                    <td>{{ $invoicedetail->created_at }}</td>
                                                    <td>{{ $invoicedetail->user }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End table-->
                </div>
                <div class="tab-pane" id="tab6">
                    {{-- اضافة مرفقات --}}
                    <div class="card-body">
                        <form method="post" action="{{ route('invoiceattachments.store')}}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"
                                    name="pic" required>

                                <input type="hidden" id="customFile" name="invoice_number"
                                    value="{{ $invoice->invoice_number }}">
                                <input type="hidden" id="invoice_id" name="invoice_id"
                                    value="{{ $invoice->id }}">
                                <label class="custom-file-label" for="customFile">حدد
                                    المرفق</label>
                            </div><br><br>
                            <button type="submit" class="btn btn-primary btn-sm "
                                name="uploadedFile">تاكيد</button>
                        </form>
                    </div>
                    <!--Start table-->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">م</th>
                                            <th class="border-bottom-0">اسم الملف</th>
                                            <th class="border-bottom-0">قام بالاضافه</th>
                                            <th class="border-bottom-0">تاريخ الاضافه</th>
                                            <th class="border-bottom-0">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($invoiceattachments) && $invoiceattachments->count() > 0)
                                            @foreach ($invoiceattachments as $invoiceattachment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $invoiceattachment->file_name }}</td>
                                                    <td>{{ $invoiceattachment->Created_by }}</td>
                                                    <td>{{ $invoiceattachment->created_at }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info"
                                                        {{-- href="{{route('viewfile',$invoice->invoice_number,$invoiceattachment->file_name)}}" دا غلط كدا ماينفعش هنضطر نكتبع يو الر ال عشان نبعد عن الروت الثنائى عشان بيبعت اتنين يعنى --}}
                                                        href="{{ url('viewfile') }}/{{ $invoice->invoice_number }}/{{ $invoiceattachment->file_name }}"
                                                        >
                                                        <i class="fas fa-eye"></i>&nbsp; عرض</a>

                                                        <a class="btn btn-sm btn-success"
                                                        href="{{ url('downloadfile') }}/{{ $invoice->invoice_number }}/{{ $invoiceattachment->file_name }}"
                                                        {{-- href="{{route('downloadfile',$invoice->invoice_number,$invoiceattachment->file_name)}}" م اشتغل معايا--}}
                                                        >
                                                        <i class="fas fa-download"></i>&nbsp;
                                                        تحميل</a>

                                                        <a class="btn btn-sm btn-danger"
                                                        href="{{route('formdelete',$invoiceattachment->id)}}"
                                                        >
                                                        <i class="fas fa-trash"></i>&nbsp;
                                                        حذف</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End table-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        src = "{{ URL::asset('http://localhost:8000/assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"
    </script>
    <script>
        src = "{{ URL::asset('http://localhost:8000/assets/js/tabs.js') }}" >
    </script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

@endsection
