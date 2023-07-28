<!-- resources/views/products/subcategories.blade.php -->
@if (count($subcategories) > 0)
    <ul class="sub-category">
        @foreach ($subcategories as $subcategory)
            <li>
                <a href="{{route('products.index',['category_id'=>$subcategory->id])}}">{{ $subcategory->name }}</a>
                @include('products.subcategories', ['subcategories' => $subcategory->subcategories])
            </li>
        @endforeach
    </ul>
@endif
