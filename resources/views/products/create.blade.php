<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark">
        <h3 class="text-white text-center">Create Product</h3>
    </div>
    <div class="container mt-9 w-50 border-2 border-black shadow-lg p-3 mb-5 bg-body rounded">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="col text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Back to List
                    </a>
                </div>
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" id="productName" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productSku" class="form-label">Sku</label>
                <input type="text" value="{{ old('sku') }}"
                    class="form-control @error('sku') is-invalid @enderror" id="productSku" name="sku" required>
                @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Product Price</label>
                <input type="number" value="{{ old('price') }}"
                    class="form-control @error('price') is-invalid @enderror" id="productPrice" name="price" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea class="form-control value="{{ old('description') }}" @error('description') is-invalid @enderror"
                    id="productDescription" name="description" rows="3"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input class="form-control value="{{ old('image') }}" @error('image') is-invalid @enderror"
                    type="file" id="productImage" name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
</body>

</html>
