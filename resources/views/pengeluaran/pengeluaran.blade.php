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
                                <strong class="card-title">Data Pengeluaran Operasional</strong>
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#largeModal">Tambah Pengeluaran</button>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row form-group">
                                                            <div class="col col-md-6">
                                                                <h5 class="modal-title" id="largeModalLabel"><strong>Tambah Pengeluaran Operasional</strong></h5>
                                                            </div>
                                                            <div class="col col-md-6" align="right">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="pengeluaran/store" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        @csrf
                                                    <div class="modal-body">
                                                    <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal</label></div>
                                                            <div class="col-12 col-md-9"><input type="text" id="tanggal" name="tanggal" value="{{ date('d-m-Y') }}" class="form-control" readonly></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">User</label></div>
                                                            <div class="col-12 col-md-9">
                                                                @if(\Session::has('login'))
                                                                    <input type="hidden" name="user" value="{{ Session::get('id') }}" class="form-control">
                                                                    <input type="text" name="usernama" value="{{ Session::get('nama') }}" class="form-control" readonly>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Pengeluaran</label></div>
                                                            <div class="col-12 col-md-9">
                                                                <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control">
                                                                    <option value="">Please select</option>
                                                                    @foreach($jenis_pengeluaran as $jp)
                                                                        <option value="{{ $jp->ID_JENIS_PENGELUARAN }}">{{ $jp->NAMA_JENIS_PENGELUARAN }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nominal</label></div>
                                                            <div class="col-12 col-md-9"><input type="number" id="total" name="total" placeholder="Masukkan Nominal Pengeluaran" class="form-control"></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Keterangan</label></div>
                                                            <div class="col-12 col-md-9"><textarea name="keterangan" id="keterangan" rows="9" placeholder="Keterangan" class="form-control"></textarea></div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bukti Pengeluaran</label></div>
                                                            <div class="col-12 col-md-9"><input type="file" id="file" name="file" class="form-control-file"></div>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 193px;">ID Pengeluaran</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">User</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Jenis Pengeluaran</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Tanggal</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Total</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 113px;">Bukti</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pengeluaran_bulanan as $p)
                                            <tr>
                                                <td>{{ $p->ID_PENGELUARAN }}</td>
                                                @foreach($user as $u)
                                                    @if($u->ID_USER == $p->ID_USER)
                                                        <td>{{ $u->NAMA_USER }}</td>
                                                    @endif
                                                @endforeach
                                                @foreach($jenis_pengeluaran as $jp)
                                                    @if($p->ID_JENIS_PENGELUARAN == $jp->ID_JENIS_PENGELUARAN)
                                                        <td>{{ $jp->NAMA_JENIS_PENGELUARAN }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ \Carbon\Carbon::parse($p->TGL_PENGELUARAN)->translatedFormat('d-m-Y H:i') }}</td>
                                                <td>{{ number_format($p->TOTAL_PENGELUARAN) }}</td>
                                                <td align="center">
                                                    <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bukti{{ $p->ID_PENGELUARAN }}">BUKTI</a>
                                                    <div class="modal fade show" id="bukti{{ $p->ID_PENGELUARAN  }}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="smallmodalLabel"><strong>Bukti Pembelian Bahan Baku</strong></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <center>
                                                                        <img src="{{ asset($p->BUKTI_PENGELUARAN) }}" width="300px">
                                                                    </center>
                                                                </div>
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