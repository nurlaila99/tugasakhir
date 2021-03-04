@extends('index')
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Input Pembelian Bahan Baku</strong>
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
                                <form method="post" action="pembelian/store" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Pegawai</label></div>
                                    <div class="col-12 col-md-4">
                                        @if(\Session::has('login'))
                                            <input type="hidden" name="userid" value="{{ Session::get('id') }}" class="form-control">
                                            <input type="text" name="user" value="{{ Session::get('nama') }}" class="form-control" readonly>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Tanggal</label></div>
                                    <div class="col-12 col-md-4"><input type="text" id="date" name="date" value="{{ date('d-m-Y') }}" class="form-control" disabled></div>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalproduk">Pilih Bahan Baku</button>
                                    </div>
                                </div>
                                
                                <table class="table" id="keranjang">
                                        <thead>
                                            <th scope="col">Bahan Baku</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Disc</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-7"></div>
                                    <div class="col-sm-12 col-md-2">
                                        <label><strong>TOTAL</strong></label><br>
                                    </div>
                                    <div class="col-sm-12 col-md-1">
                                        <label>Rp.</label><br>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <input type="hidden" name="totalpayment" id="totalpayment"><label id="total-val">0</label><br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-7"></div>
                                    <div class="col-sm-12 col-md-2">
                                        <label><strong>Upload Bukti</strong></label><br>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="file" id="file" name="file" class="form-control-file">
                                    </div>
                                </div>
                                <div class="clearfix" align="center">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>

                                <!-- Modal -->
                                <div class="modal fade bs-example-modal-lg" id="modalproduk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered>
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Product ID</th>
                                                            <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Product Name</th>
                                                            <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Phone">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $bahan_baku as $bb )
                                                            <tr role="row" class="odd" onclick="pilihBarang('{{ $bb -> ID_BAHAN_BAKU }}')" style="cursor:pointer">
                                                                <td>{{ $bb->ID_BAHAN_BAKU }}</td>
                                                                <td>{{ $bb->NAMA_BAHAN_BAKU }}</td>
                                                                <td>{{ $bb->HARGA }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <div>

                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        @endsection

@section('script')
<script>
	var barang = <?php echo json_encode($bahan_baku); ?>;
	console.log(barang[0]["BAHAN_BAKU"]);
	var colnum=0;

	function getVal(event){
		if (event.keyCode === 13) {
			modal();
		}
	}
	function pilihBarang(id){
		var index;
		for(var i=0;i<barang.length;i++){
			if(barang[i]["ID_BAHAN_BAKU"]==id){
				console.log(barang[i]);
				index=i;
				break;
			}
		}
		jQuery("#modalproduk").modal("hide");

        var table = document.getElementById("keranjang");
        
        var flag=-1;

        for(var z=1; z<table.rows.length; z++)
        {
            var x=table.rows[z].childNodes[0].childNodes[0];
            console.log(x.value);
            if(x.value == barang[index]["ID_BAHAN_BAKU"])
            {
            flag = z;
            break;
            }
        }

        if(flag != -1)
        {
            var colQty = table.rows[flag].childNodes[1].childNodes[0];
            colQty.value = parseInt(colQty.value) + 1;
            var idrow = table.rows[flag].childNodes[0].childNodes[0].value;
            console.log(idrow);
            recount(idrow);
        }
        else
        {
            var row = table.insertRow(table.rows.length);
            row.setAttribute('id','col'+colnum);
            var id = 'col'+colnum;
            colnum++;

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            console.log(index);
            cell1.innerHTML = '<input type="hidden" name="id['+barang[index]["ID_BAHAN_BAKU"]+']" value="'+barang[index]["ID_BAHAN_BAKU"]+'">'+barang[index]["NAMA_BAHAN_BAKU"];
            cell2.innerHTML = '<input type="number" name="qty['+barang[index]["ID_BAHAN_BAKU"]+']" value="1" oninput="recount(\''+barang[index]["ID_BAHAN_BAKU"]+'\')" id="qty'+barang[index]["ID_BAHAN_BAKU"]+'" style="background:transparent; border:none; text-align:left; width=100%">';	
            cell3.innerHTML = '<input class="discount" type="number" name="discount['+barang[index]["ID_BAHAN_BAKU"]+']" value="0" oninput="recount(\''+barang[index]["ID_BAHAN_BAKU"]+'\')" id="discount'+barang[index]["ID_BAHAN_BAKU"]+'" style="background:transparent; border:none; text-align:left; width=100%">';	
            cell4.innerHTML = '<input type="hidden" id="harga'+barang[index]["ID_BAHAN_BAKU"]+'" name="harga['+barang[index]["ID_BAHAN_BAKU"]+']" value="'+barang[index]["HARGA"]+'">'+barang[index]["HARGA"];
            cell5.innerHTML = '<input type="hidden" class="subtotal" name="subtotal['+barang[index]["ID_BAHAN_BAKU"]+']" value="'+barang[index]["HARGA"]+'" id="subtotal'+barang[index]["ID_BAHAN_BAKU"]+'"><span id="subtotalval'+barang[index]["ID_BAHAN_BAKU"]+'">'+barang[index]["HARGA"]+'</span>';
            cell6.innerHTML = '<i class="icon-copy fa fa-trash" onclick="hapusEl(\''+id+'\')" style="cursor:pointer"> Del</i>';

            total();
        }
		
	}
	function lm(i){
		var min =  document.getElementById("qty"+i).value;
		if(min <= 1){

		}else{
		min--;
		document.getElementById("qty"+i).value = min;
		recount(i);
		}
	}
	function ln(i){
		var plus =  document.getElementById("qty"+i).value;
		console.log(plus);
		plus++;
		document.getElementById("qty"+i).value = plus;
		console.log(plus);
		recount(i);
	}
	function total(){
		var subtotals = document.getElementsByClassName("subtotal");
		var total = 0;
		for(var i=0; i<subtotals.length;++i){
			total += Number(subtotals[i].value); 
		}
		total = parseInt(100/100*total);
		document.getElementById("total-val").innerHTML = total;
		document.getElementById("totalpayment").value = total;

	}

	function recount(id){
		var price = document.getElementById("harga"+id).value;
		var discount = document.getElementById("discount"+id).value;
		var sembarang = document.getElementById("qty"+id).value;

		var lego = Number(price*sembarang)-discount; 
		document.getElementById("subtotal"+id).value = lego;
		document.getElementById("subtotalval"+id).innerHTML = lego;
		total();
	}

	function modal(){
		$("#myModal").modal("show");
		document.getElementById("myText").value = "";
	}
	function hapusEl(idCol) {
		document.getElementById(idCol).remove();
		total();
	}


</script>

  
@endsection