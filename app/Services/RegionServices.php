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

    public function updateReg($data) {
        $updated = Region::where('id', $data->id)->update([
            'name' => $data->region_name,
            'last_modified_by' => Auth::id(),
            'last_modified' => Carbon::now(),
            'country' => $data->country
        ]);

        if($updated) {
            $reg_updated = 'ok';
            return back()->with(compact('reg_updated'));
        }

        return response()->json([
            'ok' => false,
            'message' => "Can't update"
        ])->setStatusCode(503);

    }

    public function remove($id) {
        $deleted = Region::where('id', $id)->delete();

        if($deleted) {
            $r_deleted = 'ok';
            return back()->with(compact('r_deleted'));
        }
    }

    public function getFiltered($date, $last_modified, $search_name) {
        $result = null;
        if($date) {
           $fitered_by_date = Region::where('created','LIKE', $date.'%')
                ->where('created', '>=', $date . ' ' . '00:00:00')->with('countries')->get();
            $result = $fitered_by_date;
        }
        if($last_modified && !$search_name) {
            $collection1 = collect($fitered_by_date);
            $result = $collection1->sortBy('modified_id');
        } else if($last_modified && $search_name) {
            $search_result = Region::where('name', 'LIKE', '%'.$search_name.'%')->with('countries')->get();
            $collection2 = collect($search_result);
            $result = $collection2->sortBy('modified_id');
        } else if($date && $search_name) {
            $result = Region::where('created','LIKE', $date.'%')
                ->where('name', 'LIKE', '%'.$search_name.'%')
                ->where('created', '>=', $date . ' ' . '00:00:00')
                ->with('countries')->get();
        }
        if($search_name) {
            $result = Region::where('name', 'LIKE', '%'.$search_name.'%')->with('countries')->get();
        }

        return $result;
    }

}
