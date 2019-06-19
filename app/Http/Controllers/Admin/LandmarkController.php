<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Landmark;
use function GuzzleHttp\json_encode;

class LandmarkController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function list_landmark()
    {
        $landmarks = Landmark::paginate(15);
        //dd($landmarks);
        return view('admin.LandmarkList',['landmarks'=>$landmarks]);
    }
    public function add_landmark(Request $request)
    {
        $this->validate($request, [
            'nameTH' => 'required|max:255|string|regex:/^\S*$/u|unique:landmarks',
            'nameEN' => 'required|max:255|string|unique:landmarks|regex:/(^([a-zA-Z]+)(\d+)?$)/u|regex:/^\S*$/u',
            'priceTranspot' => 'required|integer|regex:/\d+/',
         ]);
        $result = new Landmark();
        $result->nameTH = $request->nameTH;
        $result->nameEN = $request->nameEN;
        $result->priceTranspot = $request->priceTranspot;
        $result->save();
        if($request == true)
        {
            return redirect('/admin-landmark');
        }
        else 
        {
            return redirect()->back()->withErrors('error','Cant Insert Data to Database !!!!');
        }
    }
    public function del_landmark(Request $request)
    {
        $landmark = Landmark::find($request->id);
        $landmark->delete();
        //var_dump($landmark);
        if($landmark == true)
        {
            return json_encode('success');
        }
        return json_encode('error');
    }
    public function edit_form_landmark(Request $request)
    {
        $landmark = Landmark::find($request->id);
        if(!empty($landmark))
        {
            return json_encode($landmark);
        }
        else return json_encode($landmark);
    
    }
    public function edit_landmark(Request $request)
    {
        //dd($request);
        $landmark = Landmark::find($request->id);
        $landmark->nameTH = $request->nameTH;
        $landmark->nameEN = $request->nameEN;
        $landmark->priceTranspot = $request->priceTranspot;
        $landmark->save();
        if($landmark == true)
        {
            return json_encode($landmark);
        }
        else  return json_encode($landmark);


    }
}
