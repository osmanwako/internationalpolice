<?php

namespace App\Http\Controllers\flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Internatpolice;
use App\Models\Flighthistory;
use App\Models\Flight;

class FlightinController extends Controller
{
 public function flightpass()
    {
        return view("member.flightpass");
    }
  
public function flightcheck(Request $request)
{
    $request->validate(
        ['pass_numb'=>'required|alpha_num|min:7|max:20|exists:internatpolices,idno'],
        [
            'pass_numb.required'=>'Please enter valid Passport Number',
            'pass_numb.min'=>'Passport Number should be greater than 7 characters.',
            'pass_numb.max'=>'Passport Number should be less than 20 characters.',
            'pass_numb.alpha_num'=>'Passport Number should be alphabet or number characters.',
            'pass_numb.exists'=>'No Member Registered with this passport number yet.if Your are new member of EAPCCO. please register first'
        ]);
        
    $flightin=Internatpolice::where('idno',$request->pass_numb)->first();
    return redirect()->route('flight.showin',$flightin->id);
}
public function flightin(Request $request)
{   
    $date=date('Y-m-d',strtotime('-1 days'));
    $request->validate([
        'departdate'=>'required|date|after:'.$date,
        'flightnum'=>'required|alpha_num',
        'flighttime'=>'required|date_format:H:i',
    ]);
    $cred="unkown";
    if(Auth::guard('member')){
        $cred=Auth::guard('member')->user()->username;  
    }
    $flightin=Flight::where('idno',$request->idno_)->first();
     if($flightin){
        $this->sethistory($flightin);
        $flightin->hotelname=$request->hotelname;
        $flightin->roomno=$request->roomno;
        $flightin->departdate=$request->departdate;
        $flightin->flightnum=$request->flightnum;
        $flightin->flighttime=$request->flighttime;
        $flightin->telephone=$request->telephone;
        $flightin->credential=$cred;
        $result=$flightin->update();
        //dd($flighthistory);
        return redirect()->route('flight.details',$flightin->id);
     }
        $flightin=new Flight();
        $flightin->idno=$request->idno_;
        $flightin->hotelname=$request->hotelname;
        $flightin->roomno=$request->roomno;
        $flightin->departdate=$request->departdate;
        $flightin->flightnum=$request->flightnum;
        $flightin->flighttime=$request->flighttime;
        $flightin->telephone=$request->telephone;
        $flightin->credential=$cred;
        $result=$flightin->save();
        return redirect()->route('flight.details',$flightin->id);

}
public function sethistory(Flight $data)
{
    $all=new Flighthistory();
    $all->idno=$data->idno;
    $all->hotelname=$data->hotelname;
    $all->roomno=$data->roomno;
    $all->departdate=$data->departdate;
    $all->departdate=$data->departdate;
    $all->flightnum=$data->flightnum;
    $all->flighttime=$data->flighttime;
    $all->telephone=$data->telephone;
    $all->flighttype=$data->flighttype;
    $all->createdby=$data->credential;
    $all->updatedby=$data->credential;
    $all->save();
}
public function flightout($id)
{
   $flight=Flight::find($id);
   if($flight){
    $person=Internatpolice::Where('idno',$flight->idno)->first();
    if($person)
    return view("member.flightout")->with("flight", $flight)->with('person',$person);
   }
return redirect()->route('memberflight');
}
public function getflightin($id)
{ 
    $flightin=Internatpolice::find($id);
    if($flightin){
    $idno=$flightin->idno;
    $departure=Flight::where('idno',$idno)->first();
    $countrieslist=file_get_contents("lookup/json/Country.json");
    $countries=json_decode($countrieslist,true);
    if($departure)
    return view("member.flightin")->with("countries",$countries)->with("departure",$departure)->with("flightin",$flightin);
    return view("member.flightin")->with("countries",$countries)->with("flightin",$flightin);
    }
    return redirect()->back()->with("error","No Member Registered with this passport number yet");
}
}
