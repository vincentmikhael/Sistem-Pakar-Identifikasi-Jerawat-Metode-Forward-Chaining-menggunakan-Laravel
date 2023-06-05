<?php

namespace App\Http\Controllers;

use App\Charts\PenyakitChart;
use App\Charts\ReportChart;
use App\Models\Penyakit;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $penyakit = Penyakit::all();
        return view('home.index',compact('penyakit'));
    }

    public function dashboard(){
        $data = [
            'jml_user' => User::count(),
            'jml_report' => Report::count(),
            'jml_penyakit' => Penyakit::count()
        ];
        $today_users = Report::whereDate('tanggal', today())->count();
        $yesterday_users = Report::whereDate('tanggal', today()->subDays(1))->count();
        $users_2_days_ago = Report::whereDate('tanggal', today()->subDays(2))->count();
        $chart = new ReportChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Data Report', 'bar', [$users_2_days_ago, $yesterday_users, $today_users]);
        $chart->options([
            'scales' =>[
                'yAxes' => [[
                    'ticks' => [
                        'stepSize' => 1
                    ]
                ]]
            ]
                    ]);

        $acne = Report::where('penyakit_id',6)->count();
        $rosacea = Report::where('penyakit_id',7)->count();
        $perioral = Report::where('penyakit_id',8)->count();
        $pity = Report::where('penyakit_id',9)->count();
        $keratos = Report::where('penyakit_id',10)->count();
        $gram = Report::where('penyakit_id',11)->count();
        $pseu = Report::where('penyakit_id',12)->count();

        $chart2 = new PenyakitChart;
        $chart2->labels(['1', '2', '3','4','5','6','7']);
        $chart2->dataset('1.Acne v 2.Rosacea 3.Perioral 4.Pityrosporum 5.Keratos 6.Gram 7.Pseudo', 'bar', [strval($acne), strval($rosacea), strval($perioral),strval($pity),strval($keratos),strval($gram),strval($pseu)]);
        $chart2->options([
                        'scales' =>[
                            'yAxes' => [[
                                'ticks' => [
                                    'stepSize' => 1
                                ]
                            ]]
                        ]
                        ]);
        
        return view('dashboard.home',compact('data','chart','chart2'));
    }
}
