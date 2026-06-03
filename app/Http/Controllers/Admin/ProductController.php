<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;

class ProductController extends Controller
{
    // Danh sách sản phẩm
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->keyword) {
            $query->where('p_name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->p_status) {
            $query->where('p_status', $request->p_status);
        }

        if ($request->category) {
            $query->where('cate_id', $request->category);
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return view('admin.products.list', compact('products','categories'));
    }
    // Trang thêm sản phẩm
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.products.create', compact(
            'categories',
            'brands',
            'sizes',
            'colors'
        ));
    }

    // Lưu sản phẩm
    public function store(Request $request)
    {
        $request->validate([
            'p_name' => 'required',
            'cate_id' => 'required',
            'brand_id' => 'required',
        ]);

        // upload ảnh
        $imagePath = null;
        if ($request->hasFile('p_image')) {
            $imagePath = $request->file('p_image')->store('products', 'public');
        }

        // PHẢI gán vào biến
        $product = Product::create([
            'p_name' => $request->p_name,
            'cate_id' => $request->cate_id,
            'brand_id' => $request->brand_id,
            'p_desc' => $request->p_desc,
            'p_status' => $request->p_status,
            'p_image' => $imagePath
        ]);

        // kiểm tra có variant không
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                ProductVariant::create([
                    'p_id' => $product->p_id,
                    'size_id' => $variant['size_id'],
                    'color_id' => $variant['color_id'],
                    'pv_price' => $variant['price'],
                    'pv_stock' => $variant['stock'],
                    'pv_status' => 'active'
                ]);
            }
        }
        return redirect()->route('admin.products.list')->with('success', 'Thêm thành công');
    }

    // Trang chi tiết
    public function show($id)
    {
        $product = Product::with('category','brand')->findOrFail($id);
        return view('admin.products.detail', compact('product'));
    }

    // Trang sửa sản phẩm
    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.edit', compact(
            'product',
            'categories',
            'brands',
            'sizes',
            'colors'
        ));
    }

    // Update sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::with('variants')->findOrFail($id);
        // upload ảnh
        if ($request->hasFile('p_image')) {
            $imagePath = $request->file('p_image')->store('products', 'public');
            $product->p_image = $imagePath;
        }
        // update product
        $product->update([
            'p_name' => $request->p_name,
            'cate_id' => $request->cate_id,
            'brand_id' => $request->brand_id,
            'p_desc' => $request->p_desc,
            'p_status' => $request->p_status,
        ]);
        // UPDATE VARIANTS
        if ($request->has('variants')) {
            foreach ($request->variants as $index => $variant) {
                // nếu đã có variant → update
                if (isset($product->variants[$index])) {
                    $product->variants[$index]->update([
                        'size_id' => $variant['size_id'],
                        'color_id' => $variant['color_id'],
                        'pv_price' => $variant['pv_price'],
                        'pv_stock' => $variant['pv_stock'],
                    ]);
                } else {
                    // nếu chưa có → tạo mới
                    ProductVariant::create([
                        'p_id' => $product->p_id,
                        'size_id' => $variant['size_id'],
                        'color_id' => $variant['color_id'],
                        'pv_price' => $variant['pv_price'],
                        'pv_stock' => $variant['pv_stock'],
                        'pv_status' => 'active'
                    ]);
                }
            }
        }
        return redirect()->route('admin.products.list')->with('success', 'Cập nhật thành công');
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.products.list')->with('success', 'Xóa thành công');
    }
}