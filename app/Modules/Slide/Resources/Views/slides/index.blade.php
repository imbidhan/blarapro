@extends('backend.backendMaster')
@section('title', 'Slide List')
@section('page_title', 'Slide List')
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
                                                    <th>#</th>
                                                    <th>Slide Title</th>
                                                    <th>Slide Link</th>
                                                    <th>Slide Button</th>
                                                    <th>Slide Image</th>
                                                    <th>Created By</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Slide Title</th>
                                                    <th>Slide Link</th>
                                                    <th>Slide Button</th>
                                                    <th>Slide Image</th>
                                                    <th>Created By</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                @if(count($slides) > 0)
                                                    @php($i=1)
                                                    @foreach ($slides as $slide)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>@if($slide->slideTitle){{ ucwords($slide->slideTitle) }}@else Not given @endif</td>
                                                            <td>@if($slide->slideBtnText){{ ucwords($slide->slideBtnText) }} @else Not given @endif</td>
                                                            <td>@if($slide->slideBtnLink){{ ucwords($slide->slideBtnLink) }}  @else Not given @endif</td>
                                                            <td>
                                                                @if($slide->slideImage)
                                                                    <img src="{{ asset($slide->slideImage) }}" width="50" alt="Slide image">
                                                                @endif
                                                            </td>
                                                            <td>@if($slide->created_by){{ $slide->userCreated->userRole->name}}@endif
                                                            </td>
                                                            <td>
                                                                @if($slide->status == 1)
                                                                    <span class="badge badge-pill badge-success">Published</span>
                                                                    @else
                                                                    <span class="badge badge-pill badge-warning">Unpublished</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($slide->created_at)
                                                                    <?php
                                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $slide->created_at, new DateTimeZone("UTC"));
                                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                    ?>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($slide->updated_at)
                                                                    <?php
                                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $slide->updated_at, new DateTimeZone("UTC"));
                                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                    ?>
                                                                @endif
                                                            </td>
                                                            <td>

                                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                                   data-trigger="hover" data-original-title="Edit"
                                                                   class="btn btn-icon btn-info btn-outline" href="{{ route('slides_edit',['id'=>$slide->id])}}">
                                                                    <i class="icon wb-edit" aria-hidden="true"></i>
                                                                </a>

                                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                                   data-trigger="hover" data-original-title="Delete"
                                                                   onclick="return confirm('Are you to delete');"
                                                                   class="btn btn-icon btn-danger btn-outline" href="{{ route('slides_delete',['id'=>$slide->id])}}">
                                                                    <i class="icon wb-trash" aria-hidden="true"></i>
                                                                </a>

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


    <div class="md-fab-wrapper branch-create">
        <a id="add_branch_button" href="{{ route('slides_create') }}" class="md-fab md-fab-accent branch-create">
            <i class="fa fa-plus"></i>
        </a>
    </div>

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._datatable_style')
    <style>
        .md-fab-wrapper {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1004;
            -webkit-transition: margin 280ms cubic-bezier(.4, 0, .2, 1);
            transition: margin 280ms cubic-bezier(.4, 0, .2, 1);
        }

        .md-fab.md-fab-accent {
            background: #17a2b8;
        }

        .md-fab {
            box-sizing: border-box;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff;
            color: #727272;
            display: block;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            -webkit-transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
            transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
            border: none;
            position: relative;
            text-align: center;
            cursor: pointer;
        }

        .md-fab.md-fab-accent>i {
            color: #fff;
        }

        .md-fab>i {
            font-size: 20px;
            line-height: 66px;
            height: inherit;
            width: inherit;
            position: absolute;
            left: 0;
            top: 0;
            color: #727272;
        }
    </style>
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._datatable_script')
    <script type="text/javascript">
        $('#slidesManage').addClass('active open');
        $('#slidesManageChildLi').addClass('active');
    </script>
@endsection
