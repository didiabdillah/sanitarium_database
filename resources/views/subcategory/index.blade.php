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
        <a href="{{route('sub_category_create')}}" class="btn btn-primary btn-lg waves-effect">
            <i class="material-icons">add</i>
            <span>ADD NEW SUB CATEGORY</span>
        </a>
        <br><br>
        <div class="card">
            <div class=" header">
                <h2>
                    SUB CATEGORY
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
                                <th>Sub Category Label</th>
                                <th>Category</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sub_category as $row)
                            <tr>
                                <td><b>{{$loop->iteration}}</b></td>
                                <td>{{$row->sub_category_label}}</td>
                                <td>{{$row->category_label}}</td>

                                <td>
                                    <form action="{{route('sub_category_destroy', $row->sub_category_id)}}" method="post">
                                        @csrf
                                        @method('delete')

                                        <a href="{{route('sub_category_edit', $row->sub_category_id)}}" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
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