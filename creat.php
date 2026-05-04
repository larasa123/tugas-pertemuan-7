<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $kode = $_POST['kode_anggota'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = $_POST['pekerjaan'];
    $tanggal_daftar = date('Y-m-d');
    $status = "Aktif";

    // VALIDASI simple
    if (!$kode || !$nama || !$email || !$telepon) {
        $errors[] = "Field wajib belum lengkap";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid";
    }

    if (!preg_match('/^08[0-9]{8,12}$/', $telepon)) {
        $errors[] = "Nomor telepon harus 08xxxxxxxx";
    }

    // umur minimal 10 tahun
    $umur = date_diff(date_create($tanggal_lahir), date_create('today'))->y;
    if ($umur < 10) {
        $errors[] = "Umur minimal 10 tahun";
    }

    if (count($errors) == 0) {
        $stmt = $conn->prepare("INSERT INTO anggota 
        (kode_anggota,nama,email,telepon,alamat,tanggal_lahir,jenis_kelamin,pekerjaan,tanggal_daftar,status)
        VALUES (?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssssssssss",
            $kode,$nama,$email,$telepon,$alamat,
            $tanggal_lahir,$jenis_kelamin,$pekerjaan,
            $tanggal_daftar,$status
        );

        $stmt->execute();

        header("Location: index.php?success=Data berhasil ditambahkan");
        exit();
    }
}
?>

<div class="container mt-4">
<div class="card shadow">
<div class="card-header bg-primary text-white">
<h4>Tambah Anggota</h4>
</div>

<div class="card-body">

<?php if($errors): ?>
<div class="alert alert-danger">
<?php foreach($errors as $e) echo "<div>$e</div>"; ?>
</div>
<?php endif; ?>

<form method="POST">

<div class="row">
<div class="col-md-6">
<label>Kode</label>
<input type="text" name="kode_anggota" class="form-control">
</div>

<div class="col-md-6">
<label>Nama</label>
<input type="text" name="nama" class="form-control">
</div>
</div>

<div class="row mt-2">
<div class="col-md-6">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="col-md-6">
<label>Telepon</label>
<input type="text" name="telepon" class="form-control">
</div>
</div>

<div class="mt-2">
<label>Alamat</label>
<textarea name="alamat" class="form-control"></textarea>
</div>

<div class="row mt-2">
<div class="col-md-6">
<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" class="form-control">
</div>

<div class="col-md-6">
<label>Jenis Kelamin</label>
<select name="jenis_kelamin" class="form-control">
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
</div>
</div>

<div class="mt-2">
<label>Pekerjaan</label>
<input type="text" name="pekerjaan" class="form-control">
</div>

<br>
<button class="btn btn-success">Simpan</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>
</div>

<?php require_once '../../includes/footer.php'; ?>