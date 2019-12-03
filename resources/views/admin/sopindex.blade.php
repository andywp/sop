@section('title', 'Manage SOP')
@extends('admin/admin-theme')
<style type="text/css">
    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-confirm {		
		color: #636363;
		width: 400px;
	}
    .modal-header {
        display: block !important;
    }
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
        text-align: center;
		font-size: 14px;
	}
	.modal-confirm .modal-header {
		border-bottom: none;   
        position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -10px;
	}
	.modal-confirm .close {
        position: absolute;
		top: -5px;
		right: -2px;
	}
	.modal-confirm .modal-body {
		color: #999;
	}
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;		
		border-radius: 5px;
		font-size: 13px;
		padding: 10px 15px 25px;
	}
	.modal-confirm .modal-footer a {
		color: #999;
	}		
	.modal-confirm .icon-box {
		width: 80px;
		height: 80px;
		margin: 0 auto;
		border-radius: 50%;
		z-index: 9;
		text-align: center;
		border: 3px solid #f15e5e;
	}
	.modal-confirm .icon-box i {
		color: #f15e5e;
		font-size: 46px;
		display: inline-block;
		margin-top: 13px;
	}
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
		background: #60c7c1;
		text-decoration: none;
		transition: all 0.4s;
        line-height: normal;
		min-width: 120px;
        border: none;
		min-height: 40px;
		border-radius: 3px;
		margin: 0 5px;
		outline: none !important;
    }
	.modal-confirm .btn-info {
        background: #c1c1c1;
    }
    .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
        background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
        background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
@section('content')


<?php
$html='';
$no=1;
foreach($sop as $data){
    $html.='
            <tr class="sop-'.$data->sop_id.'">
                <td>'.$no.'</td>
                <td>'.$data->title.'</td>
                <td>'.$data->devision.'</td>
                <td><a class="btn btn-success btn-xs"  href="'.url("admin/sop/edit/".$data->sop_id).'" title="edit" ><i class="fas fa-edit"></i></a></td>
                <td><button class="btn btn-danger btn-xs btn-delete" data-id="'.$data->sop_id.'" data-title="'.$data->title.'"   title="Hapus" ><i class="far fa-trash-alt"></i></button></td>
            </tr>
            ';
    $no++;
}

?>




<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="card pt-5 pb-5">
            <div class="card-header">
                <a href="{{ url('admin/sop/add') }}" class="btn  btn-primary" >Add New</a>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="msg-alert"></div>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="table-primary" >
                            <th class="w-1" >NO</th>
                            <th>Title</th>
                            <th>Team</th>
                            <th colspan="2" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $html ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
                    
                    <i class="material-icons fas fa-times"></i>
				</div>				
				<h4 class="modal-title">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p id="yakin" > </p>
			</div>
			<div class="modal-footer">
                <form action="" class="ajax-delete" method="post">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <input id="sopID" type="hidden" value="" name="sop_id">
                    <button type="submit"   class="btn btn-danger ">Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>  




<script type="text/javascript">
    $( document ).ready(function() {
        $(".btn-delete").click(function() {
            var id 	= $(this).data('id');
            var title 	= $(this).data('title');
            $('#myModal').modal({show:true});
            $('#yakin').html('Do you really want to delete <strong>'+title+'</strong> ?' );
            $("#sopID").val(id);
        });

        $(".ajax-delete").submit(function() {
            var xajaxFile = "{{ url('admin/sop/ajax-delete') }}";
            $('.msg-alert').html('');
            $.ajax({ 
                type: 'POST',
                url: xajaxFile,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $(".ajax-delete").serialize(),
                dataType: 'json',
                success: function(data){
                    
                    if(!data.error){
                        $(".sop-"+data.sop_id).remove();
                        $(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
                    }
                    else{
                        $(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
                    }
                }
            });
            return false;

        });

    
    });
</script>



@endsection