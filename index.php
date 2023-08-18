<?php

//	Instruksi Kerja Nomor 1.
//	Variabel $kendaraan berisi data jenis kendaraan yang dipesan dalam bentuk array satu dimensi.
//  ....
$kendaraan = array("Sedan", "Minivan", "Minibus", "Sepeda Motor", "Pickup");;



//	Instruksi Kerja Nomor 2.
//	Mengurutkan array $kendaraan secara Ascending.
//  ....

sort($kendaraan);
//	Instruksi Kerja Nomor 6.
//	Baris Komentar: ......
require $_SERVER['DOCUMENT_ROOT'] . '/sertif-jwd/perhitungan/hitungSewa.php';
require $_SERVER['DOCUMENT_ROOT'] . '/sertif-jwd/perhitungan/kelolaData.php';


?>

<!DOCTYPE html>
<html>

<head>
	<title>Pemesanan Taxi Online</title>
	<!-- Instruksi Kerja Nomor 4. -->
	<!-- Menghubungkan dengan library/berkas CSS. -->
	<link rel="stylesheet" href="library/css/bootstrap.css">

</head>

<body>
	<div class="container border">
		<!-- Menampilkan judul halaman -->
		<h3>Pemesanan Taxi Online</h3>

		<!-- Instruksi Kerja Nomor 5. -->
		<!-- Menampilkan logo Taxi Online -->
		<img src="image/logo.jpg" alt="">


		<!-- Form untuk memasukkan data pemesanan. -->
		<form action="index.php" method="post" id="formPemesanan">
			<div class="row">
				<!-- Masukan data nama pelanggan. Tipe data text. -->
				<div class="col-lg-2"><label for="nama">Nama Pelanggan:</label></div>
				<div class="col-lg-2"><input type="text" id="nama" name="nama"></div>
			</div>
			<div class="row">
				<!-- Masukan data nomor HP pelanggan. Tipe data number. -->
				<div class="col-lg-2"><label for="nomor">Nomor HP:</label></div>
				<div class="col-lg-2"><input type="number" id="noHP" name="noHP" maxlength="16"></div>
			</div>
			<div class="row">
				<!-- Masukan pilihan jenis kendaraan. -->
				<div class="col-lg-2"><label for="tipe">Jenis Kendaraan:</label></div>
				<div class="col-lg-2">
					<select id="kendaraan" name="kendaraan">
						<option value="">- Jenis kendaraan -</option>
						<?php
						//	Instruksi Kerja Nomor 3.
						//	Menampilkan dropdown pilihan jenis kendaraan berdasarkan data pada array $kendaraan menggunakan perulangan.
						for ($i = 0; $i < 5; $i++) {

						?>
							<option value="<?= $kendaraan[$i] ?>">- <?= $kendaraan[$i] ?> -</option>

						<?php
						}
						?>
					</select>
				</div>
			</div>

			<div class="row">
				<!-- Masukan data Jarak Tempuh. Tipe data number. -->
				<div class="col-lg-2"><label for="nomor">Jarak:</label></div>
				<div class="col-lg-2"><input type="number" id="jarak" name="jarak" maxlength="4"></div>
			</div>
			<div class="row">
				<!-- Tombol Submit -->
				<div class="col-lg-2"><button class="btn btn-primary" type="submit" form="formPemesanan" value="Pesan" name="Pesan">Pesan</button></div>
				<div class="col-lg-2"></div>
			</div>
		</form>
	</div>
	<?php

	if (isset($_POST['Pesan'])) {

		//	Variabel $dataPesanan berisi data-data pemesanan dari form dalam bentuk array.

		$dataPesanan = array(
			'nama' => $_POST['nama'],
			'noHP' => $_POST['noHP'],
			'kendaraan' => $_POST['kendaraan'],
			'jarak' => $_POST['jarak'],
		);

		// Instruksi Kerja Nomor 7
		// Simpan jarak yang telah dimasukkan oleh pengguna dalam variabel \\
		$jarak_tempuh = $_POST['jarak'];


		// Instruksi Kerja Nomor 8 (Percabangan)
		// Gunakan pencabangan untuk menentukan biaya platform dan biaya sewa per kilometer
		// Simpan biaya platform dan biaya sewa per kilometer dalam variabel $biaya_platform dan $sewa_per_km
		// ...

		if ($_POST['kendaraan'] == "Sedan") {
			$biaya_platform = 10000; // Biaya platform untuk Sedan
			$sewa_per_km = 5000;    // Biaya sewa per kilometer untuk Sedan
		} elseif ($_POST['kendaraan'] == "Minivan") {
			$biaya_platform = 12000; // Biaya platform untuk Minivan
			$sewa_per_km = 6000;    // Biaya sewa per kilometer untuk Minivan
		} elseif ($_POST['kendaraan'] == "Minibus") {
			$biaya_platform = 15000; // Biaya platform untuk Minibus
			$sewa_per_km = 4500;    // Biaya sewa per kilometer untuk Minibus
		} elseif ($_POST['kendaraan'] == "Sepeda Motor") {
			$biaya_platform = 5000; // Biaya platform untuk Sepeda Motor
			$sewa_per_km = 3000;    // Biaya sewa per kilometer untuk Sepeda Motor
		} elseif ($_POST['kendaraan'] == "Pickup") {
			$biaya_platform = 15000; // Biaya platform untuk PickUp
			$sewa_per_km = 8000;    // Biaya sewa per kilometer untuk PickUp
		} else {
			// Jenis kendaraan tidak dikenali, berikan nilai default
			$biaya_platform = 0;
			$sewa_per_km = 0;
		}


		// Instruksi kerja Nomor 9
		// Gunakan fungsi hitung_sewa untuk menghitung biaya sewa
		// Simpan hasil perhitungan fungsi dalam variabel 
		$biaya_sewa = hitung_sewa($biaya_platform, $jarak_tempuh, $sewa_per_km);
		// ...


		// Instruksi Kerja Nomor 10.
		// Simpan data pemesanan yang ke dalam file JSON
		// ...
		$dataPesanan['Biaya Pesanan'] =  $biaya_sewa;
		$inputJson = addData($dataPesanan);


		// Menampilkan data pemesanan dan total biaya sewa.
		// KODE DI BAWAH INI TIDAK PERLU DIMODIFIKASI!!!
		echo "
				<br/>
				<div class='container'>
					
					<div class='row'>
						<!-- Menampilkan nama pelanggan. -->
						<div class='col-lg-2'>Nama Pelanggan:</div>
						<div class='col-lg-2'>" . $dataPesanan['nama'] . "</div>
					</div>
					<div class='row'>
						<!-- Menampilkan nomor HP pelanggan. -->
						<div class='col-lg-2'>Nomor HP:</div>
						<div class='col-lg-2'>" . $dataPesanan['noHP'] . "</div>
					</div>
					<div class='row'>
						<!-- Menampilkan Jenis Kendaraan Taxi Online. -->
						<div class='col-lg-2'>Jenis Kendaraan:</div>
						<div class='col-lg-2'>" . $dataPesanan['kendaraan'] . "</div>
					</div>
					<div class='row'>
						<!-- Menampilkan jumlah Jarak Tempuh. -->
						<div class='col-lg-2'>Jarak(km):</div>
						<div class='col-lg-2'>" . $dataPesanan['jarak'] . " km</div>
					</div>
					<div class='row'>
						<!-- Menampilkan Total Tagihan. -->
						<div class='col-lg-2'>Total:</div>
						<div class='col-lg-2'>Rp" . number_format($biaya_sewa, 0, ".", ".") . ",-</div>
					</div>
					
			</div>
			";
	}
	?>
</body>

</html>