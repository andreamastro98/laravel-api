@extends('layouts.app')

@section('content')

<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Projects</span></h1>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-11 col-xl-9 col-xxl-8">
                <!-- Project Card 1-->
                @foreach ($projects as $elem)
                    <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center">
                                <div class="p-5 desc">
                                    <h2 class="fw-bolder">{{$elem->title}}</h2>
                                    @if ($elem->type)
                                        <h6 class="fw-bolder">{{$elem->type->name}}</h6>
                                    @endif                                    
                                    <p>{{$elem->description}}</p>
                                    <div> 
                                        <a class="btn btn-primary" href="{{ route('show', $elem->id )}}">Show</a>
                                    </div>
                                </div>
                                <img class="img-fluid" src="{{ asset('/storage/' . $elem->cover_image)}}" alt="..."/>
                            </div>
                        </div>
                        
                    </div>                                
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection