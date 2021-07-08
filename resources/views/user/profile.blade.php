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
                                <strong class="card-title">Profile</strong>
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

                                <div class="row form-group">
                                    <div class="col-12 col-md-12" align="center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $u->ID_USER }}">EDIT</button>
                                    </div>
                                    <div class="modal fade" id="edit{{ $u->ID_USER }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="row form-group">
                                                        <div class="col col-md-6" align="left">
                                                            <h5 class="modal-title" id="largeModalLabel"><strong>Edit Profile</strong></h5>
                                                        </div>
                                                        <div class="col col-md-6" align="right">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="../profile/update" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                                        <div class="col col-md-3" align="left"><label for="text-input" class=" form-control-label">Password</label></div>
                                                        <div class="col-12 col-md-9" align="left"><input type="password" id="password1" name="password1" value="{{ $pass }}" class="form-control">
                                                        <small class="form-text text-muted" id="text2"></small></div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3" align="left"><label for="text-input" class="form-control-label">Konfirmasi Password</label></div>
                                                        <div class="col-12 col-md-9" align="left"><input type="password" id="password2" name="password2" class="form-control">
                                                        <small class="form-text text-muted" id="text"></small></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button id="btn" type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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