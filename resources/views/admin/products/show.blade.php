@extends('layouts.admin')

@include('layouts.admin-nav')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification(s) Produits</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
         
                <div class="card mb-3">
                    <div class="card-header">
                        utilisateur : 
                    </div>
                    <div class="card-body">
                        <div><h6>Nom:</h6> {{ $product->title }}</div>
                        <div><h6>Description:</h6> {{ $product->description }}</div>
                        <div><h6>Prix:</h6> {{ $product->price }}</div>
                        <div><h6>Quantité:</h6> {{ $product->stock }}</div>
                    </div>
                </div>
        </div>
    </div>
</div>

@stop
