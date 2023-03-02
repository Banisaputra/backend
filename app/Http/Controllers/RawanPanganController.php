<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RawanPangan;
use App\Imports\RawanPanganImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RawanPanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rawan-pangan-create')->only('store');
        $this->middleware('permission:rawan-pangan-read')->only('index');
    }

    public function index() {
        $data = RawanPangan::all();
        $lastInserted = $data->sortBy('created_at')->first()->created_at ?? null;
        $lastUpdated = $lastInserted ? Carbon::parse($lastInserted)
            ->translatedFormat('l, d F Y H:i \W\I\B') : null;

        return view('dashboard.rawan-pangan.index', compact('data', 'lastUpdated'));
    }

    public function map() {
        $data = RawanPangan::all();
        $dataByDistrict = $data->reduce(function ($acc, $item) {
            if (!array_key_exists($item->district, $acc)) {
                $acc[$item->district] = [];
            }

            array_push($acc[$item->district], $item);
            return $acc;
        }, []);

        $ratings = RawanPangan::selectRaw('round(avg(prio_komp)) as rating, district')->groupBy('district')->get();
        $lastInserted = RawanPangan::orderBy('created_at')->first();
        $lastUpdated = $lastInserted ? Carbon::parse($lastInserted->created_at)
            ->translatedFormat('l, d F Y H:i \W\I\B') : null;
            

        return view('peta-rawan-pangan', compact('dataByDistrict', 'ratings', 'lastUpdated'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        return DB::transaction(function() use ($request) {
            $file = $request->file('file')->store('temp');
            RawanPangan::truncate();
            Excel::import(new RawanPanganImport, $file);
            
            notify('success', 'Data berhasil diperbarui!');
            return redirect()->back();
        });
    }
}
