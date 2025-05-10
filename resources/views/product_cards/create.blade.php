<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Add Product Card</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="{{ route('product_cards.index') }}">Product Cards Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Add New Product Card</h3>
        <form action="{{ route('product_cards.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="sku">Product Code</label>
                <input type="text" name="sku" class="form-control" id="sku" required>
            </div>
            <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="name" required>
            </div>
            <div class="form-group mb-3">
                <label for="group">Product Group</label>
                <input type="text" name="product_group" class="form-control" id="group" required>
            </div>
            <div class="form-group mb-3">
                <label for="expiration_date">Expiration Date</label>
                <input type="date" name="expiration_date" class="form-control" id="expiration_date" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
            </div>
            <!-- Buttons aligned side by side -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Create Product Card</button>
                <a href="{{ route('product_cards.index') }}" class="btn btn-secondary">Back</a>
            </div>
            
        </form>
    </div>

</body>

</html>
