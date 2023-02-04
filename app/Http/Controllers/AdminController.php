<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        /**
         * 1-all field must be filled
         * 2.new & confirm password must be greater than 6 & same less than 10
         * 3.client old password must be same with db password
         * 4.pw change
         */
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

    //direct admin detail page
    public function details(){
        return view('admin.account.details');
    }

    //direct edit profile page
    public function edit(){
        return view('admin.account.edit');
    }

    //direct update
    public function update($id,Request $request){
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Data Update Success']);

    }

    // //change role page
    // public function changeRole($id){
    //     $data = User::where('id',$id)->first();
    //     return view('admin.account.changeRole',compact('data'));
    // }
    // //change role
    // public function change($id,Request $request){
    //     $data = $this->getRequestData($request);
    //     User::where('id',$id)->update($data);
    //     return redirect()->route('admin#list')->with(['updateSuccess'=>'Change Role Success']);
    // }

    // private function getRequestData($request){
    //     return [
    //         'role' => $request->role,
    //     ];
    // }
    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }
    //delete admin list
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess'=>'Data delete successful!']);
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

    //ajax change role
    public function ajaxChangeRole(Request $request){
        logger($request->all());
       User::where('id',$request->adminId)
                ->update(
                    ['role' => $request->role]
                );


    }
}
