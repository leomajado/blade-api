@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Posts') }}</div>

                    <div class="card-body">

                        @if (!empty($user))

                            <div class="alert alert-success" role="alert">
                                <h3>{{ 'All Posts' }}</h3>
                            </div>

                            @foreach ($posts as $p)

                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">{{ $p['title'] }}</h4>
                                    <p>{{ $p['description'] }}</p>
                                    <p class="mb-0"></p>
                                </div>

                            @endforeach

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
