<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Charts\AdminPostPublished;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        if (Auth()->user()->isA('subscriber')) {
            return view('dashboard.home-subscriber');
        }

        $totalPostsCount = DB::table('posts')
            ->selectRaw('
                count(*) as total,
                count(if(status="published",1,null)) as totalPublished,
                count(if(status="draft",1,null)) as totalDrafts,
                count(if(isnull(deleted_at),null,1)) as totalTrashed
            ')
            ->where('type', 'article')
            ->first();

        $archives = DB::table('posts')
            ->selectRaw('year(created_at) as year, month(created_at) as month, count(id) as posts')
            ->where('type', 'article')
            ->where('status', 'published')
            ->whereNull('deleted_at')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get()
            ->reverse();

        $labels = $archives->map(function ($archive) {
            $label = Carbon::createFromDate($archive->year, $archive->month, 1);
            return $label->translatedFormat('F Y');
        });

        $chart = new AdminPostPublished;
        $chart->labels($labels->values());
        $chart->dataset('Jumlah Post Terpublikasi', 'bar', $archives->pluck('posts'));

        return view('dashboard.home', compact('chart', 'totalPostsCount'));
    }
}
