@extends('layouts.customer')
@section('content')
<div class="row row-cols-1 row-cols-md-3 g-4 m-5">
    @foreach ($services as $service)
    @if($service->visibility==1)
    <div class="col">
        <div class="card h-100">
            <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top"
                alt="Hollywood Sign on The Hill" />
            <div class="card-body">
                <h5 class="card-title">{{$service->service_name}}</h5>
                <p class="card-text">
                    {{$service->service_description}}
                </p>
                <div class="row">
                    <div class="column">
                        <p>{{$service->duration}} minutes</p>
                    </div>
                    <div class="column" style="text-align:right">
                        <p>RM {{$service->price}}</p>
                    </div>
                </div>
                <p><button>Select</button></p>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection