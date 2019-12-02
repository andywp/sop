@section('title', 'Dashboard')
@extends('admin/admin-theme')

@section('content')

<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="card pt-5 pb-5">
            <div class="card-header">
                <h3 class="card-title">Table Manage SOP</h3>

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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Title</th>
                            <th>Team</th>
                            <th colspan="2" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Lorem, ipsum dolor sit amet consectetur</td>
                            <td>Developer</td>
                            <td><a href="#" title="edit" ><i class="fas fa-edit"></i></a></td>
                            <td><a href="#" title="Hapus" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Lorem, ipsum dolor sit amet consectetur</td>
                            <td>Developer</td>
                            <td><a href="#" title="edit" ><i class="fas fa-edit"></i></a></td>
                            <td><a href="#" title="Hapus" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->


@endsection