@extends('layouts.app')


@section('content')

    <section style="border: 1px solid rebeccapurple; margin: 15px auto; width: 50%; display: flex; justify-content: center; padding: 5px;">
        <form action="{{ route('dashboard.createRegion') }}" method="POST">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <label for="">
                <span>Region name:</span><br>
                <input type="text" name="region_name">
            </label>
            <br>
            <br>
            <label for="">
                <span>Select Country:</span><br>
                <select name="country" id="">
                    <option selected>Choose:</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <br>
            <button>Submit</button>
        </form>
    </section>

    @if(session('created') == 'ok')
       <p style="text-align: center;">
           <a href="{{ route('dashboard') }}" style="color: red;"> Now you can modify your created data </a>
           or
           <a href="{{  }}" style="color: red;"> View all</a>
       </p>
    @endif

@stop
