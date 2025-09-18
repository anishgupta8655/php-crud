<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="bg-dark py-2 mb-4">
        <h3 class="text-white text-center">Product List</h3>
    </div>

    <div class="container mt-4 w-75 border-2 border-black shadow-lg p-4 bg-body rounded">
        <div class="row mb-3 justify-content-between align-items-center">
            <div class="col">
                <h2>All Products</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Add Product
                </a>
            </div>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        
        {{-- Product Table --}}
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @forelse ($products as $product)
                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->description }}</td>
                        <td class="text-center">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100"
                                    class="img-thumbnail">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>


                        <td class="text-center">
                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <!-- Delete  Button -->
                            <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                    @php
                        $i++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</body>

</html>
