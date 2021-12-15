<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Nette\Utils\Validators;

class Productcontroller extends Basecontroller
{
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse($products, 'Products Retrieved Successfully.');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'price' => 'required',
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
    }

    public function delete(Request $request)
    {
        $product = Product::where('id', $request->id)->delete($request->id);
        return $this->sendResponse($product, 'Product Delete Successfully.');
    }

    public function search(Request $request)
    {
        $result = Product::where('name', 'LIKE', '%' . $request->name . '%')->get();
        if (count($result)) {
            return response()->json($result);
        } else {
            return response()->json(['Result' => 'No Data Found'], 404);
        }
    }

    public function productshow(Request $request)
    {
        // $product = Product::orderBy('price')->get();
        // if (is_null($product)) {
        //     return $this->sendError('Product Not Found.');
        // }
        // return $this->sendResponse($product, 'Product Retrieved Successfully');

        $limit = $request->pagesize ? $request->pagesize : 0;
        $start = $request->lastid ? $request->lastid : 10;
        $product = Product::where('id', '>', $start)->limit($limit)->orderBy('price');
        // $product = Product::where('id', '>', $start)->limit($limit)->orderBy('price', 'desc');
        if ($request->search) {
            $product = $product->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        if ($min_price && $max_price) {
            $product->whereBetween('price', [$min_price, $max_price]);
        }
        $result = $product->get();
        if (is_null($result)) {
            return $this->sendError('Product Not Found.');
        }
        return $this->sendResponse($result, 'Product Display Successfully.');
    }

    public function fileupload(Request $request)
    {
        $input = $request->all();
        if ($request->file('image')) {
            $imageName = $request->file('image');
            $destinationPath = 'images/';
            $profileImage = time() . "." . $imageName->extension();
            $imageName->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;

            $add = new Category();
            $add->title = $request->title;
            $add->description = $request->description;
            $add->image = $input['image'];
            $add->save();
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded.",
            ]);
        }
    }
}
