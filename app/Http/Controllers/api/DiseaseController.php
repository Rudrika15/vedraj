<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Prescription;
use App\Utils\Util;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            $diseases = $diseases->orderBy('disease_name', 'asc')->paginate($perPage, ['*'], 'page', $currentPage);

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

    public function generatePdf($id)
    {
        try {
            $prescription = Prescription::with(['appointment' => function ($q) {
                $q->with('user');
            }, 'medicines' => function ($q) {
                $q->with('products');
            }, 'user', 'disease'])->where('id', $id)->first();
            $imagePath = public_path('images/background.png');
            $imageData = base64_encode(File::get($imagePath));
            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
            $base64Image = "data:image/{$imageType};base64,{$imageData}";
            // return view('pdf.prescription', compact('prescription', 'base64Image'));
            $pdf = Pdf::loadView('pdf.prescription', compact('prescription', 'base64Image'));

            return $pdf->download('prescription.pdf');
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }
}
