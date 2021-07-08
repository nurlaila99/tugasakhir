<!DOCTYPE html> 
<html> 
<head> 
    <title>Laporan Pengeluaran Operasional</title> 
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
        <center><h4>LAPORAN PENGELUARAN OPERASIONAL<br>
        Periode Tanggal : {{\Carbon\Carbon::parse($start)->translatedFormat('d F Y ')}} - {{\Carbon\Carbon::parse($end)->translatedFormat('d F Y')}}</h4></center>
    </div>
    <table id="total" width="100%" style="margin-top: 15px;">
        <thead>
            <tr style="font-size: 14px !important;">
                <th>ID</th>
                <th>Tanggal</th> 
                <th>Jenis Pengeluaran</th>
                <th>Subtotal</th>
            </tr>      
        </thead>
        <tbody style="text-align: center; ">
            @foreach($pengeluaran_bulanan as $p)
                <tr>
                    <td>{{ $p->ID_PENGELUARAN }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->TGL_PENGELUARAN)->translatedFormat('d-m-Y H:i') }}</td>
                    @foreach($jenis_pengeluaran as $j)
                        @if($j->ID_JENIS_PENGELUARAN == $p->ID_JENIS_PENGELUARAN)
                            <td>{{ $j->NAMA_JENIS_PENGELUARAN }}</td>
                        @endif
                    @endforeach
                    <td>{{ number_format($p->TOTAL_PENGELUARAN) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="3" style="text-align: center"><strong>TOTAL</strong></th>
                <td style="text-align: left;">
                    <strong>{{ number_format($total_pengeluaran) }}</strong>
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