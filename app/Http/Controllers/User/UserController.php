<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $product = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();//history data
        return view('user.main.home',compact('product','category','cart','order'));
    }

    //cart list
    public function cartList(){
        $cart = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                ->leftJoin('products','carts.product_id','products.id')
                ->where('carts.user_id',Auth::user()->id)->get();
        $totalPrice = 0;
        foreach($cart as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cart','totalPrice'));
    }

    //get filter data
    public function filter($categoryId){
        $product = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
         $cart = Cart::where('user_id',Auth::user()->id)->get();
         $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','order'));
    }

    //history data
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        
        return view('user.main.history',compact('order'));
    }

    //pizza details direct page
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //user change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request){
         $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbHashPassword)){
            $data = [
                "password" => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['changeSuccess' => 'Success Password Changing']);
        }
            return back()->with(['notMatch' => 'The old passsword not match.Try Again!']);
    }

    //user account change
    public function accountChangePage(){
        return view('user.account.change');
    }

    //account change
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);

            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Data Update Success']);

    }
    //update validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,jfif|file',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }

    //get update request data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' =>Carbon::now(),
        ];
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }

    //direct user list page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    //user change role
    public function userChangeRole(Request $request){
        User::where('id',$request->userId)
                ->update([
                    'role' => $request->role,
                ]);
    }

    //user list delete
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess'=>'Data delete success']);
    }


}
