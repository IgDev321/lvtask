@extends('layouts.app')

@section('content')

    <section class="search">
        <form action="" method="GET">
            <input type="text" name="search">
            <button>Search</button>
        </form>
    </section>
    <h2 align="center">Countries</h2>
    <section class="counties" style="border:1px solid magento; margin: 0 auto;">
        <table style="border: 1px solid red">
            <thead>
                <th>Name</th>
                <th>Created</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($countries as $country)
                    <tr style="border:1px solid black;">
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->created }}</td>
                        <td> <i><a href="{{ route('dashboard.updateCountry', $country->id) }}">Update</a></i> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            {{ $countries->links("pagination::bootstrap-4") }}
        </div>
    </section>
    <h2 align="center">Regions</h2>
    <section class="regions" style="border:1px solid magento; margin: 0 auto;">
        <table style="border: 1px solid red">
            <thead>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($regions as $region)
                    <tr style="border: 1px solid black;">
                        <td>{{ $region->name }}</td>
                        <td><a href="{{ route('dashboard.updateRegion', [$region->id, $region->country]) }}">Update</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </section>
@stop
