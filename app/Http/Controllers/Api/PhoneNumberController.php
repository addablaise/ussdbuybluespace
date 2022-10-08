<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PhoneNumber;
use App\Services\LogService;
use App\Services\PhoneNumberService;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    protected $logService; 
    protected $phoneNumberService; 
    protected $telcos; 

    public function __construct(LogService $logService, PhoneNumberService $phoneNumberService)
    {
        $this->telcos = array('mtn', 'vodafone', 'airteltigo', 'glo');
        
        $this->phoneNumberService = $phoneNumberService;
    }

    /**
     * Returns a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phones = $this->phoneNumberService->getAll([], false);

        return Helper::api([
            'status_code' => 1,
            'message' => trans('app.load_success', ['record' => trans('app.phones')]),
            'phones' => PhoneNumber::collection($phones)
        ]);
    }

    /**
     * Returns a phone number resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $number)
    {
        $phone = $this->phoneNumberService->getByPhone($number);   
        if(!$phone)
        {
            return Helper::api([
                'status_code' => 0,
                'message' => trans('app.no_results_found').': '.$number
            ], 404);
        }

        return Helper::api([
            'status_code' => 1,
            'message' => $phone->status,
        ]);
    }
}
