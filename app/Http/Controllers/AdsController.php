<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsRequest;
use App\Models\Ads;
use Yajra\DataTables\Facades\DataTables;

class AdsController extends Controller
{
    public function index()
    {
        return view('ads.index');
    }

    public function create(AdsRequest $request)
    {
        Ads::create([
            'title' => $request->title,
            'image' => storeImage($request->image, 'ads')
        ]);
        return redirect()->route('ads.index')->with('success', 'Sukses menambah ads');
    }

    public function delete(Ads $ads)
    {
        $ads->delete();
        return redirect()->route('ads.index')->with('success', 'Sukses menghapus ads');
    }

    public function datatables(AdsRequest $request)
    {
        if (!$request->ajax())
            return 'Access Denied';

        $data = Ads::all();
        return DataTables::of($data)
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($row) {
                return [
                    'id' => $row->id,
                    'delete_link' => route('ads.delete', $row->id),
                    'csrf_token' => csrf_token(),
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }
}
