@extends('layouts.sidebar')
@section('content')
    <div>
        <div class="row justify-content-center ">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2" action="{{ route('gulma.create') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12 fw-bold">Judul</label>
                                <div class="col-md-12">
                                    <input type="text" name="title" class="form-control form-control-line" required>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <div class="col-md-6">
                                    <label class="col-md-12 fw-bold">Deskripsi Gambar</label>
                                    <input type="text" name="image_descriptions[]" class="form-control form-control-line" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-12 fw-bold">Gambar</label>
                                    <input type="file" placeholder="Mahasiswa" name="images[]"
                                        class="form-control form-control-line" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-info btn-add-row text-white">Tambah
                                        Gambar</button>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <button class="btn btn-primary text-white" type="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/a652irwn1qsuf084nirrph7cx1likixztsr4gp83e2nrq7ja/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        $(document).ready(function() {
            // Menambahkan baris baru untuk input gambar dan deskripsi gambar
            $(".btn-add-row").click(function() {
                var newRow = '<div class="form-group d-flex justify-content-between">' +
                    '<div class="col-md-6">' +
                    '<label class="col-md-12 fw-bold">Deskripsi Gambar</label>' +
                    '<input type="text" name="image_descriptions[]" class="form-control form-control-line">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label class="col-md-12 fw-bold">Gambar</label>' +
                    '<input type="file" placeholder="Mahasiswa" name="images[]" class="form-control form-control-line">' +
                    '</div>' +
                    '<div class="col-md-1 d-flex align-items-end">' +
                    '<button type="button" class="btn btn-danger btn-remove-row text-white">Hapus</button>' +
                    '</div>' +
                    '</div>';
                $(".btn-add-row").before(newRow);

                // Tampilkan tombol "Hapus" jika ada lebih dari satu baris gambar
                if ($('.form-group').length > 2) {
                    $(".btn-remove-row").show();
                }
            });

            // Menghapus baris gambar
            $(document).on("click", ".btn-remove-row", function() {
                $(this).closest(".form-group").remove();

                // Sembunyikan tombol "Hapus" jika hanya ada satu baris gambar
                if ($('.form-group').length === 2) {
                    $(".btn-remove-row").hide();
                }
            });
        });
    </script>
@endsection
