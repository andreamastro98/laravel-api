@extends('layouts.app')

@section('content')

<section class="py-5">
                <div class="container px-5 mb-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Create Project</span></h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-11 col-xl-9 col-xxl-8">
                            <!-- form project-->
                            <form action="{{ route( 'admin.project.store' ) }}" method="POST" enctype="multipart/form-data">
                            
                                @csrf
                            
                                <div class="form-group mb-3">
                                    <label for="project-title" class="form-label">Title</label>
                                    <input type="text" id="comic-title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci title">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="project-customer" class="form-label">Customer</label>
                                    <input type="text" id="project-customer" name="customer"  class="form-control">
                                </div>
                            
                                <div class="form-group mb-3">
                                    <label for="project-description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="project-description" cols="30" rows="10"></textarea>
                                </div>

                                {{-- file input --}}
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Default file input example</label>
                                    <input class="form-control" type="file" id="formFile" name="cover_image">
                                </div>

                                {{-- select --}}
                                <label for="projectType" class="form-label">Project Type</label>
                                <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example" name="type_id">

                                    <option value="">-- Scegli una categoria --</option>

                                    @foreach ($types as $elem)
                                        <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                    @endforeach
                                    @error('type_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror                                    
                                </select>

                                {{-- checkbox per le tecnologies --}}

                                <label for="projectTechnology" class="form-label my-3">Project Technology</label>

                                @foreach ($technologies as $elem)
                                    <div class="form-check">
                                    <input class="form-check-input" 
                                        type="checkbox" 
                                        value="{{ $elem->id }}"
                                        name="technologies[]" 
                                        id="project-checkbox-{{ $elem->id }}">
                                    <label class="form-check-label" for="project-checkbox-{{ $elem->id }}">
                                        {{ $elem->name }}
                                    </label>
                                </div>
                                @endforeach
                                

                                 <button type="submit" class="btn btn-primary mt-5">Create Project</button>

                            </form>                         
                        </div>
                    </div>
                </div>
            </section>

@endsection