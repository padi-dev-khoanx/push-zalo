@extends('layouts.master')

@section('title', 'List of Content')

@section('breadcrumb')
    <h2 class="main-content-title tx-24 mg-b-5">List of upload history</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Upload history</li>
    </ol>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <table class="table  text-nowrap text-md-nowrap table-striped mg-b-0" id="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Phone</th>
                            <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset_admin('plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset_admin('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function () {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                searching: false,
                pageLength: 25,
                ajax: {
                    url: '{{ route("history.get") }}',
                    type: 'get',
                    data: function (d) {
                        d.csrf = '{{csrf_field()}}';
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'phone'},
                    {data: 'message'},
                ],
                "order": [[0, "desc"]],
                "language": {
                    "lengthMenu": "_MENU_ bản ghi/trang",
                    "zeroRecords": "Không tìm bản ghi phù hợp",
                    "info": "Đang hiển thị trang _PAGE_ of _PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ tổng số _MAX_ bản ghi)",
                    "info": "Từ _START_ đến _END_ trong _TOTAL_ kết quả",
                    "paginate": {
                        "previous": "«",
                        "next": "»"
                    },
                    "sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading'
                },
                "dom": "<'row'<'col-sm-12'tr>>" +
                    "<'row footer-datatable'<'col-sm-12 col-md-6 col-lg-4'l><'col-sm-12 col-md-6 col-lg-4'i><'col-sm-12 col-md-12 col-lg-4'p>>",
                "scrollX": true,
                scrollCollapse: true,
                'colReorder': {
                    'allowReorder': false,
                    fixedColumnsLeft: 2,
                },
                fixedColumns: {
                    leftColumns: 2
                },
                "columnDefs": [
                    {"width": "30px", "targets": 0},
                    {"width": "50px", "targets": 1},
                    {"width": "150px", "targets": "_all"},
                ],
            });
        });
        function filter() {
            table.draw();
        }

    </script>
@endsection
