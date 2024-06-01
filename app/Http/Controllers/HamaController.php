<?php

namespace App\Http\Controllers;

use App\Http\Requests\HamaRequest;
use App\Http\Services\HamaService;
use App\Models\Hama;
use App\Models\HamaCategory;
use Yajra\DataTables\Facades\DataTables;

class HamaController extends Controller
{
    protected $hamaService;

    public function __construct(HamaService $hamaService)
    {
        $this->hamaService = $hamaService;
    }

    public function index()
    {
        return view('hama.index');
    }

    public function createPage()
    {
        $categories = $this->getCategories();
        return view('hama.create', [
            'categories' => $categories
        ]);
    }

    public function editPage(Hama $hama)
    {
        $categories = $this->getCategories();
        return view('hama.edit', [
            'hama' => $hama->load('categories'),
            'categories' => $categories
        ]);
    }

    public function create(HamaRequest $request)
    {
        $this->hamaService->addHamaToDatabase($request);
        return redirect()->route('hama.index')->with('success', 'Sukses menambah hama');
    }

    public function edit(Hama $hama, HamaRequest $request)
    {
        $this->hamaService->updateHamaFromDatabase($hama, $request);
        return redirect()->route('hama.index')->with('success', 'Sukses mengubah hama');
    }

    public function delete(Hama $hama)
    {
        $this->hamaService->deleteHamaFromDatabase($hama);
        return redirect()->route('hama.index')->with('success', 'Sukses menghapus hama');
    }

    public function datatables(HamaRequest $request)
    {
        if (!$request->ajax())
            return 'Access Denied';

        $data = $this->hamaService->getDatabaseHama();
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
                    'edit_link' => route('hama.edit.page', $row->id),
                    'delete_link' => route('hama.delete', $row->id),
                    'csrf_token' => csrf_token(),
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }

    protected function getCategories()
    {
        return HamaCategory::whereNot('name', 'Identifikasi Gejala Serangan Hama')->get();
    }
}
