<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4" style="margin-bottom: 20em">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="margin-bottom: 1em">Product List</div>
                    <div class="card-body">
                        <div class="category-dropdowns" style="display: flex">
                            @foreach($categories as $category)
                                @if ($category->parent_id === null)
                                    <ul class="main-category btn btn-success" style="width:12%;margin: 0 0 0 2em">
                                        <li>
                                            <a href="#">{{ $category->name }}
                                                <i class="arrow down" style="margin-left: .5em"></i>
                                            </a>
                                            @if (count($category->subcategories) > 0)
                                                @include('products.subcategories', ['subcategories' => $category->subcategories])
                                            @endif
                                        </li>
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td><button><a style="margin: 0 1em" href="{{ route('products.edit', $product->id) }}">Edit</a></button>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <!-- Custom CSS Styles for the Dropdowns -->
    <style>
        .category-dropdowns {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .main-category {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .main-category > li {
            position: relative;
            margin-bottom: 5px;

            border: 1px solid #0000004d;
            text-align: center;
            padding: 1em;
            border-radius: 5px;
        }

        .main-category > li > a {
            color: #4CAF50;
            font-weight: bold;
        }

        .main-category li:hover > ul {
            display: block; /* Show immediate subcategories on hover */
        }

        .main-category li ul {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            min-width: 150px;
            z-index: 1;
            list-style: none; /* Remove bullet points for subcategories */
            margin: 0;
        }

        .main-category li ul li {
            position: relative;
            border-bottom: 1px solid #eee;
            padding: 1em;
        }

        .main-category li ul a {
            color: #666;
            text-decoration: none;
        }

        .main-category li ul a:hover {
            color: #333;
        }

        /* Nested subcategories styles */
        .main-category li ul ul {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            min-width: 150px;
            z-index: 1;
            list-style: none; /* Remove bullet points for subcategories */
            margin: 0;
            top: 0;
            left: 100%;
        }

        .main-category li ul li:hover > ul {
            display: block; /* Show nested subcategories on hover */
        }

         .table {
             width: 100%;
             margin-bottom: 1rem;
             background-color: #fff;
             color: #212529;
         }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Custom styles */
        .table th {
            background-color: #f8f9fa;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .arrow {
            border: solid rgba(0, 0, 0, 0.45);
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
        }

        .right {
            transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
        }

        .left {
            transform: rotate(135deg);
            -webkit-transform: rotate(135deg);
        }

        .up {
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }

        .down {
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }
    </style>
