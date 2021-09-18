@extends('layouts.app')

@section('content')
    <section class="update-country">
        <form action="{{ route('dashboard.updateC')  }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input type="hidden" name="c_id" value="{{ $country->id }}">
            <label for="">
                <span>Country Name:</span><br>
                <input type="text" name="country_name" value="{{ $country->name }}">
            </label>
            <br>
            <button>Update</button>
        </form>
        <br>
        @if(session('u') == 'ok')
            <a href="{{ route('dashboard.showAll') }}" style="color: red;">See All</a>
        @endif
    </section>

@stop
