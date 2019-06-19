<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Timestart;
use App\Timeend;

class TimeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function Timelist()
    {
        $timesS = Timestart::paginate(15);
        $timesE = Timeend::paginate(15);
        return view('admin.Timelist')->with('timesS',$timesS)->with('timesE',$timesE);
    }
    public function TimeStartadd(Request $request)
    {
        if($request->ajax())
        {
            $timeS = new Timestart();
            $timeS->detail = $request->timeS;
            $timeS->save();
            return response($timeS);
        }
    }
    public function TimeEndadd(Request $request)
    {
        if($request->ajax())
        {
            $timeE = new Timeend();
            $timeE->detail = $request->timeE;
            $timeE->save();
            return response($timeE);
        }
    }

    public function TimeStartget(Request $request)
    {
        if($request->ajax())
        {
            $timeS = Timestart::where('id','=',$request->id)->first();
            return response($timeS);
        }
    }
    public function TimeEndget(Request $request)
    {
        if($request->ajax())
        {
            $timeE = Timeend::where('id','=',$request->id)->first();
            return response($timeE);
        }
    }

    public function TimeStartedit(Request $request)
    {
        if($request->ajax())
        {
            $timeS = Timestart::find($request->timeSId);
            $timeS->detail = $request->detailS;
            $timeS->save();
            return response($timeS);
        }
    }

    public function TimeEndedit(Request $request)
    {
        if($request->ajax())
        {
            $timeE = Timeend::find($request->timeEId);
            $timeE->detail = $request->detailE;
            $timeE->save();
            return response($timeE);
        }
    }

    public function TimeStartdelete(Request $request)
    {
        if($request->ajax())
        {
            $timeE = Timeend::find($request->id)->delete();
            return response()->json($timeE);

        }
    }
}
