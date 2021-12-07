<?php

namespace App\Http\Controllers\category;

use App\DataTables\CategoryDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageValidation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category(CategoryDatatable $request)
    {
        return $request->render('auth.crud.category');
    }
    public function addcategory(ImageValidation $request)
    {

        // $input = $request->all();
        // if ($request->file('image')) {
        //     $imageName = $request->file('image');
        //     $destinationPath = 'images/';
        //     $profileImage = time() . "." . $imageName->extension();
        //     $imageName->move($destinationPath, $profileImage);
        //     if ($input['frmid']) {
        //         $cust = Category::find($input['frmid']);
        //         @unlink($cust->image);
        //     }
        //     $input['image'] = $profileImage;
        // }
        
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        if ($request->file('image') == "") {
            $cust = DB::table('categories')->where('id', $input['frmid'])->first();
            $input['image'] = $cust->image;
        }

        if ($input['frmid']) {
            $arr = [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $input['image']
            ];

            Category::where('id', $input['frmid'])->update($arr);
            return response()->json('1');
        }

        $add = new Category;
        $add->title = $request->title;
        $add->description = $request->description;
        $add->image = $input['image'];
        $add->save();
        return response()->json('1');


    }

    public function deleteform(Request $req)
    {

        $imageName = Category::find($req->id);
        unlink('images/' . $imageName->getRaworiginal('image'));
        Category::where("id", $imageName->id)->delete();
        return response()->json('1');

        $id = $req->id;
        $query = Category::find($id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }

    public function editcategory(Request $req)
    {
        $where = array('id' => $req->id);
        $query  = Category::where($where)->first();

        return Response()->json($query);
    }
}
