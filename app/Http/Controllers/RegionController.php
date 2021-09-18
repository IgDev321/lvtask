<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Services\RegionServices;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public $regionService;

    public function __construct(RegionServices $regionService) {
        $this->regionService = $regionService;
    }

    public function create(Request $request) {
        $validated = Validator::make($request->all(), [
            'region_name' => 'required|string',
            'country'=> 'required|integer'
        ]);

        if($validated->errors()->any()) {
            return response()->json([
                'message' => 'Input data not pass validation rules'
            ])->setStatusCode(503);
        }

        return $this->regionService->createRegion($request);
    }

    public function updateReg(Request $request) {
        $validated = Validator::make($request->all(), [
            'region_name' => 'required|string',
            'id' => 'required|integer'
        ]);

        if($validated->errors()->any()) {
            return response()->json([
                'message' => 'Input data not pass validation rules'
            ])->setStatusCode(503);
        }

        return $this->regionService->updateReg($request);
    }


    public function destroy($id) {
        return $this->regionService->remove($id);
    }

}
