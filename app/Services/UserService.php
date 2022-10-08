<?php 

namespace App\Services;

use App\Models\Log;
use App\Models\PhoneNumber;
use App\Models\User;
use Carbon\Carbon;

class UserService 
{
    public function count() : object 
    {
        $total = User::count();
        
        return (object) [
            'total' => $total,
        ];
    }
}