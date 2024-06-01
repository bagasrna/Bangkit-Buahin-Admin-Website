<?php

namespace App\Http\Controllers;

use App\Http\Requests\GulmaRequest;
use App\Http\Services\GulmaService;
use App\Models\Gulma;
use Yajra\DataTables\Facades\DataTables;

class GulmaController extends Controller
{
    protected $gulmaService;

    public function __construct(GulmaService $gulmaService)
    {
        $this->gulmaService = $gulmaService;
    }

    public function index()
    {
        return view('gulma.index');
    }

    public function createPage()
    {
        return view('gulma.create');
    }

    public function editPage(Gulma $gulma)
    {
        return view('gulma.edit', [
            'gulma' => $gulma
        ]);
    }

    public function create(GulmaRequest $request)
    {
        $this->gulmaService->addGulmaToDatabase($request);
        return redirect()->route('gulma.index')->with('success', 'Sukses menambah gulma');
    }

    public function edit(Gulma $gulma, GulmaRequest $request)
    {
        $this->gulmaService->updateGulmaFromDatabase($gulma, $request);
        return redirect()->route('gulma.index')->with('success', 'Sukses mengubah gulma');
    }

    public function delete(Gulma $gulma)
    {
        $this->gulmaService->deleteGulmaFromDatabase($gulma);
        return redirect()->route('gulma.index')->with('success', 'Sukses menghapus gulma');
    }

    public function datatables(GulmaRequest $request)
    {
        if (!$request->ajax())
            return 'Access Denied';

        $data = $this->gulmaService->getDatabaseGulma();
        return DataTables::of($data)
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($row) {
                return [
                    'id' => $row->id,
                    'edit_link' => route('gulma.edit.page', $row->id),
                    'delete_link' => route('gulma.delete', $row->id),
                    'csrf_token' => csrf_token(),
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }
}
