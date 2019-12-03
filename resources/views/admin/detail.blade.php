@section('title', $sop->title)
@extends('admin/admin-theme')
@section('content')

<div class="row">
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-default p-4">
            <?= htmlspecialchars_decode( html_entity_decode($sop->sop)) ?>
        </div>
    </div>
</div>
@endsection