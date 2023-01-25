@extends('layouts.master')
@section('title')
    الأقسام
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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الأقسام</span>
            </div>
        </div>
    </div>
    <!-- end breadcrumb -->
@endsection
@section('content')
    <!-- start table -->
    <div class='row'>
        <div class="col-xl-12">
            <div class='messages'>

                <!-- redirect messages -->
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <!-- Displaying The Validation Errors default laravel messages-->
                {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                @endif --}}

                <!-- Customizing The Error Messages -->
                @error('section_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="btn btn-sm btn-primary" data-effect="effect-scale"
                            href="{{ route('test.create') }}"> <i class="fas fa-plus"></i>&nbsp; اضافة قسم </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">اسم القسم</th>
                                    <th class="wd-20p border-bottom-0">الوصف</th>
                                    <th class="wd-15p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($sections) && $sections->count() > 0)
                                @foreach ($sections as $section)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$section->name}}</td>
                                    <td>{{$section->description}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" data-effect="effect-scale" href="{{route('test.edit',$section->id)}}"
                                            title="تعديل"><i class="las la-pen"></i></a>




                                            {{-- من الاخر افضل شئ لما تيجى تعمل ديليت مش هينفع تعملها كدا اللى هى تيست  دوت ديستروى طب ليه لان هذه الفنكشن ديستروى الريسورس مش هتسمحلك انك تدخلها الا عن طريق فورم فعندك تلت طرق الاولى راوت خارجى ثم فنكشن خارجيه  وفيها الديليت مباشرة الطريقه الثانيه راوت خارجى ثم فنكشن استغلاليه اسمها ديستروى يبقا كدا انا استغليت فنكشن الريسورس الطريقه الثالثه راوت خارجى ثم فانكشن خارجيه هذه الفانكشن هتروح تجيبلك فورم ثم من الفورم تستطيع ان تستغل الفنكشن ديسترو  ريسورس اما انا افضل الطريقه الثانيه الا وهى راوت خارجى + فنكشن استغلاليه بنفس اسم فنكشن الديستروى ريسورس  تمام    --}}
                                            <a class="btn btn-sm btn-danger" data-effect="effect-scale" href="{{route('formdelete',$section->id)}}" title="حذف"><i class="las la-trash"></i></a>
                                            {{-- <a class="btn btn-sm btn-danger" data-effect="effect-scale" href="{{route('test.destroy',$section->id)}}" title="حذف"><i class="las la-trash"></i></a>//ممكن تعمل كدا عادى جدا راوت  خارجى من نوع جيت وتروح مستخد اللى هى الفانكشن الريسورس اللى ويبقا كدا ضربنا عصفورين بحجر --}}
                                            {{-- <a class="btn btn-sm btn-danger" data-effect="effect-scale" href="{{route('test.destroy',$section->id)}}" title="حذف"><i class="las la-trash"></i></a> مش هينفع اعملها كدا لان الراوت الريسورس لن يسمح لك ان تصل اللى فانكشن ديستروى اللى هى فى الريسورس لانه لاز تجيله عن طريق فورم فلازم كدا هتعمل انت راوت خارجى + لو انت عاوز تعستغل او تشغل الراوت الريسورس مفيش مشكله اعمل الطريقه اللى هى تجيله عن طريق فورم ثم فى الفورم هتقدر توصل للراوت ريسورس اللى هو ديستوروى عادى جدا يعنى هتحط فى الفورم بتاعة هل انت متاكد من عمليه الحذف فى الاكشن تيست دوت ديستروى وترميله ال اى دى عادى او ممكن تستغنى عن الخطوه دى خالص وتروح بعد ماتعمل الراوت الخارجى تروح تعمل ديليت عادى جدا بس لاحظ فى هذه الحاله لن نستطيع استغلال راوت ديسرتروى اللى هى يعنى فنكشن ديسترةى بل هنعكتب اى فانكشن من دماغنا ونستخدمها عادى جدا   --}}
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
    <!-- end table -->
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
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

@endsection
