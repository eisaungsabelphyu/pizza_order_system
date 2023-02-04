<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    //direct user contact page
    public function contact(){
        return view('user.main.contact');
    }

    //save user contact data
    public function createContact(Request $request){
        $this->contactValidationCheck($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return back()->with(['receiveMessage' => 'We receive your message.Thank you']);
    }

    //contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ])->validate();
    }

    //get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at'=>Carbon::now(),
        ];
    }

    //contact list
    public function contactList(){
        $contact = Contact::orderBy('created_at')->paginate(5);
        return view('admin.contact.list',compact('contact'));
    }

    //contact delete
    public function contactDelete($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Data deleted!']);
        
    }

}
