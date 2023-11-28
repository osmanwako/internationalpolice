<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Internatpolice;

class MemberController extends Controller
{
    public function showlogin()
    {
        return view("interpol.login");
    }
    public function showregister()
    {
        return view("interpol.register");
    }
    public function showmemberregisteration()
    {
        $countrieslist=file_get_contents("lookup/json/Country.json");
        $countries=json_decode($countrieslist,true);
        return view("member.memberhome")->with("countries",$countries);
    }
    public function showdashboard()
    {
        return view("member.memberdashboard");
    }
    public function membersearchpage()
    {
        return view("member.membersearchpage");
    }

    public function checklogin(Request $request)
    {
    
        $request->validate([
            'username'=>'required|min:7|max:30|exists:members,username|email',
            'password'=>'required|min:4|max:30',
        ],['username.exists'=>"Username or Password is error."]);
        $creds=$request->only("username","password");
        if(Auth::guard("member")->attempt($creds)){
            return redirect()->route("memberhome");
            //echo "admin success";
        }else{
            return redirect()->route("memberlogin")->with("fail","Username or password error"); 
        }
    }
    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route("memberlogin");
    }
    public function memberprofile($id)
    {
        $profile=Internatpolice::find($id);
        if($profile==null){
            return redirect()->route("memberdashboard");
        }
       return view("member.memberprofile")->with("profile",$profile);
    }
    public function memberregister(Request $request)
    {
        //dd($request);
        $request->validate([
            'idno'=>'required|min:7|max:20||alpha_num|unique:internatpolices,idno',
            'title'=>'required|min:2|max:30',
            'firstname'=>'required|min:2|max:15',
            'secondname'=>'required|min:2|max:15',
            'lastname'=>'required|min:2|max:15',
            'gender'=>'required|min:4|max:9',
            'profile'=>'required|min:4|max:2048',
            'passport'=>'required|min:4|max:2048',
            'countrycode'=>'required|min:2|max:30',
            'email'=>'required|min:4|max:30|unique:internatpolices,email',
        ],[
            'idno.required'=>'Please enter valid Passport Number',
            'idno.unique'=>'The Passport Number has already registered',
            'idno.min'=>'Passport Number should be greater than 7 characters.',
            'idno.max'=>'Passport Number should be less than 20 characters.',
            'idno.alpha_num'=>'Passport Number should be alphabet or number characters.',
            'passport.requiired'=>'Passport copy is required.',
            'email.unique'=>'The Email has already registered',
        ]);
         $str_random = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz");
         if($request->hasFile('profile')){
            $folder="public/image/profile/member";
            $imagename="img_".substr($str_random,12).".".$request->file('profile')->getClientOriginalExtension();
            $passport="pport".substr($str_random,12).".".$request->file('passport')->getClientOriginalExtension();
            $path=$request->file("profile")->storeAs($folder,$imagename);
            $input=new Internatpolice();
            $input->idno=$request->idno;
            $input->title=$request->title;
            $input->firstname=$request->firstname;
            $input->secondname=$request->secondname;
            $input->lastname=$request->lastname;
            $input->gender=$request->gender;
            $input->email=$request->email;
            $input->profile=$imagename;
            $input->passport=$passport;
            $input->countrycode=$request->countrycode;
            $input->description='No description';
           $result=$input->save();
           if($result){
            return redirect()->route("memberprofile",$input->id); 
           }
           else{
            return back()->with("failed"," Failed to register"); 
           }
         }
         return back()->with("failed","Failed to register "); 
}
public function membersearch(Request $request)
{
    $request->validate(
        ['search_idno'=>'required|alpha_num|min:7|max:20|exists:internatpolices,idno'],
        [
            'search_idno.required'=>'Please enter valid Passport Number',
            'search_idno.min'=>'Passport Number should be greater than 7 characters.',
            'search_idno.max'=>'Passport Number should be less than 20 characters.',
            'search_idno.alpha_num'=>'Passport Number should be alphabet or number characters.',
            'search_idno.exists'=>'No Member Registered with this passport number yet.if Your are new member of EAPCCO. Please register first'
        ]);
    $profile=Internatpolice::where('idno',$request->search_idno)->first();
        if($profile==null){
            return redirect()->route("memberdashboard");
        }
        $countrieslist=file_get_contents("lookup/json/Country.json");
        $countries=json_decode($countrieslist,true);
        $profile=Internatpolice::find($profile->id);
        return view("member.membereditprofile")->with("countries",$countries)->with("profile",$profile);
}
public function membereditprofile($id)
{     
    $countrieslist=file_get_contents("lookup/json/Country.json");
    $countries=json_decode($countrieslist,true);
    //echo $request->id;
    $profile=Internatpolice::find($id);
        if($profile==null){
            return redirect()->route("memberdashboard");
        }
    return view("member.membereditprofile")->with("countries",$countries)->with("profile",$profile);
}
public function memberupdateprofile(Request $request)
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
        $folder="public/image/profile/member";
        $sequenstr="0123456789abcdefghijklmnopqrstuvwxyz";
         if($request->hasFile('profile')){
           $str_random = str_shuffle($sequenstr);
            $imagename="img_".substr($str_random,12).".".$request->file('profile')->getClientOriginalExtension();
            $path=$request->file("profile")->storeAs($folder,$imagename);
            $input->profile=$imagename;
         }
         if($request->hasFile('passport')){
            $str_random = str_shuffle($sequenstr);
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
            $input->email=$request->email;
            $input->countrycode=$request->countrycode;
           $result=$input->update();
           if($result){
            return redirect()->route("memberprofile",$input->id); 
           }
           else{
            return back()->with("failed"," Failed to register"); 
           } 
}
public function covidinformation()
{
    return view("member.covidinformation");
    
}
public function tourisminformation()
{
    return view("member.tourisminformation");
    
}
public function currencyinformation()
{
    return view("member.currencyinformation");
    
}
}
