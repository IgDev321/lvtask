@extends('layouts.app')

@section('content')

    <section class="search">
        <a href="{{ route('dashboard.search') }}">Go back</a>
        <form action="{{ route('dashboard.search') }}" method="GET">
{{--            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>--}}
            <div class="filters">
                <span>Search By Checkbox Filters</span>
                <br>
                <label for="">
                    <span>Filter from created date and greater</span>
                    <input type="date" name="date_filter" title="Start At">
                </label>

            </div>
            <span>and / or</span>
           <div class="sorting">
               <span>By Sorting</span>
               <br>
               <label for="">
                 <span>Last modified user id</span>
                 <input type="checkbox" name="last_modified" title="Use sort">
               </label>
           </div>
            <br><br>
            <label for="">
                <span> Search by region name or use filters with press button with empty search field </span>
                <input type="text" name="search_name">
            </label>
            <button>Search</button>
            <span> Search working on regions </span>
        </form>
    </section>
    <h2 align="center">Regions</h2>
    <section class="regions" style="border:1px solid magento; margin: 0 auto;">
        <table border="1px solid black" style="border: 1px solid red; width: 50%; margin: 0 auto; text-align: center;">
            <thead>
            <th>Name</th>
            <th>Country</th>
            <th>Created</th>
            <th>Created By</th>
            <th>Last Modified</th>
            <th>Last Modified By</th>
            <th>Published</th>
            <th>Actions</th>
            </thead>
            <tbody>
            @foreach($regions as $region)
                <tr style="border: 1px solid black;">
                    <td>{{ $region->name }}</td>
                    <td>{{ $region->country }}</td>
                    <td>{{ $region->created }}</td>
                    <td>{{ $region->created_by }}</td>
                    <td>{{ $region->last_modified }}</td>
                    <td>{{ $region->last_modified_by }}</td>
                    <td>{{ $region->published == 1 ? 'true' : 'false' }}</td>
                    <td>
                        <a href="{{ route('dashboard.updateRegion', [$region->id, $region->country]) }}" style=" display: inline-block; padding-bottom: 6px;">
                            Update
                        </a>
                        <form method="POST" action="{{ route('dashboard.removeReg', [$region->id]) }}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-icon">
                                <i data-feather="delete">Remove</i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div class="row" style="display: block; width: 20%; margin: 0 auto; text-align:center">
            {{ $regions->links("pagination::bootstrap-4") }}
        </div>
    </section>
    <h2 align="center">Countries</h2>
    <section class="counties" style="border:1px solid magento; margin: 0 auto;">
        <table border="1px solid black" style="border: 1px solid red; width: 50%; margin: 0 auto; text-align: center;">
            <thead>
                <th>Number</th>
                <th>Name</th>
                <th>Created</th>
                <th>Created By</th>
                <th>Last Modified</th>
                <th>Last Modified By</th>
                <th>Published</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($countries as $country)
                    <tr style="border:1px solid black;">
                        <td>{{ $country->id }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->created }}</td>
                        <td>{{ $country->created_by }}</td>
                        <td>{{ $country->last_modified }}</td>
                        <td>{{ $country->last_modified_by }}</td>
                        <td>{{ $country->published == 1 ? 'true' : 'fasle' }}</td>
                        <td>
                            <a href="{{ route('dashboard.updateCountry', $country->id) }}" style="display: inline-block; padding-bottom: 6px;">
                                Update
                            </a>

                            <form method="POST" action="{{ route('dashboard.removeC', [$country->id]) }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-icon">
                                    <i data-feather="delete">Remove</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row" style="display: block; width: 20%; margin: 0 auto; text-align:center">
            {{ $countries->links("pagination::bootstrap-4") }}
        </div>
    </section>

@stop
