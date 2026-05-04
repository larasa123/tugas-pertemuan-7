<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM anggota WHERE id_anggota=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $conn->query("UPDATE anggota SET 
        nama='$nama',
        email='$email',
        telepon='$telepon',
        alamat='$alamat',
        status='$status'
        WHERE id_anggota=$id
    ");

    header("Location: index.php?success=Data berhasil diupdate");
}
?>

<div class="container mt-4">
<div class="card shadow">
<div class="card-header bg-warning">
<h4>Edit Anggota</h4>
</div>

<div class="card-body">

<form method="POST">

<label>Nama</label>
<input class="form-control" name="nama" value="<?= $data['nama'] ?>">

<label>Email</label>
<input class="form-control mt-2" name="email" value="<?= $data['email'] ?>">

<label>Telepon</label>
<input class="form-control mt-2" name="telepon" value="<?= $data['telepon'] ?>">

<label>Alamat</label>
<textarea class="form-control mt-2" name="alamat"><?= $data['alamat'] ?></textarea>

<label>Status</label>
<select class="form-control mt-2" name="status">
<option <?= $data['status']=='Aktif'?'selected':'' ?>>Aktif</option>
<option <?= $data['status']=='Nonaktif'?'selected':'' ?>>Nonaktif</option>
</select>

<br>
<button class="btn btn-primary">Update</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>
</div>

<?php require_once '../../includes/footer.php'; ?>