<?php

namespace App\Http\Controllers;

use App\Services\RegionServices;
use Illuminate\Http\Request;
use App\Services\CountryService;
//use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $countryService;
    public $regionService;

    public function __construct(CountryService $countryService, RegionServices $regionService)
    {
        $this->countryService = $countryService;
        $this->regionService = $regionService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function country() {
        return view('country');
    }

    public function region() {
        $countries = $this->countryService->showCountries();
        return view('region', ['countries' => $countries]);
    }

    public function show() {
        $countries = $this->countryService->showCountries();
         $paginator = paginate($countries, 5);
//        $total = count($countries);
//        $perPage = 5;
//        $currentPage = 1;
//        $paginator = new LengthAwarePaginator($countries, $total, $perPage, $currentPage, );

        $regions = $this->regionService->getRegions();
        $paginator2 = paginate($regions, 5);
//        $regionCount = count($countries);
//        $regionPerPage = 5;
//        $RegionCurrentPage = 1;
//        $paginator2 = new LengthAwarePaginator($regions, $regionCount, $regionPerPage, $RegionCurrentPage, ['setPath' => '/dashboard/all']);

        return view('show-all', ['countries' => $paginator, 'regions' => $paginator2]);
    }

    public function updateCountry($id) {
        $country = $this->countryService->getCountryById($id);
        return view('updateCountry', ['country' => $country]);
    }

    public function updateRegion($id, $country) {
        $region = $this->regionService->getRegionById($id);
        $countries = $this->countryService->showCountries();
        return view('updateRegion', ['countries' => $countries, 'c' => $country, 'region' => $region]);
    }


    public function search(Request $request) {

        $date = date('Y-m-d', strtotime($request->date_filter));
        $last_modified = $request->last_modified;
        $search_name = $request->search_name;

        $result = null;
        if($date !== '1970-01-01') {
            $result = $this->regionService->getFiltered($date, null, null);
        }else if($date !== '1970-01-01' && isset($last_modified) && !isset($search_name)) {
            $result = $this->regionService->getFiltered($date, $last_modified, null);
        } else if($date !== '1970-01-01' && isset($last_modified) && isset($search_name)) {
            $result = $this->regionService->getFiltered($date, $last_modified, $search_name);
        } else if($date !== '1970-01-01' && isset($search_name)) {
            $result = $this->regionService->getFiltered($date, null, $search_name);
        } else if(isset($search_name)) {
            $result = $this->regionService->getFiltered(null, null, $search_name);
        } else {
            return back();
        }

        $final = paginate($result, 5);

        return view('search', ['regions' => $final]);
    }

}
