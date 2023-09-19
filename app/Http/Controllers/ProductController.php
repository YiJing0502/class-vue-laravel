<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    // 後台＿產品列表頁
    public function index() {
        $product = Product::orderBy('id', 'desc')->get()->map(function ($item) {
            // 資料多塞 timeFormat
            $item->timeFormat = $item->created_at->format('Y/m/d');
            return $item;
        });
        return Inertia::render('Backend/Product/Index', ['response' => rtFormat($product)]);
    }
    // 後台＿新增產品頁
    public function create() {
        return Inertia::render('Backend/Product/Create');
    }
    // 後台＿新增產品頁＿儲存新增
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|min:0',
            'public' => 'required|numeric',
            'desc' => 'required|max:255',
        ]);
        // dd($request->all());
        $product=Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'public' => $request->public,
            'desc' => $request->desc,
        ]);

        return back()->with(['message' => rtFormat($product)]);
    }
    // 後台＿編輯產品頁
    public function edit($id) {
        // 找到特定一支產品
        $product = Product::find($id);
        // 回傳頁面、產品資訊
        return Inertia::render('Backend/Product/Edit', ['response' => rtFormat($product)]);
    }
    // 後台＿編輯產品頁_儲存編輯
    public function update() {

    }
    // 後台＿刪除產品
    public function delete() {

    }
}
