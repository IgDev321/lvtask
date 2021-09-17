@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('dashboard.country') }}" style="color:red; margin-bottom: 6px; "> Create Country </a> <br>
    <a href="{{ route('dashboard.region') }}" style="color:red;"> Create Region </a> <br>
    <br>
    <br>
    <a href="{{ route('dashboard.showAll') }}" style="color:red;">Show All</a>

</div>
@endsection
