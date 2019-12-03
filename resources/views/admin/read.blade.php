@section('title', 'SOP')
@extends('admin/admin-theme')
@section('content')

<?php

function seo_slug($str){
	
	$seo = strtolower(str_replace(' ','-',preg_replace('/[^a-zA-Z0-9_ %\[\]\.%&-]/s', '', $str)));
	return $seo;
}



$html='';
foreach($sop as $data){
    $html.='
            <div class="card-body">
                <div class="callout callout-success">
                    <h4>'.$data->title.'</h4>
                    <a href="'.url('admin/sop/read/'.$data->sop_id.'/'.seo_slug($data->title)).'" class="btn btn-primary btn-sm pl-5 pr-5  ">Read</a>
                </div>
            </div>
    
        ';
}


?>


<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-retweet"></i>
                    SOP Developer
                </h3>
            </div>
            <?= $html ?>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>



@endsection