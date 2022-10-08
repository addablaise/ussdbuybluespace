<?php 

namespace App\Services;

use App\Models\Log;
use Carbon\Carbon;

class LogService 
{
    public function create($data) : Log
    {
        return Log::create([
            'user_id' => $data->user_id, 
            'action' => $data->action,
            'data' => isset($data->data) ? json_encode($data->data) : NULL,
            'created_at' => Carbon::now()
        ]);
    }

    public function getByUserId($id)
    {
        return Log::where('user_id', $id)->orderByDesc('created_at')->paginate(20);
    }
}