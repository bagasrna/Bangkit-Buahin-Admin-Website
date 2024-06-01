<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenyakitRequest;
use App\Models\PenyakitCategory;
use Yajra\DataTables\Facades\DataTables;

class PenyakitCategoryController extends Controller
{
    public function index()
    {
        $categories = $this->getCategories();
        return view('penyakit.categories', [
            'categories' => $categories
        ]);
    }

    public function create(PenyakitRequest $request)
    {
        PenyakitCategory::create([
            'name' => $request->name,
            'parent_id' => 1
        ]);
        return redirect()->route('penyakit.category.index')->with('success', 'Sukses menambah kategori');
    }

    public function edit(PenyakitCategory $category, PenyakitRequest $request)
    {
        $category->update([
            'name' => $request->name
        ]);
        return redirect()->route('penyakit.category.index')->with('success', 'Sukses mengubah kategori');
    }

    public function delete(PenyakitCategory $category)
    {
        $category->articles()->delete();
        $category->delete();
        return redirect()->route('penyakit.category.index')->with('success', 'Sukses menghapus kategori');
    }

    public function datatables(PenyakitRequest $request)
    {
        if (!$request->ajax())
            return 'Access Denied';

        $data = $this->getCategories();
        return DataTables::of($data)
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })->addColumn('action', function ($row) {
                return [
                    'id' => $row->id,
                    'edit_link' => route('penyakit.category.edit', $row->id),
                    'delete_link' => route('penyakit.category.delete', $row->id),
                    'csrf_token' => csrf_token(),
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }

    protected function getCategories()
    {
        return PenyakitCategory::whereNot('name', 'Identifikasi Gejala Serangan Penyakit')
            ->whereNot('name', 'Penyakit Tebu')
            ->whereNot('name', 'Gejala Lainnya')
            ->whereNot('name', 'Penyakit Sistemik')
            ->whereNot('name', 'Penyakit Lokal')
            ->get();
    }
}
