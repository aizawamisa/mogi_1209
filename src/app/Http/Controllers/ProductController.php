<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;

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

        if (!in_array($sort, ['asc', 'desc'])) {
            $sort = 'asc';
        }

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
    public function store(ProductRequest $request)
    {
        $path = $request->file('image')->store('img/fruit-img', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => basename($path),
        ]);

        foreach ($request->season_id as $seasonId) {
            ProductSeason::create([
                'product_id' => $product->id,
                'season_id' => $seasonId,
            ]);
        }

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('seasons')->find($id);
        if (!$product) {
            return view('register');
        }

        $allSeasons = Season::all();

        return view('show', compact('product', 'allSeasons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if ($request->hasFile('image')) {

            $newImagePath = $request->file('image')->store('img/fruit-img', 'public');
            $product->image = basename($newImagePath);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image,
        ]);

        ProductSeason::where('product_id', $product->id)->delete();

        if (!empty($request->season_id)) {
            foreach ($request->season_id as $seasonId) {
                ProductSeason::create([
                    'product_id' => $product->id,
                    'season_id' => $seasonId,
                ]);
            }
        }

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }

        return redirect('/products');
    }
}
