<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCard;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductCardController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductCard::query();

        // Search filters
        if ($request->filled('sku')) {
            $query->where('sku', 'like', '%' . $request->sku . '%');
        }

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('product_group')) {
            $query->where('product_group', 'like', '%' . $request->product_group . '%');
        }

        if ($request->filled('expiration_date')) {
            $query->whereDate('expiration_date', '>=', $request->expiration_date);
        }

        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        // Default sorting
        if (!$request->has('sort')) {
            $query->orderBy('sku', 'asc');
        }

        // Paginate the results
        $product_cards = $query->paginate(10);

        return view('product_cards.index', compact('product_cards'));
    }

    public function create()
    {
        return view('product_cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:product_cards,sku',
            'product_name' => 'required',
            'product_group' => 'required',
            'expiration_date' => 'required|date',
            'description' => 'nullable',
        ]);

        ProductCard::create($request->only([
            'sku', 'product_name', 'product_group', 'expiration_date', 'description'
        ]));

        return redirect()->route('product_cards.index')
            ->with('success', 'ProductCard created');
    }

    public function edit($id)
    {
        $productCard = ProductCard::findOrFail($id);
        return view('product_cards.edit', compact('productCard'));
    }

    public function show(ProductCard $productCard)
    {
        return view('product_cards.show', compact('productCard'));
    }

    public function update(Request $request, $id)
    {
       //dd($id);
        $productCard = ProductCard::findOrFail($id);

        $productCard->update($request->only([
            'sku', 'product_name', 'product_group', 'expiration_date', 'description'
        ]));

        return redirect()->route('product_cards.index')
            ->with('success', 'ProductCard updated');
    }

    public function destroy(ProductCard $productCard)
    {
        $productCard->delete();

        return redirect()->route('product_cards.index')
            ->with('success', 'ProductCard deleted');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:product_cards,id',
        ]);

        ProductCard::whereIn('id', $request->ids)->delete();

        return redirect()->route('product_cards.index')
            ->with('success', 'Selected ProductCards deleted successfully');
    }

    public function exportSelectedToCSV(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:product_cards,id',
        ]);


        $selectedCards = ProductCard::whereIn('id', $request->ids)->get();

        if ($selectedCards->isEmpty()) {
            return redirect()->route('product_cards.index')
                ->with('error', 'No valid items selected for export.');
        }

        $response = new StreamedResponse(function () use ($selectedCards) {
            $handle = fopen('php://output', 'w');

            // Add the CSV headers
            fputcsv($handle, ['SKU', 'Product Name', 'Product Group', 'Expiration Date', 'Description']);

            // Write selected records to the CSV
            foreach ($selectedCards as $productCard) {
                fputcsv($handle, [
                    $productCard->sku,
                    $productCard->product_name,
                    $productCard->product_group,
                    $productCard->expiration_date,
                    $productCard->description,
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="selected_product_cards.csv"');

    return $response;
    }
}