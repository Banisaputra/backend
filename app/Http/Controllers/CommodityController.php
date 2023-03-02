<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\Commodity;
use App\Models\CommodityPrice;
use App\Charts\CommodityHistoricalData;
use App\Exports\CommodityExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CommodityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:commodities-create')->only('store');
        $this->middleware('permission:commodities-read')->only('index', 'show');
        $this->middleware('permission:commodities-update')->only('update', 'edit');
        $this->middleware('permission:commodities-delete')->only('destroy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commodities = QueryBuilder::for(Commodity::class)
            ->with('lastPrice')
            ->allowedFilters(['name', AllowedFilter::trashed()])
            ->allowedSorts(['name', 'created_at'])
            ->defaultSort('-id')
            ->get();

        return view('dashboard.commodities.lists', ['commodities' => $commodities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(array('price' => clean_money_formatter($request->input('price'))));

        $data = $request->validateWithBag('commodityStoreForm', [
            'name' => 'required|min:3',
            'unit' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'required|max:5192|image',
        ]);

        $image = $request->file('image');
        $path = $image->store('public/commodities');
        $data['image'] = Storage::url($path);

        $commodity = Commodity::create($data);
        $commodity->prices()->create([
            'price' => $request->price,
        ]);

        notify('success', 'Komoditas berhasil dibuat.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dateRange = 30;

        $commodity = Commodity::findOrFail($id);
        $histories = CommodityPrice::where('commodity_id', $id)
            ->where('created_at', '>', now()->subDays($dateRange)->endOfDay())
            ->orderBy('created_at', 'desc')
            ->get()
            ->reverse();


        $dates = collect(range(0, $dateRange - 1))->map(function ($index) {
            return now()->subDays($index);
        })->reverse()->values();

        $labels = $dates->map(function ($date) {
            return $date->translatedFormat('d F Y');
        });

        $dataset = $dates->map(function ($date) use ($histories) {
            // get price from database when the specific day is exist
            $dataRecord = $histories->filter(function ($data) use ($date) {
                return $data->created_at->isSameDay($date);
            })->sortByDesc('price')->first();

            // if price from the specific day if not found, use the last price before the specific day
            if (!$dataRecord) {
                $dataRecord = $histories->filter(function ($data) use ($date) {
                    return $data->created_at->endOfDay()->isBefore($date->endOfDay()) && $data->price;
                })->sortByDesc('created_at')->first();
            }

            return $dataRecord->price ?? 0;
        });

        $chart = new CommodityHistoricalData;
        $chart->labels($labels);
        $chart->dataset('Harga Komoditas Dalam 30 Hari Terakhir (Dalam Rp)', 'line', $dataset->values())
            ->backgroundColor('rgba(25, 174, 150, 0.1)')
            ->color('rgb(25 174 150)');

        return view('dashboard.commodities.show', compact('commodity', 'chart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commodity = Commodity::findOrFail($id);
        return view('dashboard.commodities.edit', ['commodity' => $commodity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, Commodity $commodity)
    {
        $request->merge(array('price' => clean_money_formatter($request->input('price'))));

        $rules = [
            'name' => 'required|min:3',
            'unit' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'max:5192|image',
        ];

        if (!$commodity->image) {
            $rules['image'] = 'required|max:5192|image';
        }

        $data = $request->validate($rules);
        $newPrice = $request->input('price');

        if ($request->has('image')) {
            $image = $request->file('image');
            $path = $image->store('public/commodities');
            $data['image'] = Storage::url($path);
        }

        $commodity->update($data);

        if ($commodity->lastPrice->price != $newPrice) {
            $commodity->prices()->create([
                'price' =>  $newPrice
            ]);
        }
        
        notify('success', 'Komoditas berhasil diperbarui.');
        return redirect()->route('commodities.index')->send();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commodity $commodity)
    {
        $commodity->delete();

        notify('success', 'Komoditas berhasil dihapus.');
        return redirect()->back();
    }

    public function export()
    {
        $now = date('d-F-Y');
        return Excel::download(new CommodityExport, 'harga-komoditas-'.$now.'.xlsx');
    }
}
