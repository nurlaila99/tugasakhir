<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .container{
            margin:0 auto;
            margin-top:35px;
            padding:0px;
            width:700px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:700px;
        }
        td, tr, th{
            padding:2px;
            border:1px solid #333;
            width:100px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
    <h4 align="center">CTHAITEA GRESIK</h4>
    <h4 align="center">Laporan Keuangan</h4>
    <h4 align="center">{{ $date[0] }} - {{ $date[1] }}</h4>
    <br>
    <h5>PEMASUKAN</h5>
    <h5>Penjualan</h5>
    <table width="100%" class="table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Nota</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan as $p)
                @if($p->STATUS_PEMBAYARAN == 1)
                <tr>
                    <td>{{ $p->ID_PENJUALAN }}</td>
                    @foreach($user as $u)
                        @if($u->ID_USER == $p->ID_USER)
                            <td>{{ $u->NAMA_USER }}</td>
                        @endif
                    @endforeach
                    <td>{{ $p->TGL_PENJUALAN }}</td>
                    <td text-align="left">Rp {{ number_format($p->TOTAL_PENJUALAN) }}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" text-align="left"><strong>TOTAL</strong></td>
                <td text-align="left"><strong>Rp {{ number_format($total_penjualan) }}<strong></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <h3>PENGELUARAN</h3>
    <h4>Pembelian Bahan Baku</h4>
    <table width="100%" class="table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Pembelian</th>
                <th>Pegawai</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
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
                    <td>{{ $p->TGL_PEMBELIAN }}</td>
                    <td>Rp {{ number_format($p->TOTAL_PEMBELIAN) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" text-align="left"><strong>TOTAL</strong></td>
                <td text-align="left"><strong>Rp {{ number_format($total_pembelian) }}<strong></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <h4>Pengeluaran Lainnya</h4>
    <table width="100%" class="table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Pengeluaran</th>
                <th>Pegawai</th>
                <th>Pengeluaran</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluaran_bulanan as $p)
                <tr>
                    <td>{{ $p->ID_PENGELUARAN }}</td>
                    @foreach($user as $u)
                        @if($u->ID_USER == $p->ID_USER)
                            <td>{{ $u->NAMA_USER }}</td>
                        @endif
                    @endforeach
                    @foreach($jenis_pengeluaran as $jp)
                        @if($p->ID_JENIS_PENGELUARAN == $jp->ID_JENIS_PENGELUARAN)
                            <td>{{ $jp->NAMA_JENIS_PENGELUARAN }}</td>
                        @endif
                    @endforeach
                    <td>{{ $p->TGL_PENGELUARAN }}</td>
                    <td>Rp {{ number_format($p->TOTAL_PENGELUARAN) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" text-align="left"><strong>TOTAL</strong></td>
                <td text-align="left"><strong>Rp {{ number_format($total_pengeluaran) }}<strong></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <h3>
    TOTAL PEMASUKAN     = Rp {{ number_format($total_penjualan) }}
    <br>
    TOTAL PENGELUARAN   = Rp {{ number_format($total) }}
    </h3>
</body>
</html>