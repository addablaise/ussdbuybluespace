<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
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
        config(['pagetitle' => trans('app.phones')]);

        $this->telcos = array('mtn', 'vodafone', 'airteltigo', 'glo');
        
        $this->logService = $logService;
        $this->phoneNumberService = $phoneNumberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = (object) array();
        if($request->has('search'))
        {
            $param->search = $request->search;
        }
        
        $phones = $this->phoneNumberService->getAll($param);

        return view('phone.index', [
            'phones' => $phones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phone.add', [
            'telcos' => $this->telcos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'telco' => 'required',
            'phone' => 'required|unique:phone_numbers',
            'status' => 'required',
            'status' => 'required',
        ]);

        $phone = $this->phoneNumberService->create($request);
        
        //Log Action
        $data = (object) array('user_id' => auth()->id(), 'action' => "Add Phone Number #". $phone->id, 'data' => $phone);
        $this->logService->create($data);

        return redirect('phone')->with('success', trans('app.create_success', ['record' => trans('app.phone')]));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request  $request, $id)
    {
        $phone = $this->phoneNumberService->get($id);

        config(['pagetitle' => trans('app.phone').': '.$phone->phone]);

        return view('phone.edit', [
            'phone' => $phone,
            'telcos' => $this->telcos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $phone = $this->phoneNumberService->get($id);

        $validate = $request->validate([
            'telco' => 'required',
            'phone' => 'required|unique:phone_numbers,phone,'.$id,
            'status' => 'required',
            'status' => 'required',
        ]);

        $phone = $this->phoneNumberService->update($phone, $request);
        
        //Log Action
        $data = (object) array('user_id' => auth()->id(), 'action' => "Edit Phone Number #". $phone->id, 'data' => $phone);
        $this->logService->create($data);

        return redirect('phone')->with('success', trans('app.update_success', ['record' => trans('app.phone')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneNumber  $phoneNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->phoneNumberService->delete($id);
        if($result)
        {
            //Log Action
            $data = (object) array('user_id' => auth()->id(), 'action' => "Delete Phone Number #". $id);
            $this->logService->create($data);

            return redirect('phone')->with('success', trans('app.delete_success', ['record' => trans('app.phone')]));
        }
        else
        {
            return redirect('phone')->with('error', trans('app.delete_error', ['record' => trans('app.phone')]));
        }
    }
}
