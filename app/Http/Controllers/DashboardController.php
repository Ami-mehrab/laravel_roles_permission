<?php

namespace App\Http\Controllers;

use App\Models\MyJob;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Group jobs by category and count
        $jobsByCategory = MyJob::select('job_category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('job_category')
            ->get();

        // Prepare data for Highcharts
        $chartData = $jobsByCategory->map(function ($job) {
            return [
                'name' => $job->job_category,
                'y' => $job->total
            ];
        });


        
        return view('dashboard', compact('chartData'));
    }


}
