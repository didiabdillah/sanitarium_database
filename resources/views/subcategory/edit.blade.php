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
                <h2>EDIT SUB CATEGORY</h2>
            </div>
            <div class="body">
                <form id="form_validation" method="POST" method="{{route('sub_category_update', $sub_category->sub_category_id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group form-float">
                        <div class="form-line @error('label'){{'error focused'}}@enderror">
                            <input type="text" class="form-control" name="label" value="{{$sub_category->sub_category_label}}">
                            <label class="form-label">Sub Category Label</label>
                        </div>
                        @error('label')
                        <label id="email-error" class="error" for="label">{{$message}}</label>
                        @enderror
                    </div>

                    <div class="form-group form-float">
                        <p>
                            <b>Category</b>
                        </p>
                        <select class="form-control show-tick @error('category'){{'error focused'}}@enderror" data-live-search="true" name="category">
                            <option value="">--CATEGORY--</option>
                            @foreach($category as $row)
                            <option value="{{$row->category_id}}" @if($sub_category->sub_category_category_id==$row->category_id){{'selected'}}@endif>{{$row->category_label}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <label id="email-error" class="error" for="category">{{$message}}</label>
                        @enderror
                    </div>

                    <a class="btn btn-danger waves-effect btn-lg" href="{{route('sub_category')}}">CANCEL</a>
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