<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attraction;

class AttractionController extends Controller
{
    //
    public function list_attraction()
    {
        $attractions = Attraction::all();
        return view('admin.AttractionList',compact('attractions'));
    }
    public function form_attraction()
    {
        return view('admin.AttractionForm');
    }
    public function add_attraction(Request $request)
    {
        //dd($request);
        header ( 'X-XSS-Protection: 0' );
        $detail = $request->content;
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">' . $detail);
        //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
        $images = $dom->getelementsbytagname('img');
        //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            //ตั้งชื่อรูปภาพใหม่โดยอ้างอิงจากเวลา
            $image_name = time() . $k . '.png';
            //อัพโหลดภาพไปยัง public
            $path = public_path() . '/img/attraction/' . $image_name;
            //ทำการอัพโหลดภาพ
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', 'img/attraction/'.$image_name);
        }
        $detail = $dom->savehtml();
        $attraction = new Attraction();
        $attraction->title = $request->title;
        $attraction->content = $detail;
        $attraction->language = $language;
        $attraction->save();

        return redirect()->action('Admin\AttractionController@list_attraction');
        //return view('admin.AttractionList', compact('attraction'));
    }
}
