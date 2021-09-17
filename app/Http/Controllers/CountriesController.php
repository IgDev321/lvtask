<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CountriesController extends Controller
{
    public $countryService;

    public function __construct(CountryService $countryService) {
        $this->countryService = $countryService;
    }

    public function create(Request $request) {

        $validated = Validator::make($request->all(), [
            'country_name' => 'required|string',
        ]);

        if($validated->errors()->any()) {
            return response()->json([
                'message' => 'Input data not passed validation rules'
            ])->setStatusCode(503);
        }

        return $this->countryService->createCountry($request);
    }

}
