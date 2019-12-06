@section('title', 'Edit SOP')
@extends('admin/admin-theme')

@section('content')

<script type="text/javascript" src="{{ URL::asset('assets/plugin/upload.file.js') }}"></script>
<div class="row">
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Edit SOP</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="saveSOP">
                <div class="card-body">
                    <div class="msg-alert"></div>
                    <div class="row">
                        <div class="col-md-9 col-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{$sop->title}}" class="form-control" id="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label>Devision</label>
                                <select name="devision" class="form-control select2" style="width: 100%;">
                                    <option value="">Pilih Devision</option>
                                    <option value="Technical" <?= ($sop->devision == 'Technical') ? 'selected' : ''; ?>>Technical</option>
                                    <option value="Developer" <?= ($sop->devision == 'Developer') ? 'selected' : ''; ?>>Developer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">SOP</label>
                                <textarea class="editor" name="sop" placeholder="SOP"><?= htmlspecialchars_decode(html_entity_decode($sop->sop)) ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 col-12 col-sm-12">
                            <!--- upload images --->
                            <?php
                                $imgURl=!empty($sop->gambar)?url('assets/images/').'/'.$sop->gambar:URL::asset("assets/img/default.jpg");
                            ?>
                            <script type="text/javascript">
                                function changeClassimages(set) {
                                    var uploadbtn = document.getElementById('button_images');
                                    uploadbtn.className = set;
                                }

                                function hidemsg_images() {
                                    $("#msg_images").fadeOut("slow");
                                }

                                function upload_images() {

                                    var uploadbtn = document.getElementById('button_images');
                                    uploadbtn.className = 'off';

                                    $(".loading_images").fadeIn();

                                    $.ajaxFileUpload({
                                        type: 'POST',
                                        url: '{{url("/ajax/upload-img")}}',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        secureuri: false,
                                        fileElementId: 'images',
                                        data: $.param({
                                            name: 'images'
                                        }),
                                        dataType: 'json',
                                        success: function(data, status) {
                                            if (typeof(data.error) != 'undefined') {
                                                if (data.error != '') {
                                                    $(".loading_images").hide();
                                                    $("#msg_images").html(data.error);
                                                    $("#msg_images").fadeIn("slow");
                                                } else {
                                                    $(".loading_images").hide();
                                                    document.getElementById("file_images").value = data.fileName;
                                                    $("#preview_images").html(data.msg);
                                                    $("#preview_images").fadeIn("slow");
                                                }
                                            }
                                            $("input:file").val("");
                                        },
                                        error: function(data, status, e) {
                                            alert(e);
                                            $("input:file").val("");
                                        }
                                    })

                                    return false;
                                }

                                function removeFile_images() {
                                    // $( document ).ready(function() {
                                    $("#preview_images").html('');
                                    $("#file_images").val('');
                                    $("#btn_remove_images").hide();
                                    $("#btn_restore_images").show();
                                    return false;
                                    // });
                                }

                                function restoreFile_images() {
                                    $("#preview_images").html('<img src="{{ $imgURl  }}">');
                                    $("#file_images").val("{{ $sop->gambar }}");
                                    $("#btn_restore_images").hide();
                                    $("#btn_remove_images").show();
                                    return false;
                                }
                            </script>
                            <div class="form-group">
                                <label class="control-label">Upload images</label>
                                <div class="upload-file ">

                                    <div class="preview">
                                        <div id="preview_images"><img src="{{ $imgURl }}" /></div>
                                    </div>
                                    <span class="bg-transparent"></span>
                                    <div class="upload-file-input">
                                        <a id="btn_remove_images" href="javascript:void(0)" class="delFile" onclick="return removeFile_images()"><i class="fa fa-trash"></i></a>
                                        <a id="btn_restore_images" href="javascript:void(0)" class="restoreFile" onclick="return restoreFile_images()" style="display:none"><i class="fa fa-reply"></i></a>

                                        <p class="button">
                                            <button id="button_images" class="off"><i class="fa fa-upload"></i></button>
                                            <input type="file" id="images" name="file" style="
										font-size: 50px;
										position: absolute;
										opacity: 0; 
										filter:alpha(opacity: 0);
										right: 0;
										top: -1px;
										height:100px;
									" onMouseOver="changeClassimages('on')" onMouseOut="changeClassimages('off')" onChange="return upload_images();" onClick="return hidemsg_images();">
                                        </p>
                                        <!-- <input type="hidden" name="postImages[field][]" value="images"> -->
                                        <input type="hidden" name="postImages[path]" value="{{ public_path('assets/images/')}}">
                                        <input type="hidden" name="postImages[name]" id="file_images" value="{{ $sop->gambar }}">
                                        <!--<input type="hidden" name="postImages[filename][]" value=""> -->
                                    </div>
                                </div>
                                <!--- // upload images --->
                                
                                <!------------------- upload file ---->

                                <?php
                                
                                 function fileIcon($extension){

                                    $archive 	= array('zip','rar');
                                    $audio 		= array('mp3');
                                    $code 		= array('php','js','css','js');
                                    $image 		= array('jpg','jpeg','png','gif');
                                    $movie 		= array('flv','mp4','ogg');
                                
                                    if(in_array(strtolower($extension),$archive)){
                                        $fileIcon = 'fas fa-file-archive';
                                    }
                                    elseif(in_array(strtolower($extension),$audio)){
                                        $fileIcon = 'far fa-file-audio';
                                    }
                                    elseif(in_array(strtolower($extension),$code)){
                                        $fileIcon = 'fas fa-file-code';
                                    }
                                    elseif(in_array(strtolower($extension),$image)){
                                        $fileIcon = 'far fa-image';
                                    }
                                    elseif($extension=='xls'){
                                        $fileIcon = 'fas fa-file-excel';
                                    }
                                    elseif($extension=='pdf'){
                                        $fileIcon = 'far fa-file-pdf';
                                    }
                                    elseif($extension=='ppt'){
                                        $fileIcon = 'far fa-file-powerpoint';
                                    }
                                    elseif($extension=='doc' || $extension=='docx'){
                                        $fileIcon = 'far fa-file-word';
                                    }
                                    elseif($extension=='txt'){
                                        $fileIcon = 'far fa-file-alt';
                                    }
                                    else{
                                        $fileIcon = 'far fa-file';
                                    }
                                
                                    return $fileIcon;
                                }


								$name = 'file';
								$allowedTypes = 'pdf';
                                $maxsize = '';
                                
                                $fFile			= !empty($sop->file)?$sop->file:'';
                                //$fFile			= !empty($sop->file)?public_path('assets/file/').$fFile:'';
                                $extension		= pathinfo(public_path('assets/file/').$fFile, PATHINFO_EXTENSION);					
                                $isSelected 	= !empty($fFile)?' selected':'';
                                $dataTitle 		= !empty($fFile)?$fFile:'No File ...';
                                $dataICon 		= !empty($fFile)?fileIcon($extension):'fa-upload';
                                $dataBtn 		= !empty($fFile)?'Change':'Choose';
								?>
								<script type="text/javascript">
									function upload_<?= $name ?>() {

										$('.upload-info-<?= $name ?>').attr('data-title', 'Uploading ...');

										$.ajaxFileUpload({
											type: 'POST',
											url: '{{url("/ajax/upload-file")}}',
											headers: {
												'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
											},
											secureuri: false,
											fileElementId: '<?= $name ?>',
											data: $.param({
												name: '<?= $name ?>'
											}),
											dataType: 'json',
											success: function(data, status) {
												if (typeof(data.error) != 'undefined') {
													if (data.error != '') {
														$('.upload-info-<?= $name ?>').attr('data-title', data.error);
														$('.upload-info-<?= $name ?>').html('<i class="ace-icon fa fa-upload"></i>');
														$('#btn-upload-<?= $name ?>').removeClass('selected');
														$('#btn-upload-<?= $name ?>').attr('data-title', 'Choose');
														$('#file_<?= $name ?>').val('');
													} else {
														$('.upload-info-<?= $name ?>').attr('data-title', data.fileName);
														$('.upload-info-<?= $name ?>').html('<i class="ace-icon ' + data.fileIcon + '"></i>');
														$('#btn-upload-<?= $name ?>').addClass('selected');
														$('#btn-upload-<?= $name ?>').attr('data-title', 'Change');
														$('#file_<?= $name ?>').val(data.fileUpload);
													}
												}
												$("input:file").val("");
											},
											error: function(data, status, e) {
												alert(e);
												$("input:file").val("");
											}
										})

										return false;
									}

									function removeFile_<?= $name ?>() {
										$("#file_<?= $name ?>").val('');
										$('.upload-info-<?= $name ?>').attr('data-title', 'No File ...');
										$('.upload-info-<?= $name ?>').html('<i class="ace-icon fas fa-upload"></i>');
										$('#btn-upload-<?= $name ?>').removeClass('selected');
										$('#btn-upload-<?= $name ?>').attr('data-title', 'Choose');
										return false;
									}
								</script>
								<div class="form-group">
									<label class="control-label">File <small class="text-warning">pdf</small></label>
									<div class="controls">
										<label class="ace-file-input">
											<input type="file" id="file" name="file" onChange="return upload_file();" />
											<span id="btn-upload-file" data-title="{{ $dataBtn }}" class="ace-file-container{{ $isSelected }}">
												<span data-title="{{ $dataTitle }}" class="ace-file-name upload-info-file">
													<i class="ace-icon {{ $dataICon }}"></i>
												</span>
											</span>
											<a href="javascript:void(0)" class="remove btn_remove_file" onclick="return removeFile_file()"><i class=" ace-icon fa fa-times"></i></a>
										</label>
									</div>

									<input type="hidden" name="postFiles[field]" value="file">
									<input type="hidden" name="postFiles[path]" value="{{ public_path('assets/file/')}}">
									<input type="hidden" name="postFiles[name]" id="file_file" value="{{ $fFile }}">
									<input type="hidden" name="postFiles[filename]" value="">

									<div class="loading_images progress-upload progress progress-small progress-striped active" style="display:none;margin-top:10px;">
										<div style="width: 100%;" class="progress-bar progress-bar-warning"></div>
									</div>
									<div id="msg_images" style="display:none;"></div>
								</div>
								<!-------------------- // upload file --------------------->



                            </div>
                            <!-- laravel token -->
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="sop_id" value="{{ $sop->sop_id }}">

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a title="selesai"  href="{{ url('admin/sop') }}" class="btn btn-success">Finish</a>
                            <button   title="simpan" type="submit" class="btn btn-primary">Update</button>
                        </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $("#saveSOP").submit(function() {
            var xajaxFile = "{{ url('admin/sop/ajax-edit') }}";
            $('.msg-alert').html('');
            $.ajax({

                type: 'POST',
                url: xajaxFile,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#saveSOP").serialize(),
                dataType: 'json',
                success: function(data) {
                    if (!data.error) {
                        $(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
                    } else {
                        $(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
                    }
                }
            });
            return false;
        });



    });
</script>

@endsection