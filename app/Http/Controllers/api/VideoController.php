<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Disease;
use App\Models\Video;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request, $id = 0)
    {
        $language = Auth::user()->language;
        $diseaseHindiField = ['disease:*,disease_name_hindi as display_name,description_hindi as display_description'];
        $diseaseEngField = ['disease:*,disease_name as display_name,description as display_description'];

        $videoHindiField = ['*', 'title_hindi as display_name'];
        $videoEngField = ['*', 'title as display_name'];

        $videosQuery = Video::with($language == 'hi' ? $diseaseHindiField : $diseaseEngField)
            ->select($language == 'hi' ? $videoHindiField : $videoEngField)
            ->orderBy('id', 'desc');

        if ($request->q == "all") {
            $perPage = $request->per_page ?? 10;
            $currentPage = request()->get('current_page', 1);
            $currentPage = max((int) $currentPage, 1);
            $perPage = request()->get('per_page') ? request()->get('per_page') : PHP_INT_MAX;
            $videos = $videosQuery->paginate($perPage, ['*'], 'page', $currentPage);
        } else {
            $userId = Auth::user()->id;
            $appointment = Appointment::where('user_id', $userId)->get();

            if ($appointment->isNotEmpty()) {
                $diseaseIds = $appointment->pluck('disease_id')->unique()->toArray();
                $videos = $videosQuery->whereIn('disease_id', $diseaseIds)
                    ->paginate(3);
            } else {
                $videos = $videosQuery->inRandomOrder()
                    ->paginate(3);
            }
        }
        return Util::getSuccessMessage('Disease Wise videos', $videos);
    }
}
