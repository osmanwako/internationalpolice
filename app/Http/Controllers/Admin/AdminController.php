<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Memberrestore;
use App\Models\Internatpolice;
use App\Models\Flight;
class AdminController extends Controller
{
   
    public function readpdf( $filename)
    {
    $path = public_path('storage/image/profile/member/'.$filename);
    return response()->download($path);
        
    }
    public function showlogin()
    {
        return view("interpol.login");
    }
    public function checklogin(Request $request)
    {  
        $request->validate([
            'username'=>'required|min:7|max:30|exists:admins,username|email',
            'password'=>'required|min:4|max:30',
        ],['username.exists'=>"Username or Password is error."]);
        $creds=$request->only("username","password");
        if(Auth::guard("admin")->attempt($creds)){
            return redirect()->route("admindashboard");
            //echo "admin success";
        }else{
            return redirect()->route("adminlogin")->with("fail","Username or password error"); 
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route("adminlogin");
    }
    public function showregister()
    {
        return view("interpol.register");
    }
    public function showdashboard()
    {
        return view("admin.adminhome");
    }
    public function adminmemberlist()
    {
        $countrieslist=file_get_contents("lookup/json/Country.json");
        $countries=json_decode($countrieslist,true);
        $memberlist=Internatpolice::all();
        return view("admin.adminmember")->with("countries",$countries)->with("memberlist",$memberlist);
    }
    /////////////////////////////////////////
    
    public function adminaccountlist()
    {
        $accountlist=Admin::all();
        return view("admin.adminaccountlist")->with("accountlist",$accountlist);
    }
    /////////////////////////////////////////
    public function registermember(Request $request)
    {
        $request->validate([
            'idno'=>'required|min:7|max:20|alpha_num|unique:internatpolices,idno',
            'title'=>'required|min:2|max:30',
            'firstname'=>'required|min:2|max:15',
            'secondname'=>'required|min:2|max:15',
            'lastname'=>'required|min:2|max:15',
            'gender'=>'required|min:4|max:9',
            'profile'=>'required|min:4',
            'countrycode'=>'required|min:2|max:30',
            'email'=>'required|min:4|max:30|unique:internatpolices,email',
        ]);
         $str_random = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz");
         $input=new Internatpolice();
         $input->passport="nopassport.jpg";
         if($request->hasFile('profile')){
            $folder="public/image/profile/member";
            $imagename="img_".substr($str_random,12).".".$request->file('profile')->getClientOriginalExtension();
            $path=$request->file("profile")->storeAs($folder,$imagename);
            $input->profile=$imagename;
         }
         if($request->hasFile('passport')){
            $folder="public/image/profile/member";
            $passport="pport".substr($str_random,12).".".$request->file('passport')->getClientOriginalExtension();
            $path=$request->file("passport")->storeAs($folder,$passport);
            $input->passport=$passport;
         }
            $input->idno=$request->idno;
            $input->title=$request->title;
            $input->firstname=$request->firstname;
            $input->secondname=$request->secondname;
            $input->lastname=$request->lastname;
            $input->gender=$request->gender;
            $input->email=strtolower($request->email);
            $input->countrycode=$request->countrycode;
            $input->description='No description';
           $result=$input->save();
           if($result)
           return back()->with("success"," Successfully registered"); 
           return back()->with("failed"," Failed to register"); 
          
    }
    public function adminmemberedit($id)
    {
        $countrieslist=file_get_contents("lookup/json/Country.json");
        $countries=json_decode($countrieslist,true);
        $profile=Internatpolice::find($id);
            if($profile==null){
                return redirect()->route("adminmemberlist");
            }
        return view("admin.admineditmember")->with("countries",$countries)->with("profile",$profile);
    
    }
    public function adminmemberupdate(Request $request)
    {
        $request->validate([
            'idno'=>'required|min:7|max:20|alpha_num',
            'title'=>'required|min:2|max:30',
            'firstname'=>'required|min:2|max:15',
            'secondname'=>'required|min:2|max:15',
            'lastname'=>'required|min:2|max:15',
            'gender'=>'required|min:4|max:9',
            'countrycode'=>'required|min:2|max:30',
            'email'=>'required|min:4|max:30',
        ],[
            'idno.required'=>'Please enter valid Passport Number',
            'idno.min'=>'Passport Number should be greater than 7 characters.',
            'idno.max'=>'Passport Number should be less than 20 characters.',
            'idno.alpha_num'=>'Passport Number should be alphabet or number characters.',
        ]);
        $input=Internatpolice::find($request->id);
        if($input==null){
            return back()->with("failed","No Member exist in lists."); 
        }
        $folder="public/image/profile/member";
        $str="0123456789abcdefghijklmnopqrstuvwxyz";
         if($request->hasFile('profile')){
           $str_random = str_shuffle($str);
            $imagename="img_".substr($str_random,12).".".$request->file('profile')->getClientOriginalExtension();
            $path=$request->file("profile")->storeAs($folder,$imagename);
            $input->profile=$imagename;
         }
         if($request->hasFile('passport')){
            $str_random = str_shuffle($str);
             $passport="pport".substr($str_random,12).".".$request->file('passport')->getClientOriginalExtension();
             $path=$request->file("passport")->storeAs($folder,$passport);
             $input->passport=$passport;
          }
            $input->idno=$request->idno;
            $input->title=$request->title;
            $input->firstname=$request->firstname;
            $input->secondname=$request->secondname;
            $input->lastname=$request->lastname;
            $input->gender=$request->gender;
            $input->email=strtolower($request->email);
            $input->countrycode=$request->countrycode;
           $result=$input->update();
           if($result)
            return redirect()->route("adminmemberlist"); 
         return back()->with("failed","Failed to register "); 
    }
    public function adminmemberdelete(Request $request)
    {
        $member=Internatpolice::find($request->id);
        if($member==null){
            return back()->with("failed","Failed. No Member exist in list.");
        } 
        $deletedby="Unkown email";
        if(Auth::guard('admin')){
            $deletedby=Auth::guard('admin')->user()->username;
        }
            $restoremember=new Memberrestore();
            $restoremember->regid=$member->id;
            $restoremember->idno=$member->idno;
            $restoremember->title=$member->title;
            $restoremember->firstname=$member->firstname;
            $restoremember->secondname=$member->secondname;
            $restoremember->lastname=$member->lastname;
            $restoremember->gender=$member->gender;
            $restoremember->email=strtolower($member->email);
            $restoremember->profile=$member->profile;
            $restoremember->countrycode=$member->countrycode;
            $restoremember->description=$member->description;
            $restoremember->createddate=$member->created_at;
            $restoremember->deletedby=$deletedby;
            $result=$restoremember->save();
        if($result){
            $res=$member->delete();
            return back()->with("success","successfully delete"); 
           }
            return back()->with("failed"," Failed to register"); 
    }
    public function adminmemberbadge($id)
    {
        $membtype="Delegations";
        $badge=Internatpolice::find($id);
        if($badge==null){
            return back()->with("failed","Member is not exist in list"); 
           }
          return view("admin.adminbadge")->with("badge",$badge)->with("membtype",$membtype); 
    }
    public function capitalize(Internatpolice $member)
    {
        $member->idno=strtoupper($member->idno);
        $member->title=ucwords(strtolower($member->title));
        $member->firstname=ucfirst(strtolower($member->firstname));
        $member->secondname=ucfirst(strtolower($member->secondname));
        $member->lastname=ucfirst(strtolower($member->lastname));
        $member->countrycode=ucwords(strtolower($member->countrycode));
        $member->email=strtolower($member->email);
        return $member;
    }
    public function createacount()
    {
        return view("admin.admincreateaccount");
    }

    public function insertacount(Request $request)
    {
        $request->validate([

            'idno'=>'required|min:7|max:20|alpha_num',
            'title'=>'required|min:2|max:30',
            'fullname'=>'required|min:4|max:15',
            'username'=>'required|min:4|max:60',
            'profile'=>'required|min:2',
            'role'=>'required|min:1|max:9',
            'newpassword'=>'required|min:6|max:30',
            'confirmpassword'=>'required|min:6|max:30|same:newpassword',
            'email'=>'required|min:7|max:30',
        ],[
            'idno.required'=>'Please enter valid Id Number',
            'fullname.required'=>'Please insert fullname',
            'role.required'=>'Please select role',
            'newpassword.required'=>'Please insert password',
            'confirmpassword.same'=>'password no matched',
            'profile.required'=>'Please insert profile',
            'email.required'=>'Email is required',
        ]);
        //////////////////////////////////////////////
        $input=new Admin();
        if($request->role=='0'){
            $input->create=0;
            $input->edit=$request->edit?1:0;
            $input->badge=$request->badge?1:0;
            $input->delete=0;
        }
        if($request->role=='1'){
            $input->create=1;
            $input->edit=$request->edit?1:0;
            $input->badge=$request->frontbadge?1:0;
            $input->delete=1; 
        }
        $str_random = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz");
         if($request->hasFile('profile')){
            $folder="public/image/profile/member";
            $imagename="img_".substr($str_random,12).".".$request->file('profile')->getClientOriginalExtension();
            $path=$request->file("profile")->storeAs($folder,$imagename);
            $input->idno=$request->idno;
            $input->title=$request->title;
            $input->fullname=ucwords(strtolower($request->fullname));
            $input->username=$request->username;
            $input->email=strtolower($request->email);
            $input->profile=$imagename;
            $input->password=Hash::make($request->newpassword);        
            $input->search=1;
           $result=$input->save();
           if($result)
           return back()->with("success"," Successfully created"); 
           else
           return back()->with("failed"," Failed to create"); 
         }
         return back()->with("failed","Failed to create "); 
         
            // print_r($input);
    }
    /////////////////////
    public function memberflight()
    {
        $memberflightlist=Flight::all();
        return view("admin.adminflightlist")->with("memberflightlist",$memberflightlist);
    }
    
public function flightdetails($id)
{
   $flight=Flight::find($id);
   if($flight){
    $person=Internatpolice::Where('idno',$flight->idno)->first();
    if($person)
    return view("admin.flightdetailsinfo")->with("flight", $flight)->with('person',$person);
   }
   return redirect()->route('memberflight');
}
    ///////////////////
}
