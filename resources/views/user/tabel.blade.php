@extends('index')
@section('head')
<link rel="stylesheet" href="{{ asset('asset/lte/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endsection
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data User</strong>
                            </div>
                            <div class="card-body">
                            @if($message = Session::get('success'))
                                <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                    <span class="badge badge-pill badge-primary">Success</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if(count($errors) > 0)
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    @foreach($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif

                                <div id="bootstrap-data-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">                                    
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="bootstrap-data-table_info">
                                        <div class="row">
                                            <div class="col-md-12" align="right">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#largeModal">Tambah User</button><br><br>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row form-group">
                                                            <div class="col col-md-6">
                                                                <h5 class="modal-title" id="largeModalLabel">Tambah User</h5>
                                                            </div>
                                                            <div class="col col-md-6" align="right">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="../user/store" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama</label></div>
                                                            <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" placeholder="Masukkan Nama User" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jabatan</label></div>
                                                            <div class="col-12 col-md-9">
                                                                <select name="jabatan" id="jabatan" class="form-control">
                                                                    <option value="">Please select</option>
                                                                    @foreach($jabatan as $j)
                                                                        <option value="{{ $j->ID_JABATAN }}">{{ $j->NAMA_JABATAN }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Telepon</label></div>
                                                            <div class="col-12 col-md-9"><input type="number" id="no_tlp" name="no_tlp" placeholder="Masukkan No Telepon" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Alamat</label></div>
                                                            <div class="col-12 col-md-9"><input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                                            <div class="col-12 col-md-9"><input type="email" id="email" name="email" placeholder="Masukkan Email" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                                                            <div class="col-12 col-md-9"><input type="text" id="username" name="username" placeholder="Masukkan Username" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Password</label></div>
                                                            <div class="col-12 col-md-9"><input type="password" id="password" name="password" placeholder="Masukkan Password" class="form-control"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 193px;">ID User</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 139px;">Jabatan</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 139px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 313px;">Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach($user as $u)
                                            <tr>
                                                <td>{{ $u->ID_USER}}</td>
                                                <td>{{ $u->NAMA_USER }}</td>
                                                <td>
                                                @foreach($jabatan as $j)
                                                    @if($u->ID_JABATAN == $j->ID_JABATAN)
                                                        {{ $j-> NAMA_JABATAN }}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                @if($u->STATUS_PEGAWAI == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-secondary">Non-active</span>
                                                @endif
                                                </td>
                                                <td align="center">
                                                    <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#detail{{ $u->ID_USER }}"><i class="fa fa-bars"></i></a>
                                                    <div class="modal fade" id="detail{{ $u->ID_USER }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-6" align="left">
                                                                            <h5 class="modal-title" id="largeModalLabel">Detail User</h5>
                                                                        </div>
                                                                        <div class="col col-md-6" align="right">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Nama</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><label for="text-input" class=" form-control-label">: {{ $u->NAMA_USER }}</label></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Jabatan</label></div>
                                                                        <div class="col-12 col-md-9" align="left">
                                                                            @foreach($jabatan as $j)
                                                                                @if($j->ID_JABATAN == $u->ID_JABATAN)
                                                                                    <label for="text-input" class=" form-control-label">: {{ $j->NAMA_JABATAN }}</label>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">No Telepon</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><label for="text-input" class=" form-control-label">: {{ $u->TLP_USER }}</label></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Alamat</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><label for="text-input" class=" form-control-label">: {{ $u->ALAMAT_USER }}</label></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Email</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><label for="text-input" class=" form-control-label">: {{ $u->EMAIL_USER }}</label></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Username</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><label for="text-input" class=" form-control-label">: {{ $u->USERNAME }}</label></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Status</label></div>
                                                                        <div class="col-12 col-md-9" align="left">
                                                                            @if($u->STATUS_PEGAWAI == 1)
                                                                                <label for="text-input" class=" form-control-label">: Active</label>
                                                                            @else
                                                                                <label for="text-input" class=" form-control-label">: Non-active</label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit{{ $u->ID_USER }}"><i class="fa fa-edit"></i></a>
                                                    <div class="modal fade" id="edit{{ $u->ID_USER }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-6" align="left">
                                                                            <h5 class="modal-title" id="largeModalLabel">Edit User</h5>
                                                                        </div>
                                                                        <div class="col col-md-6" align="right">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <form action="../user/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                    @csrf
                                                                <div class="modal-body">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">ID User</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="id_user" name="id_user" value="{{ $u->ID_USER }}" class="form-control" readonly></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Nama</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="nama" name="nama" value="{{ $u->NAMA_USER }}" class="form-control"></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Jabatan</label></div>
                                                                        <div class="col-12 col-md-9" align="left">
                                                                            <select name="jabatan" id="jabatan" class="form-control">
                                                                                @foreach($jabatan as $j)
                                                                                    @if($u->ID_JABATAN == $j->ID_JABATAN)
                                                                                        <option value="{{ $j->ID_JABATAN }}">{{ $j->NAMA_JABATAN }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                                @foreach($jabatan as $j)
                                                                                    @if($u->ID_JABATAN != $j->ID_JABATAN)
                                                                                        <option value="{{ $j->ID_JABATAN }}">{{ $j->NAMA_JABATAN }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">No Telepon</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="number" id="no_tlp" name="no_tlp" value="{{ $u->TLP_USER }}" class="form-control"></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Alamat</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="alamat" name="alamat" value="{{ $u->ALAMAT_USER }}" class="form-control"></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Email</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="email" id="email" name="email" value="{{ $u->EMAIL_USER }}" class="form-control"></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Username</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="username" name="username" value="{{ $u->USERNAME }}" class="form-control"></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Status</label></div>
                                                                        <div class="col-12 col-md-9" align="left">
                                                                            <select name="status" id="status" class="form-control">
                                                                                    @if($u->STATUS_PEGAWAI == 1)
                                                                                        <option value="1">Active</option>
                                                                                        <option value="0">Non-active</option>
                                                                                    @else
                                                                                        <option value="0">Non-active</option>
                                                                                        <option value="1">Active</option>
                                                                                    @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        @endsection

    @section('script')
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/pdfmake.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/init/datatables-init.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
  </script>
  @endsection