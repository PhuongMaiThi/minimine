<table id="product-list" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Thumbnail</th>
            <th>Category Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($products))
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 40px; height: auto;">
                        {{-- <img src="/{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-fluid" style="width: 40px; height: auto;"> --}}
                    </td>

                    <td>{{ $product->category->name }}</td>
                    <td><a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-secondary">Detail</a></td>
                    <td><a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info">Edit</a></td>
                    {{-- <td><a href="{{ route('admin.product.price.index', ['product_id' => $product->id]) }}" class="btn btn-info">Product Price Manage</a></td> --}}
                    {{-- <td><a href="{{ route('admin.product.promotion.index', ['product_id' => $product->id]) }}" class="btn btn-info">Product Promotion Manage</a></td> --}}
                    <td>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure DELETE PRODUCT?')" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{ $products->appends(request()->input())->links() }}