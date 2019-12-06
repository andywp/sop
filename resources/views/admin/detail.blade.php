@section('title', $sop->title)
@extends('admin/admin-theme')
@section('content')

<div class="row">
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-default p-4">
            <?= htmlspecialchars_decode(html_entity_decode($sop->sop)) ?>
        </div>
        <?php if(!empty($sop->gambar) || !empty($sop->file)){ ?>
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Attachmente</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <?= !empty($sop->gambar)?'<a  href="'.url('admin/sop/download/img/'.base64_encode(md5('qw-img').$sop->sop_id)).'"  class="btn btn-outline-primary mr-3 "> <i class="fas fa-images"></i> images</a>':''; ?>
                <?= !empty($sop->file)?'<a target="_blank" href="'.url('admin/sop/download/file/'.base64_encode(md5('qw-img').$sop->sop_id)).'"  class="btn btn-outline-primary  mr-3 "> <i class="fas fa-file-pdf"></i> PDF</a>':''; ?>
            </div>
            <!-- /.card-body -->
        </div>

        <?php } ?>
    </div>
</div>
@endsection