<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()->with('category');

        if ($request->filled('q')) {
            $query->search($request->query('q'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->query('category'));
        }

        $products = $query->latest('id')->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $data['specifications'] = $this->parseSpecifications($request->input('specifications_raw'));

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->input('image_url');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        $specificationsRaw = $this->formatSpecifications($product->specifications);

        return view('admin.products.edit', compact('product', 'categories', 'specificationsRaw'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $data['specifications'] = $this->parseSpecifications($request->input('specifications_raw'));

        if ($request->hasFile('image')) {
            if ($product->image_path && !str_starts_with($product->image_path, 'http') && !str_starts_with($product->image_path, 'images/')) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->input('image_url');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image_path && !str_starts_with($product->image_path, 'http') && !str_starts_with($product->image_path, 'images/')) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus dari katalog.');
    }

    private function parseSpecifications(?string $raw): ?array
    {
        if (blank($raw)) {
            return null;
        }

        $lines = preg_split('/\r\n|\r|\n/', trim($raw));
        $specs = [];

        foreach ($lines as $line) {
            if (str_contains($line, ':')) {
                [$key, $value] = explode(':', $line, 2);
                $keyTrim = trim($key);
                if (!empty($keyTrim)) {
                    $specs[$keyTrim] = trim($value);
                }
            }
        }

        return !empty($specs) ? $specs : null;
    }

    private function formatSpecifications(?array $specs): string
    {
        if (empty($specs)) {
            return '';
        }

        $lines = [];
        foreach ($specs as $key => $val) {
            $lines[] = "{$key}: {$val}";
        }

        return implode("\n", $lines);
    }
}
