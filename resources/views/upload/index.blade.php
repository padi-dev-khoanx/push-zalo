@extends('layouts.master')

@section('title','Tải lên file')

@section('breadcrumb')
    <h2 class="main-content-title tx-24 mg-b-5">Tải lên file</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tải lên file</li>
    </ol>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form id="form-input" method="post" action="{{ route('upload.preview') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Tải lên file</label>
                            <div>
                                <input type="file" id="file" name="file" class="dropify file-upload-input" data-height="200">
                            </div>
                            @error('file')
                            {!! admin_validation($message) !!}
                            @enderror
                        </div>
                        <button id="save" type="submit" class="btn btn-primary">Xem và sửa nội dung tải lên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset_admin('plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset_admin('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
@endsection
