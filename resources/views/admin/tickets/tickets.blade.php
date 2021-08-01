@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">tickets</div>

                    <div class="card-body">

                        <div class="row">

                            @foreach( $tickets as $ticket)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>{{ $ticket->customer->formattedName() }}</p>
                                    <p>status: {{$ticket->status}} </p>
                                    <p>title: {{$ticket->title}} </p>
                                </div>                                
                            </div>
                            @endforeach

                        </div>

                        {{ $tickets->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection