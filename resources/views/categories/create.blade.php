<!-- resources/views/categories/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Category</div>
                    <br>
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group form-vertical-spacing">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group form-vertical-spacing">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-margin">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
