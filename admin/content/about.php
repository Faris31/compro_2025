<?php
$queryAbout = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
$rowsAbout = mysqli_fetch_all($queryAbout, MYSQLI_ASSOC);
?>

<div class="pagetitle">
    <h1>Data Tentang Kami</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Tentang Kami</h5>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-about" class="btn btn-primary">
                            Tambah Tentang Kami
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Title</th>
                                <th>Konten</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowsAbout as $key => $row) : ?>
                                <tr>
                                    <td class="text-center align-content-center"><?= $key += 1 ?></td>
                                    <td class="text-center align-content-center"><?= $row['title'] ?></td>
                                    <td class="text-center align-content-center"><?= $row['content'] ?></td>
                                    <td class="text-center"><img width="100" src="about/<?= $row['images'] ?>" alt=""></td>
                                    <td class="text-center align-content-center"><?= $row['is_active'] ? 'Publish' : 'Draft'; ?></td>
                                    <td class="align-content-center text-center">
                                        <a href="?page=tambah-about&edit=<?= $row['id'] ?>" class="btn btn-sm btn-success">
                                            Edit
                                        </a>
                                        <a
                                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" ;
                                            href="?page=tambah-about&delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">
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