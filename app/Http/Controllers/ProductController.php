<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;

class ProductController extends Controller
{

    /**
     * Displaying a list of the products
    */
    function index(){
        $products = Product::paginate(5);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Displaying the form for adding a new Product
    */
    function add(){
        // Retrieving categories
        $categories = Category::get();
        // Retrieving suppliers (only the first three columns will be retrieved)
        $suppliers = Supplier::select(array('id', 'first_name', 'last_name'))->get();
        //Passing Data to the view                                 
        return view('products.add', ['categories' => $categories, 'suppliers' => $suppliers]);
    }

    /**
     * Storing the newly created product
     */
    function store(ProductRequest $request){
        //If the request is valid(validation is done in ProductRequest class) 
        //store the newly added product and return a success message
        Product::create($request->all());
        return back()->with('success', 'Product added successfully!');
    }

    /**
     * Displaying the form for updating a product
    */
    function edit($id){
        // Retrieving categories and suppliers
        $categories = Category::get();
        $suppliers = Supplier::select(array('id', 'first_name', 'last_name'))->get();
        //Retrieving the product info 
        $product = Product::find($id);
        return view('products.edit', ['product' => $product, 'categories' => $categories, 'suppliers' => $suppliers]);
    }

    /**
     * Updating a product
    */
    function update(ProductRequest $request, $id){
        // Retrieving the product
        $product = Product::find($id);
        //Updating the fields
        $product->label =  $request->label;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->quantity = $request-> quantity;
        $product->supplier_id = $request->supplier_id;
        $product->buying_cost = $request->buying_cost;
        $product->selling_cost = $request->selling_cost;
        $product->save();
        //If updated successully redirect back with success message
        return back()->with('success', 'Product updated successfully!');
    }

    /**
     * Deleting a product 
    */
    function delete($id){
        //Retrieving the product from database and deleting it
        Product::destroy($id);
        return back()->with('succees','Deleted successfully!');
    }
}
