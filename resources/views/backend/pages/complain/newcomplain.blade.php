@extends('backend.backendMaster')
@section('title', 'New complain list')
@section('page_title', 'New complain list')
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
                                        <table class="table table-hover dataTable table-striped w-full" id="exampleTableTools">
                                            <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>phone</th>
                                                <th>Image</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Accept</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Username</th>
                                                <th>phone</th>
                                                <th>Image</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Accept</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @if(count($complains) > 0)
                                                @foreach ($complains as $complain)
                                                    <tr>
                                                        <td> {{ $complain->username}}</td>
                                                        <td> {{ $complain->phone }}</td>
                                                        <td>
                                                            @if(!empty($complain->image))
                                                                <img src="{{ asset($complain->image) }}" height="500" alt="complain image"/>
                                                            @else
                                                                Not given
                                                            @endif
                                                        </td>
                                                        <td> {{ $complain->message }}</td>
                                                        <td>
                                                            @if($complain->status == 0)
                                                                <span class="badge badge-warning">Unseen</span>
                                                                @else
                                                                seen
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if($complain->created_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $complain->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i A');
                                                                ?>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <a onclick="return confirm('Are you sure ?')" class="btn btn-sm btn-success text-white" href="{{ route("complain_accept",["id"=>$complain->id]) }}">Accept</a>
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
                </div>
            </div>
        </div>
    </div>

    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._datatable_style')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._datatable_script')
    <script type="text/javascript">
        $('#usercomplain').addClass('active open');
        $('#complainlist').addClass('active');
    </script>
@endsection
