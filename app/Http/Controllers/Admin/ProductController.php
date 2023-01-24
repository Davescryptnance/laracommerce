<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Iluminate\Support\Str;
use Illuminate\Validation\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductFormRequest $request)
    {
        dd($request);

        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = new Product();
        $product->category_id = $validatedData['category_id'];
        $product->name = $validatedData['name'];
        $product->slug = Str::slug($validatedData['slug']);
        $product->brand = $validatedData['brand'];
        $product->small_description = $validatedData['small_description'];
        $product->description = $validatedData['description'];
        $product->original_price = $validatedData['original_price'];
        $product->selling_price = $validatedData['selling_price'];
        $product->quantity = $validatedData['quantity'];
        $product->trending = $request->has('trending') ? 1 : 0;
        $product->status = $request->has('status') ? 1 : 0;
        $product->meta_title = $validatedData['meta_title'];
        $product->meta_keyword = $validatedData['meta_keyword'];
        $product->meta_description = $validatedData['meta_description'];
        $product->save();
    
        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';
    
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.'-'.$filename;
    
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $finalImagePathName;
                $productImage->save();
            }
        }
    
       redirect('index')->route('admin/products/index');
    }
    

}
