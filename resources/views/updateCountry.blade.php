@extends('layouts.app')

@section('content')
    <section class="update-country">
        <form action="{{ route()  }}" method="PUT">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input type="hidden" >
            <label for="">
                <span>Country Name:</span><br>
                <input type="text" name="country_name" value="{{ $country->name }}">
            </label>
            <br>
            <button type="button">Update</button>
        </form>
    </section>

@stop
