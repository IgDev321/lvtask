@extends('layouts.app')

@section('content')
    <section class="update-region">
        <form action="{{ route('dashboard.updateReg') }}" method="PUT">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="id" type="hidden" value="{{ $region->id }}"/>
            <label for="">
                <span>Region Name:</span><br>
                <input type="text" name="region_name" value="{{ $region->name }}">
            </label>
            <br>
            <label for="">
                <span>Country:</span><br>
                <select name="region">
                    <option selected>Choose:</option>
                    @foreach($countries as $country)
                        <option value="" @if($country->id == $c) selected @endif >{{ $country->name }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <br>
            <button type="button">Update</button>
        </form>
    </section>

@stop
