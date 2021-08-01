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

                            @foreach( $reviews as $review)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>Customer: {{$review->customer->formattedName()}} </p>
                                    <p>Product: {{$review->product->title}} </p>                                      
                                    <p>Stars: 

                                        <!-- Display stars same as reviews -->
                                        {{--
                                        @for( $i = 0; $i < $review->stars; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor --}}

                                        <!-- Display stars same as reviews out of Total stars (5) -->
                                        @php 
                                            $total = 5;
                                            $currentStars = $review->stars;
                                            $remainingStars = $total - $currentStars;                                        
                                        @endphp
                                        @for( $i = 0; $i < $review->stars; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                        @for( $i = 0; $i < $remainingStars; $i++)
                                        <i class="far fa-star"></i>
                                        @endfor

                                    </p> 


                                    <p>Review: {{ $review->review }}</p>
                                    <p>Date: {{ $review->humantFormattedDate() }}</p>
                                </div>                                
                            </div>
                            @endforeach

                        </div>

                        {{ $reviews->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection