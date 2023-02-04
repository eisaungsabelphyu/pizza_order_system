<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RouteController extends Controller
{
    //get all data
    public function getData(){

        $products = Product::get();

         return response()->json($data, 200);
    }

    //get user list
    public function userList(){
        $users = User::get();

        return response()->json($users, 200);
    }

    //get order list
    public function orderList(){
        $orders = Order::get();

         return response()->json($orders, 200);
    }

    //get category list
    public function categoryList(){
        $categories = Category::get();
        return response()->json($categories, 200);
    }

    //create category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);

        return response()->json($response, 200);
    }

    //delete category
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => 'success','message'=>'Data delete success','delete data'=>$data], 200);
        }
        return response()->json(['status'=>'fail','message'=>'There is no that category'], 500);
    }

    //category details
    public function categoryDetails(Request $request){
        $data = Category::where('id',$request->id)->first();

        if(isset($data)){
            return response()->json(['status' => 'true','category'=>$data], 200);
        }
        return response()->json(['status'=>'false','message'=>'There is no category'], 500);
    }

    //update category
    public function updateCategory(Request $request){
       $categoryId = $request->category_id;
       $dbSource = Category::where('id',$categoryId)->first();

       if(isset($dbSource)){
        $data = $this->getCategoryData($request);
        Category::where('id',$categoryId)->update($data);
        $response = Category::where('id',$categoryId)->first();
        return response()->json(['status'=>'true','message'=>'Data update Successful','category'=>$response], 200);

       }
       return response()->json(['status'=>'false','message'=>'There is no category...'], 500);
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ];
    }
}
