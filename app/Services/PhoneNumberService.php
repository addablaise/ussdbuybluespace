<?php 

namespace App\Services;

use App\Models\Log;
use App\Models\PhoneNumber;
use Carbon\Carbon;

class PhoneNumberService 
{
    public function getAll($param = null, $paginate = true) 
    {
        $phones = PhoneNumber::orderByDesc('created_at');

        if(isset($param->search))
        {
            $phones = $phones->where('phone', 'like', '%'.$param->search.'%')
                ->orWhere('telco', 'like', '%'.$param->search.'%');
        }

        if(isset($param->limit))
        {
            $phones = $phones->limit($param->limit);
        }

        if($paginate)
        {
            return $phones->paginate($param->paginate ?? 20); 
        }
        else
        {
            return $phones->get(); 
        }
    }

    public function get($id) : PhoneNumber 
    {
        return PhoneNumber::findOrFail($id);
    }
    
    public function getByPhone($phone) : ?PhoneNumber 
    {
        return PhoneNumber::where('phone', $phone)->first();
    }

    public function create($data) : PhoneNumber
    {
        return PhoneNumber::create([
            'phone' => $data->phone, 
            'telco' => $data->telco,
            'status' => $data->status,
            'created_at' => Carbon::now()
        ]);
    }

    public function update(PhoneNumber $phone, $data) : PhoneNumber
    {
        if($data->phone) $phone->phone = $data->phone;
        if($data->telco) $phone->telco = $data->telco;
        if($data->status) $phone->status = $data->status;
        
        $phone->updated_at = Carbon::now();
        $phone->update();
        
        return $phone;
    }

    public function delete($id) : bool 
    {
        $phone = PhoneNumber::findOrFail($id);
        return $phone->delete();
    }

    public function count() : object 
    {
        $active = PhoneNumber::where('status', 'active')->count();
        $blocked = PhoneNumber::where('status', 'blocked')->count();
        $total = PhoneNumber::count();
        
        return (object) [
            'total' => $total,
            'active' => $active,
            'blocked' => $blocked,
        ];
    }
}