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
                                <strong class="card-title">Data Bahan Baku</strong>
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#largeModal">Tambah Bahan Baku</button><br><br>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row form-group">
                                                            <div class="col col-md-6">
                                                                <h5 class="modal-title" id="largeModalLabel">Tambah Bahan Baku</h5>
                                                            </div>
                                                            <div class="col col-md-6" align="right">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="../bahan_baku/store" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Bahan Baku</label></div>
                                                            <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" placeholder="Masukkan Nama Bahan Baku" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Bahan Baku</label></div>
                                                            <div class="col-12 col-md-9">
                                                                <select name="jenis_bahan_baku" id="jenis_bahan_baku" class="form-control">
                                                                    <option value="">Please select</option>
                                                                    @foreach($jenis_bahan_baku as $jbb)
                                                                        <option value="{{ $jbb->ID_JENIS_BAHAN_BAKU }}">{{ $jbb->NAMA_JENIS_BAHAN_BAKU }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga</label></div>
                                                            <div class="col-12 col-md-9"><input type="number" id="harga" name="harga" placeholder="Masukkan Harga" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Stok</label></div>
                                                            <div class="col-12 col-md-9"><input type="number" id="stok" name="stok" placeholder="Masukkan Stok" class="form-control"></div>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 193px;">ID Bahan Baku</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Nama Bahan Baku</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 313px;">Jenis Bahan Baku</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 113px;">Harga</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 113px;">Stok</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 113px;">Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach($bahan_baku as $b)
                                            <tr>
                                                <td>{{ $b->ID_BAHAN_BAKU }}</td>
                                                <td>{{ $b->NAMA_BAHAN_BAKU }}</td>
                                                <td>
                                                @foreach($jenis_bahan_baku as $jbb)
                                                    @if($b->ID_JENIS_BAHAN_BAKU == $jbb->ID_JENIS_BAHAN_BAKU)
                                                        {{ $jbb-> NAMA_JENIS_BAHAN_BAKU }}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>{{ $b->HARGA }}</td>
                                                <td>{{ $b->STOK }}</td>
                                                <td align="center">
                                                    
                                                    <a class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit{{ $b->ID_BAHAN_BAKU }}"><i class="fa fa-edit"></i></a>
                                                    <div class="modal fade" id="edit{{ $b->ID_BAHAN_BAKU }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-6" align="left">
                                                                            <h5 class="modal-title" id="largeModalLabel">Edit Bahan Baku</h5>
                                                                        </div>
                                                                        <div class="col col-md-6" align="right">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <form action="../bahan_baku/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                    @csrf
                                                                <div class="modal-body">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">ID Bahan Baku</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="id_bahan_baku" name="id_bahan_baku" value="{{ $b->ID_BAHAN_BAKU }}" class="form-control" readonly></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Nama Bahan Baku</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="text" id="nama" name="nama" value="{{ $b->NAMA_BAHAN_BAKU }}" class="form-control"></div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Jenis Bahan Baku</label></div>
                                                                        <div class="col-12 col-md-9" align="left">
                                                                            <select name="jenis_bahan_baku" id="jenis_bahan_baku" class="form-control">
                                                                                @foreach($jenis_bahan_baku as $jbb)
                                                                                    @if($jbb->ID_JENIS_BAHAN_BAKU == $b->ID_JENIS_BAHAN_BAKU)
                                                                                        <option value="{{ $jbb->ID_JENIS_BAHAN_BAKU }}">{{ $jbb->NAMA_JENIS_BAHAN_BAKU }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                                @foreach($jenis_bahan_baku as $jbb)
                                                                                    @if($jbb->ID_JENIS_BAHAN_BAKU != $b->ID_JENIS_BAHAN_BAKU)
                                                                                        <option value="{{ $jbb->ID_JENIS_BAHAN_BAKU }}">{{ $jbb->NAMA_JENIS_BAHAN_BAKU }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Harga</label></div>
                                                                        <div class="col-12 col-md-9" align="left"><input type="number" id="harga" name="harga" value="{{ $b->HARGA }}" class="form-control"></div>
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