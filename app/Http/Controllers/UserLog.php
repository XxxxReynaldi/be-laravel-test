<?php

namespace App\Http\Controllers;

use App\Models\UserLog as ModelsUserLog;
use Illuminate\Http\Request;

use MongoDB\BSON\ObjectId;

class UserLog extends Controller
{
    public function index(Request $request, $id)
    {
        $getId = new ObjectId($id);
        $userLog = ModelsUserLog::where('user', $getId);

        $userLogin = ModelsUserLog::where('user', $getId)
            ->where('status', true);
        $userLogout = ModelsUserLog::where('user',$getId)
            ->where('status', false);

        $totalUserLogin = $userLogin->count();
        $totalUserLogout = $userLogout->count();

        $cUserLogin = collect($userLogin->get());
        $cUserLogout = collect($userLogout->get());

        if ($totalUserLogin != $totalUserLogout ) {
            $cUserLogin->pop();
            $cUserLogin->all();
            // dump($cUserLogin);
        }
        
        $timeDiff = [];
        for ($i=0; $i < $userLogout->count(); $i++) { 
            $login = $cUserLogin[$i]['createdAt']->toDateTime();
            $logout = $cUserLogout[$i]['createdAt']->toDateTime();
            
            $timeDiff[] = date_diff($logout,$login);
        }
        dump($timeDiff);
        // $sum = strtotime('00:00:00');
 
        // $totaltime = 0;
        
        // foreach( collect($timeDiff) as $element ) {
            
        //     // Converting the time into seconds
        //     $timeinsec = strtotime($element) - $sum;
            
        //     // Sum the time with previous value
        //     $totaltime = $totaltime + $timeinsec;
        // }
        
        // // Totaltime is the summation of all
        // // time in seconds
        
        // // Hours is obtained by dividing
        // // totaltime with 3600
        // $h = intval($totaltime / 3600);
        
        // $totaltime = $totaltime - ($h * 3600);
        
        // // Minutes is obtained by dividing
        // // remaining total time with 60
        // $m = intval($totaltime / 60);
        
        // // Remaining value is seconds
        // $s = $totaltime - ($m * 60);
        
        // // Printing the result
        // echo ("$h:$m:$s");
        

        // return response()->json($userLog);
        // return view('books.index',compact('books'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
