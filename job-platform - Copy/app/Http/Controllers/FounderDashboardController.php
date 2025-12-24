<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Project;
use App\Models\WorkRequest;

class FounderDashboardController extends Controller
{
    /**
     * Handle the Founder's dashboard index request.
     * This includes specific stats, project activity charts, and market updates.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Extra protection: Ensure the authenticated user is a Founder
        if ($user->role !== 'founder') {
            return redirect()->route('dashboard'); 
        }

        // 1. Retrieve the Founder's specific projects
        $projects = Project::where('user_id', $user->id)->latest()->get();

        // 2. Global market statistics
        $marketJobsCount = Job::count();
        
        // 3. Founder-specific performance statistics
        $myPostedJobsCount = Job::where('user_id', $user->id)->count();
        $openJobsCount = Job::where('user_id', $user->id)->where('status', 'open')->count();
        
        // Calculate the number of active hires (Accepted Work Requests)
        $activeHiresCount = WorkRequest::where('receiver_id', $user->id)
            ->where('status', 'accepted')
            ->count();

        // 4. Chart Logic: Fetch real Project Activity data
        // Generate a list of the last 6 months as default keys with zero values
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->put(now()->subMonths($i)->format('M'), 0);
        }

        // Fetch real Application counts per month for the last 6 months
        $activityData = WorkRequest::where('receiver_id', $user->id)
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%b") as month')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');

        // Merge actual data with the default months collection to ensure no empty gaps
        $finalChartData = $months->merge($activityData);

        $chartLabels = $finalChartData->keys()->toArray();   // e.g., ['Jan', 'Feb', ...]
        $chartValues = $finalChartData->values()->toArray(); // e.g., [12, 5, 0, ...]

        // 5. Latest Market Activity
        $recentJobs = Job::with('user')->latest()->take(5)->get();

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
}