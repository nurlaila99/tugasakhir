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
                            <div class="card-body">
                                @foreach($penjualan as $p)
                                <div class="row form-group">
                                    <div class="col col-md-12" align="center"><strong><label for="text-input" class=" form-control-label">INVOICE<br>{{ $p->ID_PENJUALAN }}</label></strong></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-2"><strong><label for="text-input" class=" form-control-label">Kasir</label></strong></div>
                                    <div class="col-12 col-md-4">
                                        @foreach($user as $u)
                                            @if($u->ID_USER == $p->ID_USER)
                                                <strong><span>: {{ $u->NAMA_USER }}</span></strong>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-12 col-md-2"><strong><label for="text-input" class=" form-control-label">Tanggal</label></strong></div>
                                    <div class="col-12 col-md-4"><strong><span>: {{ $p->TGL_PENJUALAN }}</span></strong></div>
                                </div>                                   
                                    
                                    <table class="table table-striped">
                                        
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 193px;">Produk</th>
                                                <th style="width: 313px;">Harga</th>
                                                <th style="width: 313px;">Qty</th>
                                                <th style="width: 313px;">Disc</th>
                                                <th style="width: 113px;">Subtotal</th>
                                        </thead>
                                        <tbody>
                                            @foreach($detail_penjualan as $dp)
                                                @if($dp->ID_PENJUALAN == $p->ID_PENJUALAN)
                                                    <tr>
                                                        @foreach($produk as $pr)
                                                            @if($pr->ID_PRODUK == $dp->ID_PRODUK)
                                                                <td>{{ $pr->NAMA_PRODUK }}</td>
                                                            @endif
                                                        @endforeach
                                                        <td>{{ number_format($dp->HARGA_JUAL) }}</td>
                                                        <td>{{ $dp->JUMLAH }}</td>
                                                        <td>{{ number_format($dp->DISC) }}</td>
                                                        <td>{{ number_format($dp->SUBTOTAL) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                <div class="row form-group">
                                    <div class="col-12 col-md-8"></div>
                                    <div class="col-12 col-md-2" align="left"><strong><label for="text-input" class=" form-control-label">Bill</label></strong></div>
                                    <div class="col-12 col-md-2"><strong><span>: Rp {{ number_format($p->TOTAL_PENJUALAN) }}</span></strong></div>
                                </div>
                                <div class="clearfix" align="center">
                                    <a href="../penjualan/invoice/cetak/{{ $p-> ID_PENJUALAN }}"><button class="btn btn-primary">CETAK</button>
                                </div>
                                @endforeach
                                
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

    <script type="text/javascript">
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            $('#reservation').daterangepicker({
                startDate: start,
                endDate: end
            })
        })
    </script>
  @endsection