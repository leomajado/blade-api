@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-bottom: -10px !important;">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h3>{{ __('All Posts') }}</h3>
                            </div>
                            <div class="col-md-6 mt-1" align="right">
                                <button type="button" class="btn btn-success" id="myBtn" data-toggle="modal" data-target="#myModal">
                                    Add New Post
                                </button>
                            </div>
                        </div>
                    </div>

                    @if (!empty($user))
                        @php
                            $i = 0;
                            $alerts = ['success', 'primary', 'warning', 'secondary', 'danger'];
                        @endphp

                        <div class="card-body" style="margin-bottom: -15px !important;">

                            @foreach ($posts as $p)

                                <x-post-card
                                    :id="$p['id']"
                                    :title="$p['title']"
                                    :body="$p['description']"
                                    :color="$alerts[$i]"
                                />

                                @php
                                    if ($i == 4) {
                                        $i = 0;
                                    } else {
                                        $i += 1;
                                    }
                                @endphp

                            @endforeach

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <x-post-add />

@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>
