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
                                <strong class="card-title">Data Jabatan</strong>
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#largeModal">Tambah Jabatan</button><br><br>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row form-group">
                                                            <div class="col col-md-6">
                                                                <h5 class="modal-title" id="largeModalLabel">Tambah Jabatan</h5>
                                                            </div>
                                                            <div class="col col-md-6" align="right">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="../jabatan/store" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Jabatan</label></div>
                                                            <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" placeholder="Masukkan Nama Jabatan" class="form-control"></div>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 193px;">ID Jabatan</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Nama Jabatan</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 113px;">Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach($jabatan as $j)
                                            <tr>
                                                <td>{{ $j->ID_JABATAN }}</td>
                                                <td>{{ $j->NAMA_JABATAN }}</td>
                                                <td align="center">
                                                    <a class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit{{ $j->ID_JABATAN }}"><i class="fa fa-edit"></i></a>
                                                    <div class="modal fade" id="edit{{ $j->ID_JABATAN  }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-6" align="left">
                                                                            <h5 class="modal-title" id="largeModalLabel">Edit Jabatan</h5>
                                                                        </div>
                                                                        <div class="col col-md-6" align="right">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <form action="../jabatan/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                    @csrf
                                                                <div class="modal-body">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">ID Jabatan</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="id_jabatan" name="id_jabatan" value="{{ $j->ID_JABATAN }}" class="form-control" readonly></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Nama Jabatan</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="nama" name="nama" value="{{ $j->NAMA_JABATAN }}" class="form-control"></div>
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