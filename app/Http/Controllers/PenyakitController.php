<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenyakitRequest;
use App\Http\Services\PenyakitService;
use App\Models\Penyakit;
use App\Models\PenyakitCategory;
use Yajra\DataTables\Facades\DataTables;

class PenyakitController extends Controller
{
    protected $penyakitService;

    public function __construct(PenyakitService $penyakitService)
    {
        $this->penyakitService = $penyakitService;
    }

    public function index()
    {
        return view('penyakit.index');
    }

    public function createPage()
    {
        $categories = $this->getCategories();
        return view('penyakit.create', [
            'categories' => $categories
        ]);
    }

    public function editPage(Penyakit $penyakit)
    {
        $categories = $this->getCategories();
        return view('penyakit.edit', [
            'penyakit' => $penyakit->load('categories'),
            'categories' => $categories
        ]);
    }

    public function create(PenyakitRequest $request)
    {
        $this->penyakitService->addPenyakitToDatabase($request);
        return redirect()->route('penyakit.index')->with('success', 'Sukses menambah penyakit');
    }

    public function edit(Penyakit $penyakit, PenyakitRequest $request)
    {
        $this->penyakitService->updatePenyakitFromDatabase($penyakit, $request);
        return redirect()->route('penyakit.index')->with('success', 'Sukses mengubah penyakit');
    }

    public function delete(Penyakit $penyakit)
    {
        $this->penyakitService->deletePenyakitFromDatabase($penyakit);
        return redirect()->route('penyakit.index')->with('success', 'Sukses menghapus penyakit');
    }

    public function datatables(PenyakitRequest $request)
    {
        if (!$request->ajax())
            return 'Access Denied';

        $data = $this->penyakitService->getDatabasePenyakit();
        return DataTables::of($data)
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('categories', function ($row) {
                $categories = $row->categories->pluck('name')->implode(', ');
                return $categories ?: '<kosong>';
            })
            ->addColumn('action', function ($row) {
                return [
                    'id' => $row->id,
                    'edit_link' => route('penyakit.edit.page', $row->id),
                    'delete_link' => route('penyakit.delete', $row->id),
                    'csrf_token' => csrf_token(),
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }

    protected function getCategories()
    {
        return PenyakitCategory::whereNot('name', 'Identifikasi Gejala Serangan Penyakit')
            ->whereNot('name', 'Penyakit Tebu')->get();
    }
}
