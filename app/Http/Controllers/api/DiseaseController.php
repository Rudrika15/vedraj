<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseController extends Controller
{
    public function index($id = 0)
    {
        try {
            $language =  Auth::user()->language;

            $diseaseHindiField = ['*', 'disease_name_hindi as display_name', 'description_hindi as display_description', 'food_plan_hindi as display_food_plan'];
            $diseaseEngField = ['*', 'disease_name as display_name', 'description as display_description', 'food_plan as display_food_plan'];

            $articalHindiField = ['*', 'title_hindi as display_name'];
            $articalEngField = ['*', 'title as display_name'];

            if ($language == 'hi') {
                $diseases = Disease::select($diseaseHindiField)->with('products', 'videos', 'articles');
            } else {
                $diseases = Disease::select($diseaseEngField)->with('products', 'videos', 'articles');
            }

            if ($id != 0) {
                $diseases->where('disease_id', $id);
            }

            $currentPage = request()->get('current_page', 1);

            $currentPage = max((int) $currentPage, 1);
            $perPage = request()->get('per_page') ? request()->get('per_page') : PHP_INT_MAX;

            // Apply pagination with the desired page number
            $diseases = $diseases->orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $currentPage);

            return Util::getSuccessMessage('Disease List', [
                'data' => $diseases->items(), // Actual records
                'current_page' => $diseases->currentPage(),
                'last_page' => $diseases->lastPage(),
                'per_page' => $diseases->perPage(),
                'total' => $diseases->total(),
            ]);
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }
}
