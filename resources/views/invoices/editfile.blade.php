@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
     تعديل المرفق
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المرفقات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل المرفق</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- start Customizing The Error Messages -->
    {{-- @error('invoice_number')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('invoice_Date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Due_date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Section')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('product')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Amount_collection')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Amount_Commission')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Discount')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Rate_VAT')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Value_VAT')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('Total')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('note')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('pic')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror --}}

    {{-- OR --}}

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- end Customizing The Error Messages -->

    <!-- start redirect messages -->
    @if(Session::has('success'))
    <div class="alert-alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('error'))
    <div class="alert-alert-danger">{{Session::get('error')}}</div>
    @endif
    <!-- end redirect messages -->

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('invoicedetails.update',$attachment->id)}}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ method_field('patch') }}
                        {{csrf_field()}}
                        {{-- 1 --}}

                        <div class="row">

                            <input type="hidden" class="form-control" id="file_name" name="file_name"
                                    required value="{{$attachment->file_name}}">


                            <input type="hidden" class="form-control" id="invoice_number" name="invoice_number"
                                    required value="{{$attachment->invoice_number}}">

                            <div class="col">
                                <label for="created_by" class="control-label">قام بالاضافه</label>
                                <input type="text" class="form-control" id="created_by" name="created_by"
                                    required value="{{$attachment->Created_by}}">
                            </div>
                            <div class="col">
                                <label>تاريخ الاضافه</label>
                                <input class="form-control fc-datepicker" name="created_at" placeholder="YYYY-MM-DD"
                                    type="text"  required value="{{$attachment->created_at}}">
                            </div>
                        </div></br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">اختر مرفق</h5><br>
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>


                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

@endsection
