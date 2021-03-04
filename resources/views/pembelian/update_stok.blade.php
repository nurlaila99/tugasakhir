@extends('index')
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Update Stok Bahan Baku</strong>
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
                            <form method="post" action="update_stok/store" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="tanggal" name="tanggal" value="{{ date('d-m-Y') }}" class="form-control" readonly></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bahan Baku</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="bahan_baku" id="bahan_baku" class="form-control">
                                            <option value="">Please select</option>
                                            @foreach($bahan_baku as $bb)
                                                <option value="{{ $bb->ID_BAHAN_BAKU }}">{{ $bb->NAMA_BAHAN_BAKU }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Stok</label></div>
                                    <div class="col-12 col-md-9"><input type="number" id="stok" name="stok" placeholder="0" class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12" align="center">
                                        <input class="btn btn-primary" type="submit" value="Update">
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

    <script type="text/javascript">
        var barang = <?php echo json_encode($bahan_baku); ?>;
        
        jQuery(document).ready(function ()
        {
                jQuery('select[name="bahan_baku"]').on('change',function(){
                var id = jQuery(this).val();
                if(id)
                {
                    var index;
                    for(var i=0;i<barang.length;i++){
                        if(barang[i]["ID_BAHAN_BAKU"]==id){
                            console.log(barang[i]);
                            index=i;
                            break;
                        }
                    }

                    document.getElementById("stok").value = barang[i]["STOK"];
                }
                });
        });
    </script>
  @endsection