@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">categories</div>

                    <div class="card-body">

                        <div class="row">

                            @foreach( $countries as $countrory)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>{{ $countrory->name }}</p>
                                    <p>Currency: {{ $countrory->currency }}</p>
                                    <p>Capital: {{ $countrory->capital }}</p>
                                </div>                                
                            </div>
                            @endforeach

                        </div>

                        {{ $countries->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection