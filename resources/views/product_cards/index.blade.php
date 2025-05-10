<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Product Card Dashboard</title>
    <style>
        .selected {
            background-color: #ffe8a1 !important; /* Highlight selected rows */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="{{ route('product_cards.index') }}">Product Cards Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="mb-4">Product Cards</h3>

        <!-- Search and Filter Form with Add Product Button -->
        <form action="{{ route('product_cards.index') }}" method="GET" class="row mb-4 align-items-center">
            <div class="col-md-2">
                <input type="text" name="sku" class="form-control" placeholder="Search by SKU" value="{{ request()->sku }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="product_name" class="form-control" placeholder="Search by Name" value="{{ request()->product_name }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="product_group" class="form-control" placeholder="Search by Group" value="{{ request()->product_group }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="expiration_date" class="form-control" placeholder="Search by Expiration Date" value="{{ request()->expiration_date }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
            <div class="col-md-2 text-end">
                <a href="{{ route('product_cards.create') }}" class="btn btn-success w-100">Add Product Card</a>
            </div>
        </form>

        <!-- Product Cards Table with Sorting -->
        <form id="bulkActionForm" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th><a href="{{ route('product_cards.index', ['sort' => 'sku', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}">Product Code</a></th>
                        <th><a href="{{ route('product_cards.index', ['sort' => 'product_name', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}">Product Name</a></th>
                        <th><a href="{{ route('product_cards.index', ['sort' => 'product_group', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}">Group</a></th>
                        <th><a href="{{ route('product_cards.index', ['sort' => 'expiration_date', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}">Expiration Date</a></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_cards as $productcard)
                        <tr class="product-row">
                            <td><input type="checkbox" name="ids[]" value="{{ $productcard->id }}" class="bulkCheckbox"></td>
                            <td>{{ $productcard->sku }}</td>
                            <td>{{ $productcard->product_name }}</td>
                            <td>{{ $productcard->product_group }}</td>
                            <td>{{ $productcard->expiration_date }}</td>
                            <td>
                                <a href="{{ route('product_cards.edit', $productcard) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('product_cards.destroy', $productcard) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Bulk Actions -->
            <div class="mt-3">
                <button type="button" id="bulkDeleteButton" class="btn btn-danger btn-sm">Delete Selection</button>
                <button type="button" id="exportSelectedButton" class="btn btn-secondary btn-sm">Export Selected</button>
            </div>
        </form>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $product_cards->links() }}
        </div>
    </div>

    <script>
        // Select all checkboxes
        document.getElementById('selectAll').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.bulkCheckbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // Bulk Delete button
        document.getElementById('bulkDeleteButton').addEventListener('click', function () {
            if (confirm('Are you sure you want to delete selected items?')) {
                const form = document.getElementById('bulkActionForm');
                form.action = "{{ route('product_cards.bulk_delete') }}";
                form.method = "POST";
                form.submit();
            }
        });

        // Export Selected button
        document.getElementById('exportSelectedButton').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.bulkCheckbox:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one item to export.');
                return;
            }
            const form = document.getElementById('bulkActionForm');

            // Remove any existing _method field to avoid conflicts
            const methodInput = document.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }

            form.action = "{{ route('product_cards.export_selected') }}";
            form.method = "POST";
            form.submit();
        });
    </script>

</body>

</html>