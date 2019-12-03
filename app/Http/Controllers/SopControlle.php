<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class SopControlle extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sops = DB::table('qw_sop')->get();
        return view('admin/sopindex', ['sop' => $sops] );
    }

    public function sopadd()
    {
        return view('admin/sopadd');
    }

    public function SOPread(){
        $sops = DB::table('qw_sop')->get();
        return view('admin/read', ['sop' => $sops ]);
    }

    public function SOPdetail($sop_id,$perfix){
        $sopData = DB::table('qw_sop')->where('sop_id',intval($sop_id))->first();

        return view('admin/detail', ['sop' => $sopData ]);
    }


    public function sopEdit($sop_id){
        $sopData = DB::table('qw_sop')->where('sop_id',intval($sop_id))->first();
        return view('admin/sopedit',['sop' => $sopData]);
    }


    public function ajaxSave(Request $request)
    {
        $error = true;
        $alert = '';

        $pesan='';
        if($request->title ==''){
            $pesan.='<li>The title field is required</li>';
        }
        if($request->devision ==''){
            $pesan.='<li>The Devision field is required</li>';
        }
        if($request->sop ==''){
            $pesan.='<li>The SOP field is required</li>';
        }
        if(!empty($pesan)){
            $alert='<ul>'.$pesan.'</ul';
        }else{

           $simpan=DB::table('qw_sop')->insert(
                [
                    'title' => $request->title,
                    'sop' => htmlentities($request->sop),
                    'devision' => $request->devision,
                    'publish'=>1 
                ]
            );

            if($simpan){
                $error=false;
                $alert='SOP saved successfully';
            }else{
                $alert='failed to save';
            }
        }

        $response = array(
            'error' => $error,
            'alert' => $alert
        );
        
        echo json_encode($response);
       //  echo  response()->json($response);
    }


    public function ajaxEdit(Request $request){
        $error = true;
        $alert = '';

        $pesan='';
        if($request->title ==''){
            $pesan.='<li>The title field is required</li>';
        }
        if($request->devision ==''){
            $pesan.='<li>The Devision field is required</li>';
        }
        if($request->sop ==''){
            $pesan.='<li>The SOP field is required</li>';
        }
        if(!empty($pesan)){
            $alert='<ul>'.$pesan.'</ul';
        }else{

            $update = DB::table('qw_sop')
              ->where('sop_id', $request->sop_id )
              ->update([
                        'title' => $request->title,
                        'sop' => htmlentities($request->sop),
                        'devision' => $request->devision,
                        ]);
            if($update){
                $error=false;
                $alert='SOP updated successfully';
            }else{
                $alert='failed to Update';
            }

        }
        $response = array(
            'error' => $error,
            'alert' => $alert
        );
        echo json_encode($response);

    }


    public function ajaxDelete(Request $request){
        $error = true;
        $alert = '';
        if($request->sop_id ==''){
            $pesan.='Error Delete...!';
        }else{

            $delete=DB::table('qw_sop')->where('sop_id',intval($request->sop_id))->delete();
            if($delete){
                $error=false;
                $alert='SOP Delete successfully';
            }else{
                $alert='failed to Delete';
            }
        }

        $response = array(
            'error' => $error,
            'alert' => $alert,
            'sop_id' =>intval($request->sop_id)
        );
        echo json_encode($response);

    }




}
