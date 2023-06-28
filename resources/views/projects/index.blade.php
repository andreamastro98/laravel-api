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
                                                    <p class="my-4"><b>Type:</b> {{$elem->type->name}}</p>
                                                @endif
                                                <p>{{$elem->description}}</p>

                                                <div class="mb-1"> 
                                                    <a class="btn btn-primary" href="{{ route('admin.project.show', $elem )}}">Show</a>
                                                </div>

                                                <a class="btn btn-warning mb-1" href="{{ route('admin.project.edit', $elem) }}">Edit</a>

                                                <form action=" {{ route('admin.project.destroy', $elem) }} " method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('vuoi davvero cancellare il progetto?')" class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </div>
                                            <img class="img-fluid" src="{{ asset('/storage/' . $elem->cover_image)}}" alt="..." />
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <a class="btn btn-primary" href="{{ route('admin.project.create', $elem )}}">Add one Project</a>
                            

                        </div>
                    </div>
                </div>
            </section>

@endsection