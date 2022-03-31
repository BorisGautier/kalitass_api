<?php

namespace App\Http\Controllers;

use App\Models\monitoringForm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MonitoringFormController extends Controller
{
    //

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateParam(Request $request){
        if ($request->has('user_id')){
            $monitoring = monitoringForm::where('user_id', $request->get('user_id'))->first();
            if ($monitoring){
               $response =  monitoringForm::where('user_id', $request->get('user_id'))->update($request->all());
               if ($response == 1){
                   return response()->json(array('status'=>Response::HTTP_OK, 'message' => 'Mis à jour effectué'));
               }
            }else{
                $response = monitoringForm::create($request->all());
                if ($response){
                    return response()->json(array('status'=>Response::HTTP_OK, 'message' => 'Paramètre enregistré'));
                }
            }

        }
        return response()->json(array('status'=>Response::HTTP_BAD_REQUEST, 'message' => 'echec de donnée'));
    }

    public function getParamById($user_id){
        $monitoring = monitoringForm::where('user_id', $user_id)->first();
        if ($monitoring)
            return \response()->json(array('status' => Response::HTTP_OK, 'param' => $monitoring));
        return \response()->json(array(Response::HTTP_FOUND));
    }
}
