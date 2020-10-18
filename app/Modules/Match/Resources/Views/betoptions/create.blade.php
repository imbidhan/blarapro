@extends('backend.backendMaster')
@section('title', 'Bet options Create')
@section('page_title', 'Bet options create')
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
                                    <form action="{{ route('betoptions_store') }}" method="POST" id="exampleFullForm"
                                        autocomplete="off">
                                        @csrf

                                        <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Sports Type
                                                                <span class="required text-danger"> *</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="sport_id" name="sport_id"
                                                                data-plugin="select2" required>
                                                            <option value="">Select Sports</option>
                                                            @if($sports)
                                                                @foreach ($sports as $sport)
                                                                    <option value="{{ $sport->id}}">
                                                                        {{ ucfirst($sport->sportName)}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">
                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Bet Option Name
                                                                <span class="required text-danger"> *</span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="betOptionName"
                                                            placeholder="Bet Options title" required="" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-lg">
                                            <div class="form-group col-xl-2 padding-top-m">
                                                <button type="submit" class="btn btn-info" id="validateButton1">Create
                                                    Bet Options</button>
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
<script src="{{ asset('/validation/betoptionsValidation.js') }}"></script>
<script type="text/javascript">
    $('#betoptionsManage').addClass('active open');
    $('#betoptionsManageChildLi').addClass('active');
</script>
@endsection
