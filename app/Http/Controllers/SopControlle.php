<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use Validator;
//use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        return view('admin/sopindex', ['sop' => $sops]);
    }

    public function sopadd()
    {
        return view('admin/sopadd');
    }

    public function SOPread()
    {
        $user = Auth::user();
        if ($user->division == 'Developer') {
            $devision = 'Developer';
        } else {
            $devision = 'Technical';
        }


        $sops = DB::table('qw_sop')->where('devision', $devision)->get();
        return view('admin/read', ['sop' => $sops]);
    }

    public function SOPdetail($sop_id, $perfix)
    {
        $sopData = DB::table('qw_sop')->where('sop_id', intval($sop_id))->first();

        return view('admin/detail', ['sop' => $sopData]);
    }


    public function sopEdit($sop_id)
    {
        $sopData = DB::table('qw_sop')->where('sop_id', intval($sop_id))->first();
        return view('admin/sopedit', ['sop' => $sopData]);
    }


    public function ajaxSave(Request $request)
    {


        // echo '<pre>';
        //  print_r($request->all());
        //   echo '</pre>';
        $error = true;
        $alert = '';


        $pesan = '';
        if ($request->title == '') {
            $pesan .= '<li>The title field is required</li>';
        }
        if ($request->devision == '') {
            $pesan .= '<li>The Devision field is required</li>';
        }
        if ($request->sop == '') {
            $pesan .= '<li>The SOP field is required</li>';
        }
        if (!empty($pesan)) {
            $alert = '<ul>' . $pesan . '</ul';
        } else {

            $name = '';
            //upload gambar
            if ($request->postImages['name'] != '') {
                $tmp = $request->postImages;
                $to = $tmp['path'];
                $file = public_path('assets/tmp/') . $tmp['name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $name = Carbon::now()->format('dmYhis') . '.' . $ext;
                $from = public_path('assets/tmp/');
                copy($file, $to . $name);
                unlink($from . $tmp['name']);
            }
            $FileName = '';
            if ($request->postFiles['name'] != '') {
                $tmpFile = $request->postFiles;
                $ke = $tmpFile['path'];
                $file = public_path('assets/tmp/') . $tmpFile['name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $FileName = Carbon::now()->format('dmYhis') . '.' . $ext;
                $unlinkpath = public_path('assets/tmp/');
                copy($file, $ke . $FileName);
                unlink($unlinkpath . $tmpFile['name']);
            }

            //exit();
            $simpan = DB::table('qw_sop')->insert(
                [
                    'title' => $request->title,
                    'sop' => htmlentities($request->sop),
                    'devision' => $request->devision,
                    'gambar'   => $name,
                    'file'      => $FileName,
                    'publish' => 1
                ]
            );

            if ($simpan) {
                $error = false;
                $alert = 'SOP saved successfully';
            } else {
                $alert = 'failed to save';
            }
        }

        $response = array(
            'error' => $error,
            'alert' => $alert
        );

        echo json_encode($response);
        //  echo  response()->json($response);
    }


    public function ajaxEdit(Request $request)
    {
        $error = true;
        $alert = '';

        $pesan = '';
        if ($request->title == '') {
            $pesan .= '<li>The title field is required</li>';
        }
        if ($request->devision == '') {
            $pesan .= '<li>The Devision field is required</li>';
        }
        if ($request->sop == '') {
            $pesan .= '<li>The SOP field is required</li>';
        }
        if (!empty($pesan)) {
            $alert = '<ul>' . $pesan . '</ul';
        } else {
            // echo $request->postImages['name'];


            $img = '';
            if ($request->postImages['name'] != '') {

                $gambar = DB::table('qw_sop')->select('gambar')
                    ->where('sop_id', intval($request->sop_id))->first();
                //print_r($gambar);
                //new upload
                if ($gambar->gambar != $request->postImages['name']) {

                    $tmp = $request->postImages;
                    $to = $tmp['path'];
                    $file = public_path('assets/tmp/') . $tmp['name'];
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $name = Carbon::now()->format('dmYhis') . '.' . $ext;
                    $from = public_path('assets/tmp/');
                    copy($file, $to . $name);
                    @unlink($from . $tmp['name']);
                    @unlink($to . $gambar->gambar);
                    //fild name
                    $img = $name;
                } else {
                    $img = $gambar->gambar;
                }
            }
            //upload file
            $FileName = '';
            if ($request->postFiles['name'] != '') {
                $file = DB::table('qw_sop')->select('file')
                    ->where('sop_id', intval($request->sop_id))->first();

                if ($request->postFiles['name'] != $file->file) {
                    $tmpFile = $request->postFiles;
                    $ke = $tmpFile['path'];
                    $file = public_path('assets/tmp/') . $tmpFile['name'];
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $FileName = Carbon::now()->format('dmYhis') . '.' . $ext;
                    $unlinkpath = public_path('assets/tmp/');
                    copy($file, $ke . $FileName);
                    @unlink($unlinkpath . $tmpFile['name']);
                    @unlink($ke . $file->file);
                } else {
                    $FileName = $file->file;
                }
            }

            //exit();

            $update = DB::table('qw_sop')
                ->where('sop_id', $request->sop_id)
                ->update([
                    'title'         => $request->title,
                    'sop'           => htmlentities($request->sop),
                    'devision'      => $request->devision,
                    'gambar'        => $img,
                    'file'          => $FileName
                ]);
            if ($update) {
                $error = false;
                $alert = 'SOP updated successfully';
            } else {
                $alert = 'failed to Update';
            }
        }
        $response = array(
            'error' => $error,
            'alert' => $alert
        );
        echo json_encode($response);
    }


    public function ajaxDelete(Request $request)
    {
        $error = true;
        $alert = '';
        if ($request->sop_id == '') {
            $pesan .= 'Error Delete...!';
        } else {

            $delete = DB::table('qw_sop')->where('sop_id', intval($request->sop_id))->delete();
            if ($delete) {
                $error = false;
                $alert = 'SOP Delete successfully';
            } else {
                $alert = 'failed to Delete';
            }
        }

        $response = array(
            'error' => $error,
            'alert' => $alert,
            'sop_id' => intval($request->sop_id)
        );
        echo json_encode($response);
    }

    public function sopDownload($sop_id){
        $id = base64_decode(urldecode($sop_id));
        $id = str_replace(md5('qw-img'), '', $id);
        $file = DB::table('qw_sop')->select('title', 'gambar')
            ->where('sop_id', intval($id))->first();
        if ($file) {
            $downloadFile = $file->gambar;
            // $filename       = uploadPath . 'modules/download/' . $downloadFile;
            $filename       = public_path('assets/images/') . $downloadFile;
            $mime_type       = mime_content_type(public_path('assets/images/') . $downloadFile);
            $ext = '.' . pathinfo($filename, PATHINFO_EXTENSION);
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime_type);

            header('Content-Disposition: attachment; filename=' . basename($file->title . $ext));
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filename));
            ob_clean();
            flush();
            readfile($filename);
        }
        exit();
    }

    public function sopDownloadFile($sop_id){

        $id = base64_decode(urldecode($sop_id));
        $id = str_replace(md5('qw-img'), '', $id);
        $file = DB::table('qw_sop')->select('title', 'file')
            ->where('sop_id', intval($id))->first();
        if ($file) {
            $downloadFile = $file->file;
            // $filename       = uploadPath . 'modules/download/' . $downloadFile;
            $filename       = public_path('assets/file/') . $downloadFile;
            $mime_type       = mime_content_type(public_path('assets/file/') . $downloadFile);
            $ext = '.' . pathinfo($filename, PATHINFO_EXTENSION);
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime_type);

            header('Content-Disposition: attachment; filename=' . basename($file->title . $ext));
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filename));
            ob_clean();
            flush();
            readfile($filename);
        }
        exit();

    }



}
