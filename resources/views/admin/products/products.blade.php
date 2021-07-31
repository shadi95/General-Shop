@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">Products</div>

                    <div class="card-body">

                        <div class="row">

                            @foreach( $products as $product)
                            <div class="col-md-4">
                                <div class="alert alert-primary" role="alert">
                                <h5>{{$product->title}}</h5>
                                    <p> Category: {{$product->category->name}} </p>
                                    <p>Price: {{$currencyCode}}{{$product->price}} </p>
                                    <!-- Here use If statment to display product's image if not have will not show empty img src => better for serarch engine -->
                                    {!! ( count($product->images) > 0 ) ? '<img class="img-thumbnail, card-img" src="'. $product->images[0]->url.'"/>' : '' !!}
                                </div>                                
                            </div>
                            @endforeach

                        </div>

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection