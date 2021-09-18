@extends('layouts.app')

@section('content')
    <section class="search_result" align="center">
        <a href="{{ route('dashboard.showAll') }}">Go back</a>{{--{{ url()->previous() }}--}}

        <br><br>
        @if($regions)
            <table border="1px soldi black">
                <thead>
                    <th>Region Name</th>
                    <th>Country name</th>
                    <th>Created Date</th>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                        <tr>
                            <td>{{ $region->name }}</td>
                            <td>{{ $region->countries->name}}</td>
                            <td>{{ $region->created }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                {{ $regions->appends(request()->except('page'))->links("pagination::bootstrap-4") }}
            </div>
        @else
            <h3 align="center">No result of search</h3>
        @endif
    </section>
@stop