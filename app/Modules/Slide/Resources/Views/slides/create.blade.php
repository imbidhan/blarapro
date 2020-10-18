@extends('backend.backendMaster')
@section('title', 'Slide Create')
@section('page_title', 'Slide create')
@section('page_content')
    <!-- Page -->
    <div class="page">

        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">@yield('page_title')</li>
            </ol>
        </div>

        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-bordered panel-info border border-info">

                        <div class="panel-heading">
                            <h3 class="panel-title">@yield('page_title')</h3>
                        </div>

                        <div class="p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <form action="{{ route('slides_store') }}" method="POST" id="slideForm" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">

                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Slide Title
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" name="slideTitle"
                                                                   placeholder="Slide Title"  autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Slide Content
                                                                </div>
                                                            </div>
                                                            <textarea placeholder="Slider content here" name="sliderContent" class="form-control" rows="1"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Slide Button Text
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" name="slideBtnText"
                                                                   placeholder="Slide Button Text"  autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Slide Button Link
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" name="slideBtnLink"
                                                                   placeholder="Slide Button Link"  autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-group input-group-file" data-plugin="inputGroupFile">

                                                            <div class="input-group-append">
                                                            <span class="btn btn-info btn-file">
                                                              <i class="icon wb-upload" aria-hidden="true"></i>
                                                              <input type="file" name="slideImage" accept="image/*">
                                                            </span>
                                                            </div>
                                                            <input required type="text" class="form-control" readonly="" placeholder="Upload Slide Image">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row row-lg">
                                                <div class="form-group col-xl-2 padding-top-m">
                                                    <button type="submit" class="btn btn-info" id="validateButton1">Create
                                                        Slide</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._formvalidation_style')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._formvalidation_script')
    <script src="{{ asset('/validation/slideValidation.js') }}"></script>
    <script type="text/javascript">
        $('#slidesManage').addClass('active open');
        $('#slidesManageChildLi').addClass('active');
    </script>
@endsection
