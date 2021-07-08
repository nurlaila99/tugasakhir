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
                                <strong class="card-title">Laporan Pengeluaran Operasional</strong>
                            </div>
                            <div class="card-body">
                            <form action="/pengeluaran/report" method="get">
                                    <div class="row form-group">
                                        <div class="col col-md-2" align="left"><strong><label for="text-input" class=" form-control-label">Periode</label></strong></div>
                                        <div class="col-12 col-md-3" align="left">
                                            <input type="text" class="form-control float-right" id="reservation" name="date">                                      
                                        </div>
                                        <div class="col-12 col-md-1" align="left">
                                            <button class="btn btn-success" type="submit">Filter</button>                                        
                                        </div>
                                        <div class="col-12 col-md-1" align="left">
                                            <a target="_blank" class="btn btn-primary" id="exportpdf">Cetak Laporan</a>                                     
                                        </div>
                                    </div>
                            </form>
                                <div id="bootstrap-data-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">                                    
                                    <table class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="bootstrap-data-table_info">
                                        
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 193px;">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Tanggal</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Jenis Pengeluaran</th>
                                                <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 313px;">Subtotal</th>
                                        </thead>
                                        <tbody>
                                            @foreach($pengeluaran_bulanan as $p)
                                                <tr>
                                                    <td>{{ $p->ID_PENGELUARAN }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($p->TGL_PENGELUARAN)->translatedFormat('d-m-Y H:i') }}</td>
                                                    @foreach($jenis_pengeluaran as $j)
                                                        @if($j->ID_JENIS_PENGELUARAN == $p->ID_JENIS_PENGELUARAN)
                                                            <td>{{ $j->NAMA_JENIS_PENGELUARAN }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{ number_format($p->TOTAL_PENGELUARAN) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" style="text-align: center"><strong>TOTAL</strong></td>
                                                <td><strong>{{ number_format($total_pengeluaran) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
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

            $('#exportpdf').attr('href', '../pengeluaran/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            $('#reservation').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '../pengeluaran/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
  @endsection