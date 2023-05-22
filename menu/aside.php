<div class="sidebar-brand">
	<a href="beranda">Sunday Festival</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
	<a href="beranda">II</a>
</div>
<ul class="sidebar-menu">
	<!-- <li class="menu-header">Menu Pertama</li> -->
	<li><a class="nav-link" href="beranda"><i class="fas fa-fire"></i> <span>Beranda</span></a></li>
	<?php if($_SESSION['level'] == "Admin") { ?>
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Master</span></a>
			<ul class="dropdown-menu">
				<!-- <li><a class="nav-link" href="modal">Modal</a></li> -->
				<li><a class="nav-link" href="produk">Produk</a></li>
				<li><a class="nav-link" href="toko">Toko</a></li>
				<li><a class="nav-link" href="pemasok">Pemasok</a></li>
				<li><a class="nav-link" href="pegawai">Pegawai</a></li>
			</ul>
		</li>
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fab fa-product-hunt"></i> <span>Transaksi</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="pembelian">Pembelian</a></li>
				<li><a class="nav-link" href="permintaan">Permintaan Stok</a></li>
				<li><a class="nav-link" href="penjualan">Penjualan</a></li>
				<!-- <li><a class="nav-link" href="obrolan">Chat</a></li> -->
			</ul>
		</li>
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fas fa-print"></i> <span>Laporan</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="laporan-produk">Produk Terlaris</a></li>
				<li><a class="nav-link" href="laporan-pembelian">Pembelian</a></li>
				<li><a class="nav-link" href="laporan-permintaan">Permintaan Stok</a></li>
				<li><a class="nav-link" href="laporan-penjualan">Penjualan</a></li>
				<li><a class="nav-link" href="laporan-pendapatan">Pendapatan Toko</a></li>
				<li><a class="nav-link" href="grafik-pembelian">Grafik Pembelian</a></li>
				<li><a class="nav-link" href="grafik-penjualan">Grafik Penjualan</a></li>
				<!-- <li><a class="nav-link" href="laporan-keuangan">Keuangan</a></li> -->
			</ul>
		</li>
	<li class="nav-item dropdown">
		<a href="#" class="nav-link has-dropdown"><i class="fas fa-certificate"></i> <span>Pengaturan</span></a>
		<ul class="dropdown-menu">
			<!-- <li><a class="nav-link" href="pajak">Pajak</a></li> -->
			<li><a class="nav-link" href="pemilik">Pemilik</a></li>
		</ul>
	</li>
	<?php }elseif($_SESSION['level'] == "Pemilik") { ?>
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fas fa-print"></i> <span>Laporan</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="laporan-produk">Produk Terlaris</a></li>
				<li><a class="nav-link" href="laporan-pembelian">Pembelian</a></li>
				<li><a class="nav-link" href="laporan-permintaan">Permintaan Stok</a></li>
				<li><a class="nav-link" href="laporan-penjualan">Penjualan</a></li>
				<!-- <li><a class="nav-link" href="laporan-pendapatan">Pendapatan Toko</a></li>
				<li><a class="nav-link" href="laporan-keuangan">Keuangan</a></li> -->
			</ul>
		</li>
	<?php }elseif($_SESSION['level'] == "Toko") { ?>
		<!-- <li><a class="nav-link" href="produk"><i class="fas fa-fish"></i> <span>Produk</span></a></li>
		<li><a class="nav-link" href="pegawai"><i class="fas fa-users"></i> <span>Pegawai</span></a></li>
		<li><a class="nav-link" href="pelanggan"><i class="fas fa-child"></i> <span>Pelanggan</span></a></li>
		<li><a class="nav-link" href="permintaan"><i class="fas fa-arrow-left"></i> <span>Permintaan Stok</span></a></li>
		<li><a class="nav-link" href="penjualan"><i class="fas fa-shopping-cart"></i> <span>Penjualan</span></a></li>
		<li><a class="nav-link" href="pengantaran"><i class="fas fa-solid fa-motorcycle"></i> <span>Pengantaran</span></a></li>
		<li><a class="nav-link" href="obrolan"><i class="fas fa-comment"></i> <span>Chat</span></a></li> -->
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Master</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="produk">Produk</a></li>
			</ul>
		</li>
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fab fa-product-hunt"></i> <span>Transaksi</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="permintaan">Permintaan Stok</a></li>
				<li><a class="nav-link" href="penjualan">Penjualan</a></li>
				<!-- <li><a class="nav-link" href="tambah-obrolan">Chat</a></li> -->
			</ul>
		</li>
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fas fa-print"></i> <span>Laporan</span></a>
			<ul class="dropdown-menu">
				<li><a class="nav-link" href="laporan-permintaan">Permintaan Stok</a></li>
				<li><a class="nav-link" href="laporan-penjualan">Penjualan</a></li>
				<!-- <li><a class="nav-link" href="laporan-pendapatan">Pendapatan Toko</a></li> -->
			</ul>
		</li>
	<?php } ?>
</ul>