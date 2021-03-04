@extends('index')
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Input Pengeluaran</strong>
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
                            <form method="post" action="pengeluaran/store" enctype="multipart/form-data">
                                @csrf
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
                                <div class="row form-group">
                                    <div class="col col-md-12" align="center">
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </div>
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