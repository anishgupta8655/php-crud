<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-2">
        <h3 class="text-white text-center">Edit Product</h3>
    </div>

    <div class="container mt-5 w-50 border-2 border-black shadow-lg p-4 mb-5 bg-body rounded">

        <!-- Back Button -->
        <div class="mb-4 text-end">
            <a href="{{ route('products.index') }}" class="btn btn-success">
                &larr; Back to List
            </a>
        </div>

        <!-- Update Form -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" value="{{ old('name', $product->name) }}"
                    class="form-control @error('name') is-invalid @enderror" id="productName" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- SKU -->
            <div class="mb-3">
                <label for="productSku" class="form-label">SKU</label>
                <input type="text" value="{{ old('sku', $product->sku) }}"
                    class="form-control @error('sku') is-invalid @enderror" id="productSku" name="sku" required>
                @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" value="{{ old('price', $product->price) }}" step="0.01"
                    class="form-control @error('price') is-invalid @enderror" id="productPrice" name="price" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="productDescription" name="description"
                    rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="productImage"
                    name="image">
                @if ($product->image)
                    <div class="mt-2">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="120"
                            class="img-thumbnail">
                    </div>
                @endif
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Update Product</button>
        </form>
    </div>
</body>

</html>
