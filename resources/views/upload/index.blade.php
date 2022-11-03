@extends('layouts.master')

@section('title','Upload File')

@section('breadcrumb')
    <h2 class="main-content-title tx-24 mg-b-5">Upload File</h2>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form id="form-input" method="post" action="">
                        @csrf
                        <table class="table  text-nowrap text-md-nowrap table-striped mg-b-0" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone"
                                                       value="{{ old('phone', $item[0]) }}" @error('phone') is-invalid @enderror/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="message"
                                                       value="{{ old('message', $item[1]) }}" @error('message') is-invalid @enderror/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex-row">
                                                <div>
                                                    <form action="{{ route('upload.delete', $loop->index) }}" method="post" class="w-auto">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-delete" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <button id="save" type="submit" class="btn btn-primary">Submit to send message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form id="form-input" method="post" action="{{ route('upload.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload file</label>
                            <div>
                                <input type="file" id="file" name="file" class="dropify file-upload-input" data-height="200">
                            </div>
                            @error('file')
                            {!! admin_validation($message) !!}
                            @enderror
                        </div>
                        <button id="save" type="submit" class="btn btn-primary">Preview</button>
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
