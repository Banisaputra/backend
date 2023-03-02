<?php

namespace App\Http\Controllers;

use App\Models\SKPG;
use App\Charts\SKPGChart;
use App\Imports\SKPGImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SKPGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = group_collection_by_key(SKPG::select('title', 'key')->groupBy('title', 'key')->get(), 'title');
        return view('dashboard.skpg.index', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file')->store('temp');
        SKPG::truncate();
        Excel::import(new SKPGImport, $file);
        
        notify('success', 'Data berhasil diperbarui!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SKPG  $sKPG
     * @return \Illuminate\Http\Response
     */
    public function show(SKPG $sKPG)
    {
        $dataset = SKPG::where('title', request()->input('title'))
            ->where('key', request()->input('key'))
            ->get();

        if ($dataset->isEmpty()) {
            abort(404);
        }

        $type = $dataset->first();

        $chart = new SKPGChart;
        $chart->labels($dataset->pluck('district')->toArray());
        $chart->dataset($type->label, 'bar', $dataset->pluck('value')->toArray())
            ->backgroundColor('rgba(25, 174, 150, 0.25)');

        return view('dashboard.skpg.show.index', compact('dataset', 'chart', 'type'));
    }
}
