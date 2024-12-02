<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $sort = $request->input('sort', 'asc');

        $products = Product::where(function($query) use ($keyword) {
            if (!empty($keyword)) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            }
        })->orderBy('price', $sort)->paginate(6);

        return view('search', compact('products', 'keyword', 'sort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpeg|max:2048',
        ]);

        $path = $request->file('image')->store('img/fruit-img', 'public');

        return back()->with('success', '画像がアップロードされました')->with('path', $path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($productId);
        if (!$product) {
            return view('register');
        }
        return view('show', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $product->delete();
        }

        return redirect('/products');
    }
}
