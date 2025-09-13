<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Dashboard view
     */
    public function dashboard()
    {
        return view('candidate.dashboard');
    }

    /**
     * Show change password page (form)
     */
    public function showChangePassword()
    {
        return view('candidate.profile.change-password');
    }

    /**
     * Show resume edit page
     */
    public function resumeEdit()
    {
        return view('candidate.resume.edit');
    }

    /**
     * Show resume view page
     */
    public function resumeView()
    {
        return view('candidate.resume.view');
    }

    /**
     * Show resume hide confirmation / form
     */
    public function showResumeHide()
    {
        return view('candidate.resume.hide');
    }

    /**
     * Handle resume hide action.
     *
     * Basic example: marks resume hidden on user model then redirects back.
     * Replace with actual business logic for your app.
     */
    public function resumeHideAction(Request $request)
    {
        $user = $request->user();

        // Example: suppose you have `resume_hidden` boolean on users table
        if (method_exists($user, 'update')) {
            // defensive: only attempt update if model exists
            $user->update(['resume_hidden' => true]);
        }

        return redirect()->route('candidate.resume')
            ->with('status', 'Your resume was hidden successfully.');
    }

    /**
     * Jobs search page
     */
    public function jobsSearch()
    {
        return view('candidate.jobs.search-jobs');
    }

    /**
     * Hot jobs listing page
     */
    public function jobsHot()
    {
        return view('candidate.jobs.hot-jobs');
    }

    /**
     * Express service listing page
     */
    public function expressService()
    {
        return view('candidate.express_services.express-service');
    }

    /**
     * Show payment form for a specific express service.
     * $service is the identifier used in your links (e.g. 'combo-30', 'combo-60')
     */
    public function expressPayForm(string $service)
    {
        // provide $service to the view if needed
        return view('candidate.express_services.paybutton', ['service' => $service]);
    }

    /**
     * Process payment for the selected express service.
     * This is a stub — plug in your payment gateway / logic here.
     */
    public function expressPayProcess(Request $request, string $service)
    {
        // Validate minimal fields for demonstration
        $request->validate([
            // add payment-specific validation here
        ]);

        // TODO: integrate payment gateway
        // For now, redirect back with success message
        return redirect()->route('candidate.express.service')
            ->with('status', "Payment for service '{$service}' processed (demo).");
    }

    /**
     * Statistics pages
     */
    public function statistics1()
    {
        return view('candidate.statistics.statistics1');
    }

    public function statistics2()
    {
        return view('candidate.statistics.statistics2');
    }

    public function statisticsView()
    {
        return view('candidate.statistics.view-statistics');
    }

    /**
     * Messages page
     */
    public function messages()
    {
        return view('candidate.messages');
    }

    /**
     * Show delete profile confirmation page
     */
    public function showDeleteProfile()
    {
        return view('candidate.profile.delete');
    }

    /**
     * Handle delete profile action (POST).
     * This is a destructive action: confirm current auth and delete.
     */
    public function deleteProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // add authorization checks, password confirmation etc, as required
        if ($user) {
            // Soft-delete if using SoftDeletes or permanently delete
            if (method_exists($user, 'delete')) {
                $user->delete();
            }

            // logout after deletion
            Auth::logout();

            return redirect()->route('home')->with('status', 'Your profile has been deleted.');
        }

        return redirect()->route('candidate.dashboard')->with('error', 'Unable to delete profile.');
    }
}
