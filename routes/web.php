<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FounderDashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WorkRequestController;
use App\Http\Controllers\ConnectionController; 
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'founder') {
            return redirect()->route('founder.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('welcome');

// --- Authentication ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register/choose', [AuthController::class, 'chooseRole'])->name('register.choose');
Route::get('/register', fn () => redirect()->route('register.choose'))->name('register');
Route::get('/register/founder', [RegisterController::class, 'showRegisterForm'])->name('register.founder');
Route::get('/register/freelancer', [AuthController::class, 'showRegisterFreelancer'])->name('register.freelancer');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::middleware('auth')->group(function () {

    // 1. Dashboards
    Route::get('/founder/dashboard', [FounderDashboardController::class, 'index'])->name('founder.dashboard');

    // General Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resolve Issue: Add freelancer.dashboard route and redirect to the main DashboardController
    Route::get('/freelancer/dashboard', [DashboardController::class, 'index'])->name('freelancer.dashboard');

    Route::get('/founder-home', fn () => redirect()->route('founder.dashboard'))->name('founder.home');

    // 2. Skill Registration
    Route::get('/register/skills', [RegisterController::class, 'showSkillsForm'])->name('register.skills');
    Route::post('/register/skills/save', [RegisterController::class, 'saveSkills'])->name('skills.save');

    // --- Projects Management ---
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

    // --- Jobs Market ---
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/my-jobs', [JobController::class, 'myJobs'])->name('jobs.my');
    Route::get('/jobs-market', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs-market/{id}', [JobController::class, 'show'])->name('jobs.show');

    // --- Chat System ---
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}', [ChatController::class, 'send'])->name('chat.send');
    Route::delete('/chat/message/{messageId}', [ChatController::class, 'destroyMessage'])->name('chat.message.destroy');

    // Resolve Issue: Allow GET, HEAD, and POST for the applications endpoint
    Route::match(['get', 'post'], '/jobs/{jobId}/applications', [JobController::class, 'showApplications'])->name('jobs.applications.show');

    // --- Job Applications Management ---
    // Acceptance Route
    Route::post('/applications/{applicationId}/accept', [JobController::class, 'acceptApplication'])->name('jobs.application.accept');
    // Rejection Route
    Route::post('/applications/{applicationId}/reject', [JobController::class, 'rejectApplication'])->name('jobs.application.reject');

    // --- Profiles ---
    Route::get('/founder-profile/{id}', [JobController::class, 'showFounder'])->name('founder.show');
    Route::get('/freelancers', [ProfileController::class, 'allFreelancers'])->name('freelancers.index');
    Route::get('/freelancer/{id}', [ProfileController::class, 'showFreelancer'])->name('freelancer.show');
    
    // Work Request System (WorkRequestController)
    // FIX: Route updated to expect job_id instead of receiver_id to match controller logic
    Route::post('/request/send/{jobId}', [WorkRequestController::class, 'sendRequest'])->name('request.send'); 
    
    // 2. Freelancer Invitation (Founder -> Freelancer) - Fixed missing/broken route
    Route::post('/request/invite/{freelancerId}', [WorkRequestController::class, 'sendInvitation'])->name('request.invite');

    Route::get('/my-requests', [WorkRequestController::class, 'showRequests'])->name('requests.index');
    Route::post('/request/{id}/accept', [WorkRequestController::class, 'acceptRequest'])->name('request.accept');
    Route::post('/request/{id}/decline', [WorkRequestController::class, 'declineRequest'])->name('request.decline');

    // BUG FIX: Added missing "requests.update" route and directed it to appropriate handling methods
    Route::get('/requests/update/{id}/{status}', function ($id, $status) {
        if ($status === 'accepted') {
            return app(WorkRequestController::class)->acceptRequest($id);
        } elseif ($status === 'declined') {
            return app(WorkRequestController::class)->declineRequest($id);
        }

        return back()->with('error', 'Invalid action');
    })->name('requests.update');

    // Connections Page - Added here to maintain logical order
    Route::get('/my-connections', [ConnectionController::class, 'index'])->name('connections.index');
    Route::delete('/connections/{id}', [ConnectionController::class, 'destroy'])->name('connections.destroy');

    // Requests Page (Legacy)
    Route::get('/requestw', function () {
        $user = Auth::user();
        $projects = ($user->role === 'founder')
            ? Project::where('user_id', $user->id)->latest()->get()
            : collect([]);

        return view('founder.request', compact('projects'));
    })->name('request');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');

});