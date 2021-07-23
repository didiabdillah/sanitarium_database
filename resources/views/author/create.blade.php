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
                <h2>INSERT AUTHOR</h2>
            </div>
            <div class="body">
                <form id="form_validation" method="POST" method="{{route('author_store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line @error('label'){{'error focused'}}@enderror">
                            <input type="text" class="form-control" name="label" value="{{old('label')}}">
                            <label class="form-label">Author Label</label>
                        </div>
                        @error('label')
                        <label id="email-error" class="error" for="label">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line @error('link'){{'error focused'}}@enderror">
                            <input type="text" class="form-control" name="link" value="{{old('link')}}">
                            <label class="form-label">Author Link</label>
                        </div>
                        @error('link')
                        <label id="email-error" class="error" for="link">{{$message}}</label>
                        @enderror
                    </div>

                    <a class="btn btn-danger waves-effect btn-lg" href="{{route('author')}}">CANCEL</a>
                    <button class="btn btn-primary btn-lg waves-effect" type="submit">CREATE</button>
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