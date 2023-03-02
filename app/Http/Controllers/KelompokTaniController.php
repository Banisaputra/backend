<?php

namespace App\Http\Controllers;

use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Exports\KelompokTaniExport;
use Maatwebsite\Excel\Facades\Excel;

class KelompokTaniController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kelompok-tani-create')->only('store');
        $this->middleware('permission:kelompok-tani-update')->only('edit', 'update');
        $this->middleware('permission:kelompok-tani-read')->only('index', 'export');
        $this->middleware('permission:kelompok-tani-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KelompokTani::all();
        return view('dashboard.kelompok-tani', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (KelompokTani::create(request()->all())) {
            notify('success', 'Berhasil membuat data Kelompok Tani!');
        } else {
            notify('error', 'Gagal membuat data Kelompok Tani!');
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelompokTani $kelompokTani)
    {
        if ($kelompokTani->update(request()->all())) {
            notify('success', 'Kelompok Tani berhasil diperbarui!');
        } else {
            notify('error', 'Kelompok Tani gagal diperbarui!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelompokTani $kelompokTani)
    {
        if ($kelompokTani->delete()) {
            notify('success', 'Kelompok Tani berhasil dihapus!');
        } else {
            notify('error', 'Kelompok Tani gagal dihapus!');
        }

        return redirect()->back();
    }

    public function export()
    {
        $now = date('d-F-Y');
        return Excel::download(new KelompokTaniExport, 'kelompok-wanita-tani-'.$now.'.xlsx');
    }

    /**
     * Search resource by request query
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if (!get_cache('show_kwt_search')) {
            abort(404);
        }

        $data = KelompokTani::where('group_name', 'like', '%'.$request->input('q').'%')
            ->orWhere('leader', 'like', '%'.$request->input('q').'%')
            ->orWhere('registration_number', 'like', '%'.$request->input('q').'%')
            ->get();

        return view('kelompok-wanita-tani', compact('data'));
    }
}
