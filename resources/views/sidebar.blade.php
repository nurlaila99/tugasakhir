<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../home"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    @if((\Session::has('admin')))
                    <li class="menu-title">Data</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Pengolahan Data</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <a href="/user"><i class="fa fa-users"></i>User</a>                     
                            </li>
                            <li>
                                <a href="/jabatan"><i class="fa fa-id-badge"></i>Jabatan</a>
                            </li>
                            <li>
                                <a href="/produk"><i class="fa fa-beer"></i>Produk</a>
                            </li>
                            <li>
                                <a href="/jenis_produk"><i class="fa ti-filter"></i>Jenis Produk</a>
                            </li>
                            <li>
                                <a href="/bahan_baku"><i class="fa ti-package"></i>Bahan Baku</a>
                            </li>
                            <li>
                                <a href="/jenis_pengeluaran"><i class="fa fa-bookmark"></i>Jenis Pengeluaran</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if((\Session::has('admin')) || (\Session::has('pegawai'))))
                    <li class="menu-title">Transaksi</li><!-- /.menu-title -->
                    <li>
                        <a href="/penjualan"><i class="menu-icon fa fa-shopping-cart"></i>Penjualan</a>                     
                    </li>
                    <li>
                        <a href="/pembayaran"><i class="menu-icon fa fa-money"></i>Pembayaran</a>                     
                    </li>
                    <li>
                        <a href="/pembelian/tabel"><i class="menu-icon fa ti-receipt"></i>Pembelian Bahan Baku</a>                     
                    </li>
                    <li>
                        <a href="/pengeluaran"><i class="menu-icon fa ti-wallet"></i>Pengeluaran</a>                     
                    </li>
                    <li>
                        <a href="/update_stok"><i class="menu-icon fa fa-minus-square"></i>Update Stok</a>                     
                    </li>
                    @endif
                    @if((\Session::has('admin')) || (\Session::has('owner'))))
                    <li class="menu-title">Laporan</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Laporan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <a href="/penjualan/report"><i class="menu-icon fa fa-shopping-cart"></i>Penjualan</a>                     
                            </li>
                            <li>
                                <a href="/pembelian/report"><i class="menu-icon fa ti-receipt"></i>Pembelian</a>                     
                            </li>
                            <li>
                                <a href="/pengeluaran/report"><i class="menu-icon fa ti-wallet"></i>Pengeluaran</a>                     
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>