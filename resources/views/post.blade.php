@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-bottom: -10px !important;">

                <div class="card">

                    <div class="card-header">{{ 'All Posts' }}</div>

                    @if (!empty($user))

                        @php
                            $i=0;
                            $alerts = ['success','primary','warning','secondary','danger'];
                        @endphp

                        <div class="card-body" style="margin-bottom: -15px !important;">

                            @foreach ($posts as $p)

                                <x-postcard :title="$p['title']" :body="$p['description']" :color="$alerts[$i]" />

                                @php if($i==4) { $i=0; } else { $i+=1; } @endphp

                            @endforeach

                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
