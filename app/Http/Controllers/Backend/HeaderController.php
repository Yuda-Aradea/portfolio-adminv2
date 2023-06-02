<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Icon controller
    public function RemixIconShow() {

        return view('backend.content.icon.remix_icon');
    }

    public function MaterialIconShow() {

        return view('backend.content.icon.material_icon');
    }

    public function FontawesomeIconShow() {

        return view('backend.content.icon.fontawesome');
    }
}
