@extends('index')
@section('konten')
<div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">$<span class="count">{{$totalpenjualan}}</span></div>
                                            <div class="stat-heading">Penghasilan Bulan Ini</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{$banyakpenjualan}}</span></div>
                                            <div class="stat-heading">Penjualan Bulan Ini</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">$<span class="count">{{$total}}</span></div>
                                            <div class="stat-heading">Pengeluaran Bulan Ini</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Stok Bahan Baku</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        @foreach($bahan_baku as $bb)
                                        <div class="progress-box progress-1">
                                            <h4 class="por-title">{{ $bb->NAMA_BAHAN_BAKU }}</h4>
                                            @if($bb->SATUAN == '1')
                                                <div class="por-txt">{{ $bb->STOK }} Kg</div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: {{ $bb->STOK / 10 * 100 }}%;" aria-valuenow="{{ $bb->STOK / 10 * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            @elseif($bb->SATUAN == '2')
                                                <div class="por-txt">{{ $bb->STOK }} Pack</div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: {{ $bb->STOK / 10 * 100 }}%;" aria-valuenow="{{ $bb->STOK / 10 * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            @elseif($bb->SATUAN == '3')
                                                <div class="por-txt">{{ $bb->STOK }} Pcs</div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: {{ $bb->STOK / 10 * 100 }}%;" aria-valuenow="{{ $bb->STOK / 10 * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div> <!-- /.card-body -->
                                </div>
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>
                 <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
@endsection