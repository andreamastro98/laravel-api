@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="display-5 fw-bolder mb-0 text-center"><span class="text-gradient d-inline">{{ $project->title }}</span></h1>
    <p class="my-4"><b>Description:</b> {{$project->description}}</p>
    <p class="my-4"><b>Customer:</b> {{$project->customer}}</p>
    @if ($project->type)
        <p class="my-4"><b>Type:</b> {{$project->type->name}}</p>
    @endif
</div>

@endsection