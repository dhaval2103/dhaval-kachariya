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
        $product = Product::find($request->id);
        if (is_null($product)) {
            return $this->sendError('Product Not Found.');
        }
        return $this->sendResponse($product, 'Product Retrieved Successfully');
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
                "message" => "File successfully uploaded",
            ]);
        }
    }
}
