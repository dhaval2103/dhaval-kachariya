<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class Productcontroller extends Basecontroller
{
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse($products, 'Products Retrieved successfully.');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);

        $input = $request->all();
        $product = Product::create($input);
        return $this->sendResponse($product, 'Product Created successfully.');
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->update($request->all());
        return $this->sendResponse($product, 'Product Updated successfully.');

        // $input = Product::find($request->id);
        // $input->name = $request->name;
        // $input->details = $request->details;
        // $input->save();
        // return $this->sendResponse($input, 'Product Updated successfully.');
    }

    public function delete(Request $request)
    {

        $product = Product::where('id', $request->id)->delete($request->id);
        return $this->sendResponse($product, 'Product Delete Successfully.');
    }
}
