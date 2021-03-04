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
    @foreach($penjualan as $p)
    @foreach($pembayaran as $pb)
    @if($p->ID_PENJUALAN == $pb->ID_PENJUALAN)
    <h4 align="center">CTHAITEA<br>NOTA PEMBAYARAN<br>{{ $pb->ID_PEMBAYARAN }}</h4>
    <br>
    <h5>
        Tanggal : {{$pb->WAKTU_PEMBAYARAN}}<br>
        @foreach($user as $u)
            @if($u->ID_USER == $pb->ID_USER)
                Kasir : {{ $u->NAMA_USER }}
            @endif
        @endforeach
    </h5>
    <br>
    <table width="100%" class="table-hover table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Disc</th>
                <th>Subtotal</th>
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
                        <td>{{ number_format($dp->HARGA_JUAL) }}</td>
                        <td>{{ $dp->JUMLAH }}</td>
                        <td>{{ number_format($dp->DISC) }}</td>
                        <td>{{ number_format($dp->SUBTOTAL) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <br>
    <h5>
        Total Bayar : Rp {{ number_format($pb->TOTAL_PEMBAYARAN) }}
    </h5>
    @endif
    @endforeach
    @endforeach
</body>
</html>