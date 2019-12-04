@section('title', 'SOP')
@extends('admin/admin-theme')
@section('content')

<?php

function seo_slug($str)
{

    $seo = strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9_ %\[\]\.%&-]/s', '', $str)));
    return $seo;
}



$html = '';
foreach ($sop as $data) {
    $html .= '
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                <div class="card bg-light w-100">
                    <div class="card-header text-muted border-bottom-0">
                    ' . $data->devision . '
                    </div>
                    <div class="card-body pt-0">
                    <h2 class="lead"><b>'.$data->title.'</b></h2>
                    </div>
                    <div class="card-footer">
                        <div class="text-left">
                            <a href="' . url('admin/sop/read/' . $data->sop_id . '/' . seo_slug($data->title)) . '" class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        ';
}


?>



<div class="row d-flex align-items-stretch">
   <?= $html ?>
</div>

@endsection