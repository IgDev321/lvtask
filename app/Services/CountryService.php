<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Country;
use Illuminate\Support\Str;


class CountryService {

    public function showCountries() {
        return Country::all();
    }


    public function getCountryById($id) {
        if($id) {
           return Country::find($id);
        }
    }

    public function createCountry($data) {
        $country = new Country;
        $country->name = $data->input('country_name');
        $country->slug = Str::slug($data->input('country_name'), '-');
        $country->created_by = Auth::id();
        $country->created = Carbon::now();

        if($country->save()) {
            $ok = 'isOk';
            return back()->with(compact('ok'));
        }
    }

    public function pagination($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function updateC($data) {

        $updated = Country::where('id', $data->c_id)->update([
            'name' => $data->country_name,
            'last_modified_by' => Auth::id(),
            'last_modified' => Carbon::now()
        ]);

        if($updated) {
            $u = 'ok';
            return back()->with(compact('u'));
        }

        return response()->json([
            'ok' => false,
            'message' => "Can't update"
        ])->setStatusCode(503);

    }

    public function remove($id) {
        $deleted = Country::where('id', $id)->delete();

        if($deleted) {
            $c_deleted = 'ok';
            return back()->with(compact('c_deleted'));
        }
    }

}
