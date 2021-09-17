<?php

namespace App\Services;

use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class RegionServices {

    public function getRegions() {
        return Region::all();
    }

    public function getRegionById($id) {
        if($id) {
            return Region::find($id);
        }
    }

    public function createRegion($data) {

        $region = new Region();
        $region->name = $data->input('region_name');
        $region->slug = Str::slug($data->input('region_name'),'-');
        $region->country = $data->input('country');
        $region->created_by = Auth::id();
        $region->created = Carbon::now();

        if($region->save()) {

            $created = 'ok';
            return back()->with(compact('created'));

        }

    }

    public function pagination($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
