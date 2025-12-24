<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Project;
use App\Models\WorkRequest;

class DashboardController extends Controller
{
    /**
     * Handle the dashboard index request and prepare data for different user roles.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Retrieve projects belonging to the user
        $projects = Project::where('user_id', $user->id)->latest()->get();

        // 2. General platform statistics
        $marketJobsCount = Job::count();
        $myPostedJobsCount = Job::where('user_id', $user->id)->count();

        // 3. Founder-specific statistics
        $openJobsCount = Job::where('user_id', $user->id)->where('status', 'open')->count();
        
        // Calculate active hires based on accepted work requests
        $activeHiresCount = WorkRequest::where('receiver_id', $user->id)
            ->where('status', 'accepted')
            ->count();

        // 4. Chart Data Logic (Chart Values & Labels)
        // Initialize a collection with the last 6 months defaulting to zero
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->put(now()->subMonths($i)->format('M'), 0);
        }

        // Fetch actual request counts from the database grouped by month
        $activityData = WorkRequest::where('receiver_id', $user->id)
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%b") as month')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');

        // Merge real activity data with the default monthly array to avoid missing values
        $finalChartData = $months->merge($activityData);

        $chartLabels = $finalChartData->keys()->toArray();   // e.g., ['Jan', 'Feb', ...]
        $chartValues = $finalChartData->values()->toArray(); // e.g., [10, 5, 20, ...]

        // 5. Additional data for the dashboard
        $recentJobs = Job::with('user')->latest()->take(5)->get();
        $suggestedJobs = Job::where('user_id', '!=', $user->id)
                            ->inRandomOrder()
                            ->take(3)
                            ->get();

        // Redirect Founder to their specific homepage with required chart variables
        if ($user->role === 'founder') {
            return view('auth.founder-home', compact(
                'user',
                'projects',
                'marketJobsCount',
                'myPostedJobsCount',
                'openJobsCount',
                'activeHiresCount',
                'recentJobs',
                'chartLabels',
                'chartValues'
            ));
        }

        // Redirect Freelancer to their dashboard
        return view('freelancer.dashboard', compact(
            'user',
            'projects',
            'marketJobsCount',
            'myPostedJobsCount',
            'recentJobs',
            'suggestedJobs',
            'chartLabels',
            'chartValues'
        ));
    }
}