@extends('layouts.master')

@section('title','Xem trước nội dung tải lên')

@section('breadcrumb')
    <h2 class="main-content-title tx-24 mg-b-5">Xem nội dung tải lên</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Xem nội dung tải lên</li>
    </ol>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form id="form-input" method="post" action="{{ route('upload.send') }}">
                        @csrf
                        <table class="table  text-nowrap text-md-nowrap table-striped mg-b-0" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Số điện thoại</th>
                                    <th>Tin nhắn</th>
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
                                                <input type="text" class="form-control" name="phone[]" value="{{ $item[0] }}" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" name="message[]">{{ $item[1] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if ($data)
                            <button id="save" type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                        @endif
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
