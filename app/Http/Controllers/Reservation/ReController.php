<?php

namespace App\Http\Controllers\Reservation;

use Validator;
use App\Reservation;
use App\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Auth;

class ReController extends Controller
{
    //
    public function reserve(Request $request){
        $output = new ConsoleOutput();
       
        $v = $this->validator($request);

        if( $v->fails())
        {
            return $v->errors();
        }
        #check date overlap
        
        $resvs = Reservation::where('date', $request->input('date') )->get();

        $hour1 = $request->input('hour1');
        $hour2 = $request->input('hour2');
        
        foreach ($resvs  as $r) {
            if(($r->hour1<= $hour1 and  $hour1<= $r->hour2) or
                ($r->hour1<= $hour2 and  $hour2<= $r->hour2)
            )
            {
                return Response::json(
                    array('success' => false, 'message' => 'the time is occupied'), 403
                );
            }
          
        }
       
        $resv = new Reservation();

        
        $resv->patient_id = $request->input('patient_id');
        $resv->date = $request->input('date');
        $resv->hour1 = $request->input('hour1');
        $resv->hour2 = $request->input('hour2');


        if ($resv->save()){
        #after save, $data->id should be the last id inserted.
            return Response::json(
                    array('success' => true, 'id' => $resv->id), 200
                );
        }

        return  Response::json(
                    array('success'=>false,'message'=>'some thing wrong when inserting new data'), 500
                );
    }

    public function resvs(Request $request){

        $patient = Auth::guard('api_patient')->getUser() ;
        $id =  $patient ->id ;

        $resvs = Reservation::where( 'patient_id', $id )->get() ;

        return $resvs ;

    }

    public function myinfo(Request $request){

        $patient = Auth::guard('api_patient')->getUser() ;
        $id =  $patient ->id ;
        $ssn =  $patient ->ssn;
        $name =  $patient ->name;
   

        return Response::json(
                array('success' => true, 'id' => $id,
                    'ssn'=>$ssn   , 'name'=> $name ), 200
        );
    }

    public function validator($request){

        $hour1 = $request->input('hour1');

        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patient,id',
            'date' => 'required|date|date_format:Y-m-d|after:'. date("Y-m-d"),
            'hour1' => 'required|integer|between:0,23',
            'hour2' => 'required|integer|between:'.($hour1+1).',24',

        ]);
        return $validator ;
    } 
}
