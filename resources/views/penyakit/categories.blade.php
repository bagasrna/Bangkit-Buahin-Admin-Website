@extends('layouts.sidebar')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Kategori</h4>
                    <h6 class="card-subtitle">
                        Data kategori yang terdaftar di database
                    </h6>
                    <button class="btn btn-primary float-right m-10" onclick="openAddModal(this)">
                        <i class="mdi mdi-plus-circle-outline"></i> Tambah Kategori
                    </button>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Action</th>
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
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="post" action="">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="hidden" class="form-control mb-2" id="editedId" name="id">

                            <label>Name:</label>
                            <input type="text" class="form-control mb-2" id="editedName" name="name">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitEditCategory()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Category</h5>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="post" action="{{ route('penyakit.category.create') }}">
                        @csrf
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control mb-2" name="name" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitAddCategory()">Submit</button>
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
                ajax: '{!! route('penyakit.category.datatables') !!}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            let action = `<div class="btn-group" role="group">`;
                            // Edit
                            action +=
                                `<button class="btn btn-xs btn-primary text-white rounded" data-id="${row.id}" data-name="${row.name}" data-action="${data.edit_link}" onclick="openEditModal(this)">Edit</button>`;

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
            $('#addCategoryModal').modal('show');
        }

        function openEditModal(button) {
            let id = $(button).data('id');
            let name = $(button).data('name');
            let editAction = $(button).data('action');

            $('#editedId').val(id);
            $('#editedName').val(name);
            $('#editCategoryForm').attr('action', editAction);
            $('#editCategoryModal').modal('show');
        }

        function submitAddCategory() {
            var inputs = $('#addCategoryForm input');
            var isValid = true;
            inputs.each(function() {
                if (!$(this).val()) {
                    alert('Harap isi semua kolom sebelum submit!');
                    isValid = false;
                    return false;
                }
            });

            if (isValid) {
                $('#addCategoryForm').submit();
                $('#addCategoryModal').modal('hide');
            }
        }

        function submitEditCategory() {
            var inputs = $('#editCategoryForm input');
            var isValid = true;
            inputs.each(function() {
                if (!$(this).val()) {
                    alert('Harap isi semua kolom sebelum submit!');
                    isValid = false;
                    return false;
                }
            });

            if (isValid) {
                $('#editCategoryForm').submit();
                $('#editCategoryModal').modal('hide');
            }
        }
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan delete kategori ini!',
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
