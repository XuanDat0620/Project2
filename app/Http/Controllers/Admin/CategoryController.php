<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Lấy danh sách danh mục
    public function index(Request $request)
    {
        $query = Category::query();

        // search
        if ($request->keyword) {
            $query->where('cate_name', 'like', '%' . $request->keyword . '%');
        }

        // filter status
        if ($request->status) {
            $query->where('cate_status', $request->status);
        }

        $categories = $query->orderBy('cate_id', 'desc')->paginate(10);
        return view('admin.categories.list', compact('categories'));
    }

    //Tạo danh mục
    public function create()
    {
        return view('admin.categories.create');
    }

    //Lưu danh mục
    public function store(Request $request)
    {
        $request->validate([
            'cate_name' => 'required|max:255',
            'cate_status' => 'required',
        ]);

        Category::create([
            'cate_name' => $request->cate_name,
            'cate_desc' => $request->cate_desc,
            'cate_status' => $request->cate_status,
        ]);

        return redirect()->route('admin.categories.list')->with('success','Thêm thành công');
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.detail', compact('category'));
    }

    //Hiển thị giao diện sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
    }

    //Cập nhật thông tin danh mục
   public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'cate_name' => $request->cate_name,
            'cate_desc' => $request->cate_desc,
            'cate_status' => $request->cate_status,
        ]);

        return redirect()->route('admin.categories.list')->with('success','Cập nhật thành công');
    }

    //Xóa danh mục
    public function delete($id)
    {
        Category::destroy($id);
        return redirect()->route('admin.categories.list')->with('success','Xóa thành công');
    }
    
}