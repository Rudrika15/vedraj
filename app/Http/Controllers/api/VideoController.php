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
    public function index($id = 0)
    {
        $userId = Auth::user()->id;
        $appointment = Appointment::where('user_id', $userId)->get();

        $language = Auth::user()->language;
        $diseaseHindiField = ['disease:*,disease_name_hindi as display_name,description_hindi as display_description'];
        $diseaseEngField = ['disease:*,disease_name as display_name,description as display_description'];

        $videoHindiField = ['*', 'title_hindi as display_name'];
        $videoEngField = ['*', 'title as display_name'];

        if ($appointment) {
            $diseaseIds = $appointment->pluck('disease_id')->unique()->toArray();
            $diseases = Disease::whereIn('id', $diseaseIds)->get();

            if ($diseases->isEmpty()) {
                if ($language == 'hi') {
                    $videos = Video::with($diseaseHindiField)
                        ->select($videoHindiField);
                } else {
                    $videos = Video::with($diseaseEngField)
                        ->select($videoEngField);
                }
                if ($id != 0) {
                    $videos->where('disease_id', $id);
                }
                return $videos = $videos->orderBy('id', 'desc')->paginate(10);
            } else {
                if ($language == 'hi') {
                    $videos = Video::with($diseaseHindiField)
                        ->select($videoHindiField);
                } else {
                    $videos = Video::with($diseaseEngField)
                        ->select($videoEngField);
                }
                if ($id != 0) {
                    $videos->where('disease_id', $id);
                }

                $videoData = $videos->whereIn('disease_id', $diseaseIds)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

                if ($videoData->isEmpty()) {
                    $videos = $videos->orderBy('id', 'desc')->paginate(10);
                } else {
                    $videos = $videoData;
                }
            }
        } else {
            if ($language == 'hi') {
                $videos = Video::with($diseaseHindiField)
                    ->select($videoHindiField);
            } else {
                $videos = Video::with($diseaseEngField)
                    ->select($videoEngField);
            }
            if ($id != 0) {
                $videos->where('disease_id', $id);
            }
            $videos = $videos->orderBy('id', 'desc')->paginate(10);
        }

        return Util::getSuccessMessage('Disease Wise videos', $videos);
    }
}
