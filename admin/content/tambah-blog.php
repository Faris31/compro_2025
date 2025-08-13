<?php
$id = isset($_GET['id']) ? $_GET['edit'] : '';

//perintah edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = mysqli_query($koneksi, "SELECT * FROM blog WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($query);

    $title = "Edit Blog Kami";
} else {
    $title = "Tambah Blog Kami";
}

// perintah delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryGambar = mysqli_query($koneksi, "SELECT id, images FROM blogs WHERE id='$id'");
    $rowGambar = mysqli_fetch_assoc($queryGambar);
    $image_name = $rowGambar['images'];
    unlink("blog/" . $image_name);

    $delete = mysqli_query($koneksi, "DELETE FROM blogs WHERE id = '$id'");
    // print_r($image_name);
    // die;

    if ($delete) {
        header("location:?page=blog&hapus=berhasil");
    }
}

// perintah simpan
if (isset($_POST['simpan'])) {
    $id_kategori = $_POST['id_kategori'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $penulis = $SESSION['NAME'];
    $tags = $_POST['tags'];
    $is_active = $_POST['is_active'];

    //perintah untuk mengambil gambar
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $type = mime_content_type($tmp_name);


        $ext_allowed = ['image/png', 'image/png', 'image/jpeg'];
        if (in_array($type, $ext_allowed)) {
            $path = "blog/";
            if (!is_dir($path)) mkdir($path);

            $image_nama = time() . "-" . basename($image);
            $target_file = $path . $image_nama;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // jika gambarnya ada, maka gambar sebelumnya akan di ganti ke gambar yang baru
                if (!empty($row['image'])) {
                    unlink($path . $row['image']);
                }
            }
        } else {
            echo "Ekstensi file tidak ditemukan!";
            die;
        }
    }

    // perintah update
    if ($id) {
        // ini query update
        $update = mysqli_query($koneksi, "UPDATE blogs SET
        
        id_kategori = '$id_kategori', 
        title = '$title', 
        content = '$content', 
        penulis = '$penulis', 
        tags = '$tags', 
        is_active = '$is_active', 
        images = '$image_nama' WHERE id = '$id' ");

        if ($update) {
            header("location:?page=blog&ubah=berhasil");
        }
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO blogs (id_kategori, title, content, penulis, images, is_active, tags) VALUES('$title','$id_kategori','$image_nama','$is_active','$tags','$penulis',)");
        if ($insert) {
            header("location:?page=blog&tambah=berhasil");
        }
    }
}

$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories ORDER BY id ='$id'");
$rowsCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

// penulis di ambil dari 
?>

<div class="pagetitle">
    <h1><?= $title ?></h1>
</div><!-- End Page Title -->

<section class="section">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $title ?></h5>
                        <div class="mb-3">
                            <label for="" class="form-label">Gambar</label>
                            <input type="file" name="image" class="form-control" required value=" <?= ($id) ? $rowEdit['images'] : ''; ?>">
                            <small>)* image must be landscape or 1920 x 1080</small> <br>
                            <img class="mt-2 rounded-2" src="blog/<?= (isset($rowEdit['images'])) ? $rowEdit['images'] : '' ?>" alt="" width="20%">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select name="id_kategori" id="" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($rowsCategories as $key => $val) : ?>
                                    <option value="<?= $key['id'] ?>"><?= $val['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Content</label>
                            <input type="text" name="content" id="summernote" class="form-control" placeholder="Masukan content" required value="<?= ($id) ? $rowEdit['content'] : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukan title" required value="<?= ($id) ? $rowEdit['title'] : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" placeholder="Masukan penulis" required value="<?= ($id) ? $rowEdit['penulis'] : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tag</label>
                            <input type="text" name="tags" class="form-control" placeholder="Masukan tags" required value="<?= ($id) ? $rowEdit['tags'] : ''; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $title ?></h5>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class=" mb-3">
                                <label for="">Status</label>
                                <select name="is_active" id="" class="form-control">
                                    <!-- <option value="">Silahkan Dipilih</option> -->
                                    <option value="0" <?= ($id) ? $rowEdit['is_active'] == 0 ? 'selected' : '' : '' ?>>Draft</option>
                                    <option value="1" <?= ($id) ? $rowEdit['is_active'] == 1 ? 'selected' : '' : '' ?>>Publish</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                <a href="?page=blog" class="text-muted ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>