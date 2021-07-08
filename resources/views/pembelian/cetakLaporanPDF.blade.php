<!DOCTYPE html> 
<html> 
<head> 
    <title>Laporan Pembelian Bahan Baku</title> 
    <style>
        @page { margin-top:14.338582677px; margin-left:12.4488188976px; margin-bottom:14.338582677px;}
        .container{
            margin:0 auto;
            padding:0px;
            height:auto;
            background-color:#fff;
        }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          padding-left: 5%;
        }
        
        td, th {
          border: 1px solid #black;
          text-align: left;
          padding: 8px;
          font-size: 12px !important;
        }
        
        th {
            text-align: center !important;
          background-color: #dddddd;
        }
        
        .center{
            text-align: center;
        }
    </style>
</head> 
<body>
    <div class="row">
        <center><h1><u>CThaiTea</u></h1></center>
    </div>
    <div class="row">
        <center><h4>LAPORAN PEMBELIAN BAHAN BAKU<br>
        Periode Tanggal : {{\Carbon\Carbon::parse($start)->translatedFormat('d F Y ')}} - {{\Carbon\Carbon::parse($end)->translatedFormat('d F Y')}}</h4></center>
    </div>
    <table id="total" width="100%" style="margin-top: 15px;">
        <thead>
            <tr style="font-size: 14px !important;">
                <th>ID</th>
                <th>Tanggal</th> 
                <th>Bahan Baku</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>      
        </thead>
        <tbody style="text-align: center; ">
            @foreach($pembelian as $p)
                    @foreach($detail_pembelian as $dp)
                        @if($p->ID_PEMBELIAN == $dp->ID_PEMBELIAN)
                        <tr>
                            <td>{{ $dp->ID_PEMBELIAN }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->TGL_PEMBELIAN)->translatedFormat('d-m-Y H:i') }}</td>
                            @foreach($bahan_baku as $bb)
                                @if($bb->ID_BAHAN_BAKU == $dp->ID_BAHAN_BAKU)
                                    <td>{{ $bb->NAMA_BAHAN_BAKU }}</td>
                                @endif
                            @endforeach
                            <td>{{ number_format($dp->HARGA_BELI) }}</td>
                            <td style="text-align: center;">{{ $dp->JUMLAH }}</td>
                            <td>{{ number_format($dp->SUBTOTAL) }}</td>
                        </tr>
                        @endif
                    @endforeach
            @endforeach
            <tr>
                <th colspan="4" style="text-align: center"><strong>TOTAL</strong></th>
                <td style="text-align: center;">
                    <strong>{{ $jumlah }}</strong>
                </td>
                <td style="text-align: left;">
                    <strong>{{ number_format($total_pembelian) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <div class="row">
        <p align="right">
            {{\Carbon\Carbon::now()->translatedFormat('l, d F Y ')}}<br>
            Owner,<br><br><br><br>
            Theo Irvan      
        <p>
    </div>
  </body>
</html>