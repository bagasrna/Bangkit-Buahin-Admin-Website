@extends('layouts.sidebar')
@section('content')
    <div>
        <div class="row justify-content-center ">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2" action="{{ route('hama.edit', $hama->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12 fw-bold">Judul</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $hama->title }}" name="title"
                                        class="form-control form-control-line" required>
                                </div>
                            </div>

                            @foreach ($hama->categories as $index => $oldCategory)
                                <div id="category-container">
                                    <div class="form-group category-group d-flex justify-content-between">
                                        <div class="col-md-10">
                                            <label class="col-md-12 fw-bold">Kategori {{ $index + 1 }}</label>
                                            <select name="category_ids[]" class="form-select shadow-none form-control-line"
                                                required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($categories as $newCategory)
                                                    <option value="{{ $newCategory->id }}"
                                                        {{ $oldCategory->id == $newCategory->id ? 'selected' : '' }}>
                                                        {{ $newCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Tampilkan tombol hapus hanya pada kategori kedua dan seterusnya -->
                                        @if ($index > 0)
                                            <div class="col-md-2 d-flex justify-content-center align-items-end">
                                                <button type="button"
                                                    class="btn btn-danger btn-remove-category text-white ms-2">Hapus</button>
                                            </div>
                                        @else
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button"
                                                    class="btn btn-info btn-add-category text-white ms-2">Tambah
                                                    Kategori</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label class="col-md-12 fw-bold">Deskripsi</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $hama->description }}" name="description"
                                        class="form-control form-control-line" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-email" class="col-md-12 fw-bold">Pencegahan</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line shadow-sm rounded-3 " name="pencegahan">{{ $hama->pencegahan }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-email" class="col-md-12 fw-bold">Pengendalian</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line shadow-sm rounded-3 " name="pengendalian">{{ $hama->pengendalian }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12 fw-bold">Gambar Background *kosongkan jika tidak diubah </label>
                                <div class="col-md-12">
                                    <input type="file" name="background_image" class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12 fw-bold">Gambar Daerah Persebaran *kosongkan jika tidak
                                    diubah</label>
                                <div class="col-md-12">
                                    <input type="file" name="daerah_persebaran_image"
                                        class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <div class="col-md-6">
                                    <label class="col-md-12 fw-bold">Deskripsi Gambar Tanda Serangan *kosongkan jika
                                        tidak diubah</label>
                                    <input type="text" name="image_descriptions[]"
                                        class="form-control form-control-line">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-12 fw-bold">Gambar Tanda Serangan</label>
                                    <input type="file" placeholder="Mahasiswa" name="images[]"
                                        class="form-control form-control-line">
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
            // Tambah kategori baru
            $(".btn-add-category").click(function() {
                var lastCategory = $("#category-container .category-group").last();
                var categoryCount = $("#category-container .category-group").length + 1;
                var newCategory = '<div class="form-group category-group d-flex justify-content-between">' +
                    '<div class="col-md-10">' +
                    '<label class="col-md-12 fw-bold">Kategori ' + categoryCount + '</label>' +
                    '<select name="category_ids[]" class="form-select shadow-none form-control-line" required>' +
                    '<option value="">Pilih Kategori</option>' +
                    '@foreach ($categories as $category)' +
                    '<option value="{{ $category->id }}">{{ $category->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2 d-flex justify-content-center align-items-end">' +
                    '<button type="button" class="btn btn-danger btn-remove-category text-white ms-2">Hapus</button>' +
                    '</div>' +
                    '</div>';
                if (lastCategory.length) {
                    lastCategory.after(newCategory);
                } else {
                    $("#category-container").append(newCategory);
                }
            });

            $(document).on("click", ".btn-remove-category", function() {
                $(this).closest(".category-group").remove();
                updateCategoryLabels();
            });

            function updateCategoryLabels() {
                $("#category-container .category-group").each(function(index, element) {
                    $(element).find("label").text("Kategori " + (index + 1));
                });
            }

            // Menambahkan baris baru untuk input gambar dan deskripsi gambar
            $(".btn-add-row").click(function() {
                var newRow = '<div class="form-group d-flex justify-content-between">' +
                    '<div class="col-md-6">' +
                    '<label class="col-md-12 fw-bold">Deskripsi Gambar Tanda Serangan</label>' +
                    '<input type="text" name="image_descriptions[]" class="form-control form-control-line">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label class="col-md-12 fw-bold">Gambar Tanda Serangan</label>' +
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
