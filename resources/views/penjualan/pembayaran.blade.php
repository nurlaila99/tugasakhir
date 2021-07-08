@extends('index')
@section('konten')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Pesanan</strong>
                            </div>
                            <div class="card-body">                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No Meja</th>
                                            <th scope="col">Nota ID</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($penjualan as $p)
                                            @if($p->STATUS_PEMBAYARAN == 0)
                                            <tr>
                                                <td>{{ $p->NO_MEJA }}</td>
                                                <td>{{ $p->ID_PENJUALAN }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p->TGL_PENJUALAN)->translatedFormat('d-m-Y H:i:s') }}</td>
                                                <td>{{ $p->TOTAL_PENJUALAN }}</td>
                                                <td>
                                                <a class="btn btn-outline-primary btn-sm" href="penjualan/invoice/{{ $p->ID_PENJUALAN }}">INVOICE</a>    
                                                <a data-toggle="modal" data-target="#edit{{ $p->ID_PENJUALAN }}"><button class="btn btn-outline-primary btn-sm">PAY</button></a>
                                                    <div class="modal fade" id="edit{{ $p->ID_PENJUALAN  }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row form-group">
                                                                        <div class="col col-md-6" align="left">
                                                                            <h4 class="modal-title" id="largeModalLabel"><strong>Payment</strong></h4>
                                                                        </div>
                                                                        <div class="col col-md-6" align="right">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <form action="../pembayaran/store" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                    @csrf
                                                                <div class="modal-body">
                                                                        <div class="row form-group">
                                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nota ID</label></div>
                                                                            <div class="col-12 col-md-4"><input type="text" id="nota_id" name="nota_id" value="{{ $p->ID_PENJUALAN }}" class="form-control" readonly></div>
                                                                        
                                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Kasir</label></div>
                                                                            <div class="col col-md-4">
                                                                                @if(\Session::has('login'))
                                                                                    <input type="hidden" name="userid" value="{{ Session::get('id') }}" class="form-control">
                                                                                    <input type="text" name="user" value="{{ Session::get('nama') }}" class="form-control" readonly>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col">Produk</th>
                                                                                    <th scope="col">Harga</th>
                                                                                    <th scope="col">Jumlah</th>
                                                                                    <th scope="col">Disc</th>
                                                                                    <th scope="col">Subtotal</th>
                                                                                </tr>
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
                                                                                        <td>{{ $dp->HARGA_JUAL }}</td>
                                                                                        <td>{{ $dp->JUMLAH }}</td>
                                                                                        <td>{{ $dp->DISC }}</td>
                                                                                        <td>{{ $dp->SUBTOTAL }}</td>
                                                                                    </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col col-md-8" align="right"><label for="text-input" class=" form-control-label">TOTAL</label></div>
                                                                            <div class="col-12 col-md-4" align="left"><input type="text" id="total" name="total" value="{{ $p->TOTAL_PENJUALAN }}" class="form-control" readonly></div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col col-md-8" align="right"><label for="text-input" class=" form-control-label">Total Bayar</label></div>
                                                                            <div class="col-12 col-md-4" align="left"><input type="number" id="total_bayar" name="total_bayar" class="form-control" placeholder="Masukkan Total Bayar"></div>
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
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                                
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        @endsection

@section('script')


  
@endsection