<?php
$query = mysqli_query($koneksi, "SELECT  categories.name as category_name, blogs. * FROM blogs 
JOIN categories ON categories.id = blogs.id_kategori
ORDER BY blogs.id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

function changeIsActive($isActive)
{
    switch ($isActive) {
        case '1':
            $title = "<span class='badge bg-primary'>Publish</span>";
            break;

        default:
            $title = "<span class='badge bg-warning'>Draft</span>";
            break;
    }

    return $title;
}
?>

<div class="pagetitle">
    <h1>Data Blog Kami</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Blog Kami</h5>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-blog" class="btn btn-primary">
                            Tambah Blog Kami
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Kategories</th>
                                <th>Judul</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Tags</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $key => $row) : ?>
                                <tr>
                                    <td class="text-center align-content-center"><?= $key += 1 ?></td>
                                    <td class="text-center"><img width="100" src="blog/<?= $row['images'] ?>" alt=""></td>
                                    <td class="text-center align-content-center"><?= $row['category_name'] ?></td>
                                    <td class="text-center align-content-center"><?= $row['title'] ?></td>
                                    <td class="text-center align-content-center"><?= $row['content'] ?></td>
                                    <td class="text-center align-content-center"><?= $row['is_active'] ? 'Publish' : 'Draft'; ?></td>
                                    <td class="text-center align-content-center"><?= $row['tags'] ?></td>
                                    <td class="align-content-center text-center">
                                        <a href="?page=tambah-blog&edit=<?= $row['id'] ?>" class="btn btn-sm btn-success">
                                            Edit
                                        </a>
                                        <a
                                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" ;
                                            href="?page=tambah-blog&delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">
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