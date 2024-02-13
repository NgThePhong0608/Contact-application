<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   /* public function __construct()
    {
        $this->middleware(['auth']);
    }*/
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user()->loadCount(['companies', 'contacts']);
        return view('dashboard', compact('user'));
    }
}
