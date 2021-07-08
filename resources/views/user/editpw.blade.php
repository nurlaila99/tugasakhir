@extends('index')
@section('head')
<link rel="stylesheet" href="{{ asset('asset/lte/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endsection
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Edit Password</strong>
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
                            @foreach($user as $u)
                                <form action="../editpassword/proses" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-4" align="left"><label for="text-input" class=" form-control-label">Password Baru</label></div>
                                        <div class="col-12 col-md-8" align="left"><input type="hidden" id="id_user" name="id_user" value="{{ $u->ID_USER }}" class="form-control">
                                        <input type="password" id="password1" name="password1" class="form-control">
                                        <small class="form-text text-muted" id="text2"></small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4" align="left"><label for="text-input" class="form-control-label">Konfirmasi Password</label></div>
                                        <div class="col-12 col-md-8" align="left"><input type="password" id="password2" name="password2" class="form-control">
                                        <small class="form-text text-muted" id="text"></small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12 col-md-12" align="center">
                                            <button id="btn" type="submit" class="btn btn-primary" disabled>SAVE</button>
                                        </div>
                                    </div>
                                </form>
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
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('asset/lte/assets/js/init/datatables-init.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );

      jQuery(document).ready(function ()
        {
                jQuery('input[name="password2"]').on('input',function(){
                var pass = jQuery(this).val();
                if(pass)
                {
                    var pass1 = document.getElementById("password1").value;
                    if(pass ==  pass1){
                        document.getElementById("password2").setAttribute('class','is-valid form-control-success form-control');
                        document.getElementById("text").setAttribute('class','form-text text-muted2');
                        document.getElementById("text").innerHTML = 'Password sesuai';
                        document.getElementById("btn").disabled = false;
                    }else{
                        document.getElementById("password2").setAttribute('class','is-invalid form-control');
                        document.getElementById("text").setAttribute('class','form-text text-muted');
                        document.getElementById("text").innerHTML = 'Password tidak sesuai';
                        document.getElementById("btn").disabled = true;
                    }

                }
                });
        });

        jQuery(document).ready(function ()
        {
                jQuery('input[name="password1"]').on('input',function(){
                var pass = jQuery(this).val();
                if(pass)
                {
                    if(pass.length <  6){
                        document.getElementById("password1").setAttribute('class','is-invalid form-control');
                        document.getElementById("text2").setAttribute('class','form-text text-muted');
                        document.getElementById("text2").innerHTML = 'Password minimal 6 karakter';
                        var pass2 = document.getElementById("password2").value;
                        if(pass2 != ''){
                            if(pass ==  pass2){
                                document.getElementById("password2").setAttribute('class','is-valid form-control-success form-control');
                                document.getElementById("text").setAttribute('class','form-text text-muted2');
                                document.getElementById("text").innerHTML = 'Password sesuai';
                                document.getElementById("btn").disabled = false;
                            }else{
                                document.getElementById("password2").setAttribute('class','is-invalid form-control');
                                document.getElementById("text").setAttribute('class','form-text text-muted');
                                document.getElementById("text").innerHTML = 'Password tidak sesuai';
                                document.getElementById("btn").disabled = true;
                            }
                        }
                    }else{
                        document.getElementById("password1").setAttribute('class','is-valid form-control-success form-control');
                        document.getElementById("text2").setAttribute('class','form-text text-muted2');
                        document.getElementById("text2").innerHTML = '';
                    }

                }
                });
        });
  </script>
  @endsection