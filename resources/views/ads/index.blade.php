@extends('layouts.sidebar')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Iklan & Promosi</h4>
                    <h6 class="card-subtitle">
                        Data Iilan & promosi yang terdaftar di database
                    </h6>
                    <button class="btn btn-primary float-right m-10" onclick="openAddModal(this)">
                        <i class="mdi mdi-plus-circle-outline"></i> Tambah Iklan & Promosi
                    </button>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
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
    <div class="modal fade" id="addAdsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Ads</h5>
                </div>
                <div class="modal-body">
                    <form id="addAdsForm" method="post" action="{{ route('ads.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" class="form-control mb-2" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>Gambar:</label>
                            <input type="file" class="form-control mb-2" name="image" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitAddAds()">Submit</button>
                    </form>
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
                ajax: '{!! route('ads.datatables') !!}',
                columns: [
                    {
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

                            // Delete
                            action +=
                                `<form action="${data.delete_link}" method="post" id="delete-form-${data.id}">`;
                            action += `<input type="hidden" name="_method" value="delete">`;
                            action +=
                                `<input type="hidden" name="_token" value="${data.csrf_token}">`;
                            action +=
                                `<button class="ms-2 btn btn-xs btn-danger text-white rounded" type="button" onclick="confirmDelete(${data.id})">Delete</button></form>`;

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

        function openAddModal(button) {
            $('#addAdsModal').modal('show');
        }

        function submitAddAds() {
            var inputs = $('#addAdsForm input');
            var isValid = true;
            inputs.each(function() {
                if (!$(this).val()) {
                    alert('Harap isi semua kolom sebelum submit!');
                    isValid = false;
                    return false;
                }
            });

            if (isValid) {
                $('#addAdsForm').submit();
                $('#addAdsModal').modal('hide');
            }
        }
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan delete ads ini!',
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
