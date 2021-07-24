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
        <a href="{{route('resource')}}" class="btn btn-danger btn-lg waves-effect">
            <i class="material-icons">arrow_back</i>
            <span>BACK</span>
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
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Resource Link
                            </h2>
                        </div>
                        <div class="body">
                            <div class="list-group">
                                @foreach($resource->resource_link()->get() as $data)
                                <div class="row">
                                    <div class="col-xs-10">
                                        <a href="{{$data->resource_link_url}}" class="list-group-item">{{$data->resource_link_url}} <span class="badge {{($data->resource_link_status == true) ? 'bg-blue' : 'bg-red'}}">{{($data->resource_link_status == true) ? 'active' : 'deactive'}}</span></a>
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="{{route('resource_link_status', $data->resource_link_id)}}" class="btn {{($data->resource_link_status == true) ? 'btn-danger' : 'btn-success'}} btn-lg">{{($data->resource_link_status == true) ? 'Deactive' : 'Active'}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Resource Image Link
                            </h2>
                        </div>
                        <div class="body">
                            <div class="list-group">
                                @foreach($resource->resource_image()->get() as $data)
                                <div class="row">
                                    <div class="col-xs-10">
                                        <a href="{{$data->resource_image_link}}" class="list-group-item">{{$data->resource_image_link}} <span class="badge {{($data->resource_image_status == true) ? 'bg-blue' : 'bg-red'}}">{{($data->resource_image_status == true) ? 'active' : 'deactive'}}</span></a>
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="{{route('resource_image_status', $data->resource_image_id)}}" class="btn {{($data->resource_image_status == true) ? 'btn-danger' : 'btn-success'}} btn-lg">{{($data->resource_image_status == true) ? 'Deactive' : 'Active'}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('plugin')
<script>
    // --------------
    // Delete Button
    // --------------
    $('.btn-remove').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

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