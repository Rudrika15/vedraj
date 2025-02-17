<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index($id = 0)
    {


        if ($id != 0) {
            $branches = Branch::where('id', $id)->orderBy('branch_name', 'asc')->get();
        } else {
            $branches = Branch::orderBy('branch_name', 'asc')->get();
        }

        return Util::getSuccessMessage('Branch List', $branches);
    }
    public function branchAddress($id = 0)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $language = $user->language;
                $hindiFields = ['*', 'address_hindi as display_address'];
                $englishFields = ['*', 'address as display_address'];
                if ($language == 'hi') {
                    $branches = Branch::select($hindiFields)
                        ->orderBy('branch_name', 'asc')
                        ->get();;
                } else {
                    $branches = Branch::select($englishFields)
                        ->orderBy('branch_name', 'asc')
                        ->get();
                }
            } else {
                if ($id != 0) {
                    $branches = Branch::where('id', $id)->orderBy('branch_name', 'asc')->get();
                } else {
                    $branches = Branch::orderBy('branch_name', 'asc')->get();
                }
            }
            
            return Util::getSuccessMessage('Branch Listsssss', $branches);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }
}
