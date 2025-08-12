<?php
$id = isset($_GET['id']) ? $_GET['edit'] : '';

//perintah edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = mysqli_query($koneksi, "SELECT * FROM sliders WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($query);

    $title = "Edit Sliders";
} else {
    $title = "Tambah Sliders";
}

// perintah delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryGambar = mysqli_query($koneksi, "SELECT id, images FROM sliders WHERE id='$id'");
    $rowGambar = mysqli_fetch_assoc($queryGambar);
    $image_name = $rowGambar['images'];
    unlink("uploads/" . $image_name);

    $delete = mysqli_query($koneksi, "DELETE FROM sliders WHERE id = '$id'");
    // print_r($image_name);
    // die;

    if ($delete) {
        header("location:?page=slider&hapus=berhasil");
    }
}

// perintah simpan
if (isset($_POST['simpan'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    //perintah untuk mengambil gambar
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $type = mime_content_type($tmp_name);


        $ext_allowed = ['image/png', 'image/png', 'image/jpeg'];
        if (in_array($type, $ext_allowed)) {
            $path = "uploads/";
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
        $update = mysqli_query($koneksi, "UPDATE sliders SET
        
        title = '$title', 
        description = '$description', 
        images = '$image_nama' WHERE id = '$id' ");

        if ($update) {
            header("location:?page=slider&ubah=berhasil");
        }
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO sliders (title, description, images) VALUES('$title','$description','$image_nama')");
        if ($insert) {
            header("location:?page=slider&tambah=berhasil");
        }
    }
}
?>

<div class="pagetitle">
    <h1><?= $title ?></h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $title ?></h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="">Gambar</label>
                            <input type="file" name="image" class="form-control" required value="<?= ($id) ? $rowEdit['images'] : ''; ?>">
                            <small>)* image must be landscape or 1920 x 1080</small>
                            <!-- <img class="mt-2" src="uploads/" alt="" width="100"> -->
                        </div>
                        <div class="mb-3">
                            <label for="">Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukan judul anda" required value="<?= ($id) ? $rowEdit['title'] : ''; ?>">
                        </div>
                        <div class=" mb-3">
                            <label for="">Isi</label>
                            <textarea name="description" id="" class="form-control"><?= ($id) ? $rowEdit['description'] : '';  ?></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            <a href="?page=slider" class="text-muted ms-2">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>