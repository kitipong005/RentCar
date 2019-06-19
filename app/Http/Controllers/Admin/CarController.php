<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Image;
use App\Car;
use Illuminate\Support\Facades\Input;
use App\ModelCar;
use App\Brand;
use App\Type;
use Session;
use Illuminate\Routing\Redirector;


class CarController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function list_car()
    {
        $cars = Car::with('brand','model','type')->orderBy('id','desc')->paginate(15);
        //$cars = Car::with('model')->get();
        //dd($cars);
        return view('admin.CarList')->with('cars',$cars);
    }
    public function add_car()
    {
        $brands = DB::table('brands')
            ->get();
        $types = DB::table('types')
            ->get();
        return view('admin.CarAdd',['brands'=>$brands,'types'=>$types]);
    }
    public function add_car_db(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'license' => 'required|string',
            'brand' => 'required|integer',
            'model' => 'required|integer',
            'type' => 'required|integer',
            'seat' => 'required|string',
            'gear' => 'required|string',
            'price' => 'required|integer',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'count' => 'required|integer',
        ]);
        $result = Car::where('license','=',$request->license)->first();
        if($result)
        {
            return redirect()->back()
            ->withErrors(['error'=>'error'])->withInput(Input::all());
        }
        //dd($request);
        DB::beginTransaction();
        try {
            $newCar = Car::create([
                'license' =>  $request->license,
                'brand_id' =>  $request->brand,
                'model_id' =>  $request->model,
                'type_id' =>  $request->type,
                'seat' =>  $request->seat,
                'gear' =>  $request->gear,
                'door' =>  $request->door,
                'air' =>  $request->air,
                'price' =>  $request->price,
                'count' => $request->count,
                'pic' =>  $this->resizePic($request,500),
            ]);
            DB::commit();
            Session::flash('success', "success");
            return redirect('admin-listcar');

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()
                ->withErrors(['error'=>'error'])->withInput(Input::all()); 
        }	
    }
    public function editListCarForm(Request $request)
    {
        $car = Car::with('model','type','brand')->where('id','=',$request->id)->first();
        $brands = Brand::all();
        $types = Type::all();
        //dd($car);
        return view('admin.CarListForm',['car'=>$car,'brands'=>$brands,'types'=>$types]);
    }
    public function editListCar(Request $request)
    {
        //dd($request);
        $car = Car::find($request->id);
        if($request->hasFile('picture')){
            $car->pic =  $this->resizePic($request,500);
        }
        $car->license = $request->license;
        $car->brand_id = $request->brand;
        $car->model_id = $request->model;
        $car->type_id = $request->type;
        $car->seat = $request->seat;
        $car->gear = $request->gear;
        $car->door = $request->door;
        $car->air = $request->air;
        $car->price = $request->price;
        $car->count = $request->count;
        $car->save();
        if($car == true)
        {
            Session::flash('success','success');
            return redirect()->action('Admin\CarController@list_car');
        }
        else{
            Session::flash('error','error');
            return redirect()->action('Admin\CarController@editListCarForm');
        }
    }
    public function deleteCar(Request $request)
    {
        $car = Car::find($request->id);
        $car->delete();
        Session::flash('delete','delete');
        return redirect()->action('Admin\CarController@list_car');
    }
    //--------- Brand --------------------
    public function Brandlist()
    {
        $brands = Brand::paginate(15);
        return view('admin.Brandlist')->with('brands',$brands);
    }
    public function Brandget(Request $request)
    {
        if($request->ajax())
        {
            $brand = Brand::where('id','=',$request->id)->first();
            return response($brand);
        }
    }

    public function Brandadd(Request $request)
    {
        if($request->ajax())
        {
            $brand = new Brand();
            $brand->name = $request->brand;
            $brand->save();
            return response($brand);
        }
    }
    public function Brandedit(Request $request)
    {
        if($request->ajax())
        {
            $brand = Brand::find($request->brandId);
            $brand->name = $request->name;
            $brand->save();
            return response($brand);
        }
    }
    public function Branddelete(Request $request)
    {
        if($request->ajax())
        {
            $brand = Brand::find($request->id)->delete();

            return response()->json($brand);
        }
    }

    //--------- Type --------------------
    public function Typelist()
    {
        $types = Type::paginate(15);
        return view('admin.Typelist')->with('types',$types);
    }
    public function Typeadd(Request $request)
    {
        if($request->ajax())
        {
            $type = new Type();
            $type->name = $request->type;
            $type->save();
            return response($type);
        }
    }
    public function Typeget(Request $request)
    {
        if($request->ajax())
        {
        
            $type = Type::where('id','=',$request->id)->first();
            return response($type);
        }
    }
    public function Typeedit(Request $request)
    {
        if($request->ajax())
        {
            $type = Type::find($request->typeId);
            $type->name = $request->name;
            $type->save();
            return response($type);
        }
    }
    public function Typedelete(Request $request)
    {
        if($request->ajax())
        {
            $type = Type::find($request->id)->delete();

            return response()->json($type);
        }
    }

    //--------- Model --------------------
    public function Modellist()
    {
        $models = ModelCar::with('brand')->paginate(15);
        $brands = Brand::all();
        return view('admin.Modellist')->with('models',$models)->with('brands',$brands);
    }
    public function Modeladd(Request $request)
    {
        if($request->ajax())
        {
            $model = new ModelCar();
            $model->brand_id = $request->brand_id;
            $model->name = $request->name;
            $model->save();
            if($model == true)
            {
                $model = ModelCar::with('brand')->orderBy('id','desc')->first();
                return response($model);
            }
        }
    }
    public function Modelget(Request $request)
    {
        if($request->ajax())
        {       
            $model = ModelCar::where('id','=',$request->id)->first();
            $brands = Brand::all();
            return response(array($model,$brands));
        }
    }
    public function Modeledit(Request $request)
    {
        if($request->ajax()){
            $model = ModelCar::find($request->id);
            $model->brand_id = $request->brand;
            $model->name = $request->name;
            $model->save();

            $model = ModelCar::with('brand')->where('id','=',$request->id)->first();
            return response($model);
        }
    }
    public function Modeldelete(Request $request)
    {
        if($request->ajax()){
            $model = ModelCar::find($request->id)->delete();
            return response()->json($model);
        }
    }

    public function resizePic($request,$imgwidth)
    {
        $file = $request->file('picture');
        //$imgwidth = 300;
        $folderupload = 'img/cars/';
        $filename = time() . $file->getClientOriginalName();
        $filename = str_replace(" ","",$filename);
        $file->move($folderupload, $filename);
        $targetPath = $folderupload . $filename;
        $img = Image::make($targetPath);
        if($img->width()>$imgwidth){
			$img->resize($imgwidth, null, function ($constraint) {
				$constraint->aspectRatio();
			});
         }
         $img->save($targetPath);
        return $filename;
    }
    public function list_model(Request $request)
    {
        $models = ModelCar::where('brand_id',$request->id)->get();
        return response()->json($models);
    }
}
