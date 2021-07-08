<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
    @page { size: 10cm 20cm potrait; }
        .container{
            margin:0 auto;
            padding:0px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            margin:0 auto;
            font: size 10px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
            font: size 10px;
        }
    </style>
</head>
<body>
    @foreach($penjualan as $p)
    <p align="center"><strong>CTHAITEA<br>Jl. Raya Cerme Lor 167<br></strong></p>
    <br>
    <table width="100%" border="0px">
        <tbody>
            <tr>
                <td align="left">#{{ $p->ID_PENJUALAN }}</td>
                <td align="right">{{$p->TGL_PENJUALAN}}</td>
            </tr>
            <tr>
                <td align="left">
                @foreach($user as $u)
                    @if($u->ID_USER == $p->ID_USER)
                        {{ $u->NAMA_USER }}
                    @endif
                @endforeach</td>
                <td align="right">Meja No. {{ $p->NO_MEJA }}</td>
            </tr>
            <tr>
                <td colspan="2">------------------------------------------------------</td>
            </tr>
        </tbody>
    </table>
    <table width="100%">
        <tbody>
            @foreach($detail_penjualan as $dp)
                @if($dp->ID_PENJUALAN == $p->ID_PENJUALAN)
                    <tr>
                        @foreach($produk as $pr)
                            @if($pr->ID_PRODUK == $dp->ID_PRODUK)
                                <td width="50%">{{ $pr->NAMA_PRODUK }}</td>
                            @endif
                        @endforeach
                        <td align="right" width="10%">{{ $dp->JUMLAH }}</td>
                        <td align="right" width="20%">{{ number_format($dp->HARGA_JUAL) }}</td>
                        <td align="right" width="20%">{{ number_format($dp->SUBTOTAL) }}</td>
                    </tr>
                @endif
            @endforeach
                    <tr>
                        <td colspan="4">------------------------------------------------------</td>
                    </tr>
                    <tr>
                        <td align="left">TOTAL</td>
                        <td></td>
                        <td align="right">Rp</td>
                        <td align="right">{{ number_format($p->TOTAL_PENJUALAN) }}</td>
                    </tr>
        </tbody>
    </table>
    <br>
    <br>
    <p align="center"><strong>-Silahkan Melakukan Pembayaran di Kasir-</strong></p>
    @endforeach
</body>
</html>