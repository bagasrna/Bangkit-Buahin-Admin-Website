<?php

namespace App\Http\Controllers;

use App\Http\Requests\HamaRequest;
use App\Models\HamaCategory;
use Yajra\DataTables\Facades\DataTables;

class HamaCategoryController extends Controller
{
    public function index()
    {
        $categories = $this->getCategories();
        return view('hama.categories', [
            'categories' => $categories
        ]);
    }

    public function create(HamaRequest $request)
    {
        HamaCategory::create([
            'name' => $request->name,
            'parent_id' => 1
        ]);
        return redirect()->route('hama.category.index')->with('success', 'Sukses menambah kategori');
    }

    public function edit(HamaCategory $category, HamaRequest $request)
    {
        $category->update([
            'name' => $request->name
        ]);
        return redirect()->route('hama.category.index')->with('success', 'Sukses mengubah kategori');
    }

    public function delete(HamaCategory $category)
    {
        $category->articles()->delete();
        $category->delete();
        return redirect()->route('hama.category.index')->with('success', 'Sukses menghapus kategori');
    }

    public function datatables(HamaRequest $request)
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
                    'edit_link' => route('hama.category.edit', $row->id),
                    'delete_link' => route('hama.category.delete', $row->id),
                    'csrf_token' => csrf_token(),
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }

    protected function getCategories()
    {
        return HamaCategory::whereNot('name', 'Identifikasi Gejala Serangan Hama')
            ->whereNot('name', 'Hama Tebu')
            ->whereNot('name', 'Musuh Alami Hama Tebu')
            ->get();
    }
}
