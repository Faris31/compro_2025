<?php
$query = mysqli_query($koneksi, "SELECT * FROM sliders ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
    <h1>Data Sliders</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Sliders</h5>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-slider" class="btn btn-primary">
                            Tambah Sliders
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $key => $row) : ?>
                                <tr>
                                    <td class="align-content-center text-center"><?= $key += 1 ?></td>
                                    <td class="text-center align-content-center"><img src="uploads/<?= $row['images'] ?>" alt="" width="100"></td>
                                    <td class="align-content-center text-center"><?= $row['title'] ?></td>
                                    <td class="align-content-center" style="width: 1100px; text-align: justify;"><?= $row['description'] ?></td>
                                    <td class="align-content-center text-center">
                                        <a href="?page=tambah-slider&edit=<?= $row['id'] ?>" class="btn btn-sm mb-1 btn-success">
                                            Edit
                                        </a>
                                        <a
                                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" ;
                                            href="?page=tambah-slider&delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>