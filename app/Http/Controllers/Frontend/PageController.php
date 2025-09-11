<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PageController extends Controller
{
    // Static / informational pages
    public function index()
    {
        return view('frontend.index');
    }
    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function advertise()
    {
        return view('frontend.advertise');
    }

    public function maritimeInstitutes()
    {
        return view('frontend.maritime-institutes');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function disclaimer()
    {
        return view('frontend.disclaimer');
    }

    // Authentication / login pages
    public function candidateLogin()
    {
        return view('frontend.auth.login'); // candidate login
    }

    public function companyLogin()
    {
        return view('frontend.auth.company-login'); // company login (super/subadmin)
    }

    public function adminLogin()
    {
        return view('frontend.auth.admin-login'); // admin login (create view if needed)
    }

    public function companyRegister()
    {
        return view('frontend.auth.company-register'); // new company registration form
    }

    // Job-related / candidate actions
    public function searchJobs()
    {
        return view('frontend.jobs.search'); // list/search jobs
    }

    public function postResume()
    {
        return view('frontend.post-resume'); // post resume page
    }

    public function viewResumes()
    {
        return view('frontend.view-resumes'); // employers can view resumes
    }

    public function reviews()
    {
        return view('frontend.reviews');
    }

    public function hotJobs(Request $request)
    {
        // SAMPLE DATA - replace with real query when ready
        $jobsList = collect([
            ['title'=>'Required Chief Off for VLGC','joining_date'=>'2025-09-13','nationality'=>'Indian','min_exp'=>'6 Months'],
            ['title'=>'Required 2nd Engr. for Bulk Carrier','joining_date'=>'2025-09-15','nationality'=>'Indian','min_exp'=>'1 Year'],
            ['title'=>'Required Chief Off for Bulk Carrier','joining_date'=>'2025-09-12','nationality'=>'Indian','min_exp'=>'12 Months'],
            ['title'=>'Required Chief Engr. for Bulk Carrier','joining_date'=>'2025-09-12','nationality'=>'Indian','min_exp'=>'12 Months'],
            ['title'=>'Electrical Officer for Tanker','joining_date'=>'2025-09-20','nationality'=>'Indian','min_exp'=>'24 Months'],
            ['title'=>'3rd Officer for VLCC','joining_date'=>'2025-09-18','nationality'=>'Indian','min_exp'=>'18 Months'],
            ['title'=>'Chief Engineer for Container','joining_date'=>'2025-09-25','nationality'=>'Indian','min_exp'=>'36 Months'],
            ['title'=>'Deck Cadet for Bulk Carrier','joining_date'=>'2025-09-22','nationality'=>'Indian','min_exp'=>'0 Months'],
            ['title'=>'Bosun for General Cargo','joining_date'=>'2025-09-30','nationality'=>'Filipino','min_exp'=>'24 Months'],
            ['title'=>'2nd Engr. for Container','joining_date'=>'2025-10-05','nationality'=>'Indian','min_exp'=>'18 Months'],
            // add more sample items if you need to test pagination
        ]);

        // Pagination (LengthAwarePaginator) so blade can use ->links() or previous/next
        $perPage = 12;
        $page = (int) $request->get('page', 1);
        $slice = $jobsList->forPage($page, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $slice,
            $jobsList->count(),
            $perPage,
            $page,
            ['path' => url('/hot-jobs')]
        );

        return view('frontend.hotjobs', ['jobs' => $paginator]);
    }

    // Add any other pages you have here as methods:
    // e.g. public function faq() { return view('frontend.faq'); }
}
