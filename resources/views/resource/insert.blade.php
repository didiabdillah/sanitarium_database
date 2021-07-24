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
                <h2>INSERT RESOURCE</h2>
            </div>
            <div class="body">
                <form id="form_validation" method="POST" method="{{route('resource_store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line @error('label'){{'error focused'}}@enderror">
                            <input type="text" class="form-control" name="label" value="{{old('label')}}">
                            <label class="form-label">Label</label>
                        </div>
                        @error('label')
                        <label id="email-error" class="error" for="label">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <p>
                            <b>Source</b>
                        </p>
                        <select class="form-control show-tick @error('source'){{'error focused'}}@enderror" data-live-search="true" name="source">
                            <option value="">--SOURCE--</option>
                            @foreach($source as $row)
                            <option value="{{$row->source_id}}" @if(old('source')==$row->source_id){{'selected'}}@endif>{{$row->source_label}}</option>
                            @endforeach
                        </select>
                        @error('source')
                        <label id="email-error" class="error" for="source">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <p>
                            <b>Author</b>
                        </p>
                        <select class="form-control show-tick @error('author'){{'error focused'}}@enderror" data-live-search="true" name="author">
                            <option value="">--AUTHOR--</option>
                            @foreach($author as $row)
                            <option value="{{$row->author_id}}" @if(old('author')==$row->author_id){{'selected'}}@endif>{{$row->author_label}}</option>
                            @endforeach
                        </select>
                        @error('author')
                        <label id="email-error" class="error" for="author">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <p>
                            <b>Sub Category</b>
                        </p>
                        <select class="form-control show-tick @error('sub_category'){{'error focused'}}@enderror" data-live-search="true" name="sub_category">
                            <option value="">--SUB CATEGORY--</option>
                            @foreach($sub_category as $row)
                            <optgroup label="{{$row->category_label}}">
                                @foreach($row->sub_category()->get() as $sub)
                                <option value="{{$sub->sub_category_id}}" @if(old('sub_category')==$sub->sub_category_id){{'selected'}}@endif>{{$sub->sub_category_label}}</option>
                                @endforeach
                            </optgroup>
                            @endforeach

                        </select>
                        @error('sub_category')
                        <label id="email-error" class="error" for="sub_category">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line @error('desc'){{'error focused'}}@enderror">
                            <textarea name="desc" cols="30" rows="3" class="form-control no-resize">{{old('desc')}}</textarea>
                            <label class="form-label">Description</label>
                        </div>
                        @error('desc')
                        <label id="email-error" class="error" for="desc">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line @error('link'){{'error focused'}}@enderror">
                            <textarea name="link" cols="30" rows="3" class="form-control no-resize">{{old('link')}}</textarea>
                            <label class="form-label">Resource Link</label>
                        </div>
                        @error('link')
                        <label id="email-error" class="error" for="link">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line @error('image'){{'error focused'}}@enderror">
                            <textarea name="image" cols="30" rows="3" class="form-control no-resize">{{old('image')}}</textarea>
                            <label class="form-label">Resource Image Link</label>
                        </div>
                        @error('image')
                        <label id="email-error" class="error" for="image">{{$message}}</label>
                        @enderror
                    </div>

                    <a class="btn btn-danger waves-effect btn-lg" href="{{route('resource')}}">CANCEL</a>
                    <button class="btn btn-primary btn-lg waves-effect" type="submit">INSERT</button>
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