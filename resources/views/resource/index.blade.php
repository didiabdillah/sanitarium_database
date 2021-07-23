@extends('layout.layout_main')

@push('style')
<!-- JQuery DataTable Css -->
<link href="{{URL::asset('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('page')
<div class="container-fluid">
    <!-- <div class="block-header">
        <h2>RESOURCE</h2>
    </div> -->

    <div class="row clearfix">
        <a href="{{route('resource_create')}}" class="btn btn-primary btn-lg waves-effect">
            <i class="material-icons">add</i>
            <span>ADD NEW RESOURCE</span>
        </a>
        <br><br>
        <div class="card">
            <div class=" header">
                <h2>
                    RESOURCE
                </h2>
                <!-- <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul> -->
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Label</th>
                                <th>Category</th>
                                <th>Source</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resource as $row)
                            <tr>
                                <td><b>{{$loop->iteration}}</b></td>
                                <td>{{$row->resource_label}}</td>
                                <td>
                                    @if($row->resource_category_id)
                                    <span class="badge bg-purple">{{$row->category_label}}</span>
                                    <br>
                                    @endif
                                    @if($row->resource_sub_category_id)
                                    <span class="badge bg-blue">{{$row->sub_category_label}}</span>
                                    @endif
                                </td>
                                <td>{{($row->resource_source) ? $row->resource_source : "-" }}</td>
                                <td>{{($row->resource_author) ? $row->resource_author : "-" }}</td>
                                <td>
                                    @if($row->resource_status == 'note')
                                    <span class="badge bg-blue">{{$row->resource_status}}</span>
                                    @elseif($row->resource_status == 'backup')
                                    <span class="badge bg-orange">{{$row->resource_status}}</span>
                                    @elseif($row->resource_status == 'post')
                                    <span class="badge bg-green">{{$row->resource_status}}</span>
                                    @elseif($row->resource_status == 'fail')
                                    <span class="badge bg-red">{{$row->resource_status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('resource_destroy', $row->resource_id)}}" method="post">
                                        @csrf
                                        @method('delete')

                                        <a href="{{route('resource_edit', $row->resource_id)}}" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <button type="submit" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('plugin')
<!-- Jquery DataTable Plugin Js -->
<script src="{{URL::asset('assets/plugins/jquery-datatable/jquery.dataTables.js')}}">
</script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

<script>
    $(function() {
        $('.js-basic-example').DataTable({
            responsive: true
        });
    });
</script>
<!-- Custom Js -->
{{--<script src="{{URL::asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>--}}
@endpush