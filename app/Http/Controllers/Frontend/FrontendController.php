<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SessionKeyModel;
use Illuminate\Http\Request;
use Session;

class FrontendController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    public function index()
    {
        return view('frontend.index');
    }
}
