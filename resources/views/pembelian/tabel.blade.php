@extends('index')
@section('head')
<link rel="stylesheet" href="{{ asset('asset/lte/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('asset/lte/assets/css/lib/datatable/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('asset/lte/assets/css/lib/datatable/buttons.bootstrap.min.css')}}">

<link rel="stylesheet" href="{{ asset('asset/lte2/plugins/daterangepicker/daterangepicker.css')}}">
@endsection
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Pembelian Bahan Baku</strong>
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
                                                <a href="../pembelian"><button type="button" class="btn btn-primary">Tambah Pembelian</button></a>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 193px;">ID Pembelian</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 213px;">User</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 213px;">Tanggal</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 213px;">Total</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 213px;">Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach($pembelian as $p)
                                            <tr>
                                                <td>{{ $p->ID_PEMBELIAN }}</td>
                                                @foreach($user as $u)
                                                    @if($u->ID_USER == $p->ID_USER)
                                                        <td>{{ $u->NAMA_USER }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ \Carbon\Carbon::parse($p->TGL_PEMBELIAN)->translatedFormat('d-m-Y H:i') }}</td>
                                                <td>{{ number_format($p->TOTAL_PEMBELIAN) }}</td>
                                                <td align="center">
                                                    <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit{{ $p->ID_PEMBELIAN }}">DETAIL</a>
                                                    <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bukti{{ $p->ID_PEMBELIAN }}">BUKTI</a>

                                                    <div class="modal fade" id="edit{{ $p->ID_PEMBELIAN  }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-6" align="left">
                                                                            <h5 class="modal-title" id="largeModalLabel"><strong>Detail Pembelian Bahan Baku</strong></h5>
                                                                        </div>
                                                                        <div class="col col-md-6" align="right">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="bootstrap-data-table_info">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Bahan Baku</th>
                                                                                <th scope="col">Harga</th>
                                                                                <th scope="col">Jumlah</th>
                                                                                <th scope="col">Disc</th>
                                                                                <th scope="col">Subtotal</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($detail_pembelian as $dp)
                                                                                @if($dp->ID_PEMBELIAN == $p->ID_PEMBELIAN)
                                                                                <tr>
                                                                                    @foreach($bahan_baku as $bb)
                                                                                        @if($bb->ID_BAHAN_BAKU == $dp->ID_BAHAN_BAKU)
                                                                                            <td>{{ $bb->NAMA_BAHAN_BAKU }}</td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <td>{{ number_format($dp->HARGA_BELI) }}</td>
                                                                                    <td>{{ $dp->JUMLAH }}</td>
                                                                                    <td>{{ number_format($dp->DISC) }}</td>
                                                                                    <td>{{ number_format($dp->SUBTOTAL) }}</td>
                                                                                </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade show" id="bukti{{ $p->ID_PEMBELIAN  }}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel">
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
                                                                        <img src="{{ asset($p->BUKTI_PEMBELIAN) }}" width="300px">
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
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/init/datatables-init.js')}}"></script>
    <script src="{{ asset('asset/lte2/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('asset/lte2/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>

  @endsection