<?php
$page_title = "Data Anggota";
require_once '../../config/database.php';
require_once '../../includes/header.php';

$result = $conn->query("SELECT * FROM anggota ORDER BY id_anggota DESC");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Anggota</h5>
        <a href="create.php" class="btn btn-light btn-sm">+ Tambah</a>
    </div>

    <div class="card-body">

        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php $no=1; while($row=$result->fetch_assoc()): ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['telepon'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>

                    <td>
                        <?php if($row['status']=='Aktif'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="edit.php?id=<?= $row['id_anggota'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id_anggota'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus data?')">
                           Hapus
                        </a>
                    </td>
                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

        </div>

    </div>
</div>

</div>

<?php
closeConnection();
require_once '../../includes/footer.php';
?>