@extends('layouts.sidebar')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Gulma</h4>
                    <h6 class="card-subtitle">
                        Data gulma yang terdaftar di database
                    </h6>
                    <a href="{{ route('gulma.create.page') }}" class="btn btn-primary float-right m-10"><i
                        class="mdi mdi-plus-circle-outline"></i> Tambah Gulma</a>
                    </button>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20,
                lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                ajax: '{!! route('gulma.datatables') !!}',
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            let action = `<div class="btn-group" role="group">`;
                            // Edit
                            action +=
                                `<a href="${data.edit_link}" class="btn btn-xs btn-primary text-white rounded">Ubah</a>`;

                            // Delete
                            action +=
                                `<form action="${data.delete_link}" method="post" id="delete-form-${data.id}">`;
                            action += `<input type="hidden" name="_method" value="delete">`;
                            action +=
                                `<input type="hidden" name="_token" value="${data.csrf_token}">`;
                            action +=
                                `<button class="ms-2 btn btn-xs btn-danger text-white rounded" type="button" onclick="confirmDelete(${data.id})">Hapus</button></form>`;

                            action += `</div>`;
                            return action;
                        },
                    },
                ],
                columnDefs: [{
                    orderable: false,
                }, ],
            });
        });
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan delete gulma ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, delete!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            })
        }
    </script>
@endsection
