<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        //  $id=  Auth::user()->id;
        //find user's disease from userId
        // name age mobile number email(optional) disease
        $videos = Disease::with('videos')->get();
        return Util::getSuccessMessage('Disease Wise videos', $videos);
    }
}
