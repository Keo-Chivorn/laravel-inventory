@php
    use App\Models\Product;
@endphp
@extends('layout.base')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        @php
            $color = $colors[rand(0, count($colors)-1)];
        @endphp
        <div class="card border-left-{!! $color !!} shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-{!! $color !!} text-uppercase mb-1">
                            Total quantity of all products
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{!! Product::all()->sum("quantity") !!}</div>
                    </div>
                    <div class="col-auto">
                        {{-- <i class="fas fa-calculator"></i> --}}
                        <i class="fas fa-calculator fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        @php
            $color = $colors[rand(0, count($colors)-1)];
        @endphp
        <div class="card border-left-{!! $color !!} shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-{!! $color !!} text-uppercase mb-1">
                            Welcome to 
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Inventory Management System</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    @foreach ($categories as $category)
    @php
        $color =  $colors[rand(0, count($colors)-1)];
    @endphp
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-{!! $color  !!} shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-{!! $color !!} text-uppercase mb-1">
                            {!! $category->name ?? "N/A" !!}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{!! $category->products->sum('quantity') !!}</div>
                    </div>
                    <div class="col-auto">
                        <img src="{!! asset("uploads/images/categories/$category->image") !!}" alt="Sorry" width="50">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach




    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach (range(1,2) as $index)
                    <div class="carousel-item {!! $index == 1 ? 'active' : '' !!}">
                        <img class="d-block w-100" src="{{ asset("img/slideshow$index.jpg")}}" alt="First slide">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    @endsection