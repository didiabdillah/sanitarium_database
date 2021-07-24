@extends('layout.layout_main')

@push('style')
<!-- Bootstrap Select Css -->
<link href="{{URL::asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endpush

@section('page')
<div class="container-fluid">
    <!-- <div class="block-header">
        <h2>RESOURCE</h2>
    </div> -->

    <div class="row clearfix">
        <div class="card">
            <div class="header">
                <h2>EDIT RESOURCE</h2>
            </div>
            <div class="body">
                <form id="form_validation" method="POST" method="{{route('resource_status_update', $resource->resource_id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group form-float">
                        <p>
                            <b>Status</b>
                        </p>
                        <select class="form-control show-tick @error('status'){{'error focused'}}@enderror" data-live-search="true" name="status">
                            <option value="note" @if($resource->resource_status=='note'){{'selected'}}@endif><span class="badge bg-blue">Note</span></option>
                            <option value="post" @if($resource->resource_status=='post'){{'selected'}}@endif><span class="badge bg-green">Post</span></option>
                            <option value="backup" @if($resource->resource_status=='backup'){{'selected'}}@endif><span class="badge bg-orange">Backup</span></option>
                            <option value="fail" @if($resource->resource_status=='fail'){{'selected'}}@endif><span class="badge bg-red">Fail</span></option>
                        </select>
                        @error('status')
                        <label id="email-error" class="error" for="source">{{$message}}</label>
                        @enderror
                    </div>

                    <a class="btn btn-danger waves-effect btn-lg" href="{{route('resource')}}">CANCEL</a>
                    <button class="btn btn-primary btn-lg waves-effect" type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('plugin')
<!-- Select Plugin Js -->
<script src="{{URL::asset('assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<!-- <script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script> -->
@endpush