@extends('layouts.app')

@section('content')
    @auth
       <section style="border: 1px solid rebeccapurple; margin: 15px auto; width: 50%; display: flex; justify-content: center;  padding: 5px;">
           <form action="{{ route('dashboard.createCountry') }}" method="POST">
               <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
               <label for="">
                   <span>Country name:</span><br>
                   <input type="text" name="country_name">
               </label>
               <br>
               <br>
               <button>Submit</button>
           </form>
       </section>

        @if(session('ok') == 'isOk')
            <a href="{{ route('dashboard.region') }}" style="color: red; text-align: center;"> Create Region</a>
        @endif

    @else
        Please Log in for create Country <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
    @endauth
@stop
