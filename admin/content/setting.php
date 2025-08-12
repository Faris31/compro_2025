<?php

//jika data setting sudah adam maka update tersebut
// selain itu kalo blm ada insert data

$querySetting = mysqli_query($koneksi, "SELECT * FROM settings LIMIT 1");
$row = mysqli_fetch_assoc($querySetting);

if (isset($_POST['simpan'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $instagram = $_POST['instagram'];
    $logo_nama = $row['logo'];

    if (!empty($_FILES['logo']['name'])) { // jika folder tidak kosong
        $logo = $_FILES['logo']['name'];
        $path = "uploads/";
        if (!is_dir($path)) mkdir($path);

        $logo_nama = time() . "-" . basename($logo);
        $target_file = $path . $logo_nama;
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
            // jika gambarnya ada, maka gambar sebelumnya akan di ganti ke gambar yang baru
            if (!empty($row['logo'])) {
                unlink($path . $row['logo']);
            }
        }
    }

    if ($row) {
        // update
        $id_settings = $row['id'];
        $update = mysqli_query($koneksi, "UPDATE settings SET email = '$email', phone = '$phone', address = '$address', facebook = '$facebook', 
        twitter = '$twitter', linkedin = '$linkedin', instagram = '$instagram', logo = '$logo_nama'  WHERE id='$id_settings'");
        if ($update) {
            header("location:?page=setting&ubah=berhasil");
        }
    } else {
        // insert
        $insert = mysqli_query($koneksi, "INSERT INTO settings (email, phone, address, facebook, twitter, linkedin, instagram, logo)
        VALUES ('$email', '$phone', '$address', '$facebook', '$twitter', '$linkedin', '$instagram', '$logo_nama') ");
        if ($insert) {
            header("location:?page=setting&tambah=berhasil");
        }
    }
}

// diluar if karena buat nampilin data yang sudah di input dan diupdate

?>

<div class="pagetitle">
    <h1>Pengaturan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Blank</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengaturan</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="email" class="form-label fw-bold">Email</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" value="<?= isset($row['email']) ? $row['email'] : '' ?>">
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="phone" class="form-label fw-bold">No. Telp</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="phone" class="form-control" value="<?= isset($row['phone']) ? $row['phone'] : '' ?>">
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="address" class="form-label fw-bold">Alamat</label>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="address" id="" class="form-control"><?= isset($row['address']) ? $row['address'] : '' ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="facebook" class="form-label fw-bold">Facebook</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="facebook" class="form-control" value="<?= isset($row['facebook']) ? $row['facebook'] : '' ?>">
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="twitter" class="form-label fw-bold">Twitter</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="twitter" class="form-control" value="<?= isset($row['twitter']) ? $row['twitter'] : '' ?>">
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="linkedin" class="form-label fw-bold">Linkedin</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="linkedin" class="form-control" value="<?= isset($row['linkedin']) ? $row['linkedin'] : '' ?>">
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-2">
                                <label for="instagram" class="form-label fw-bold">Instagram</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="instagram" class="form-control" value="<?= isset($row['instagram']) ? $row['instagram'] : '' ?>">
                            </div>
                            <div class="mt-2 mb-3 row">
                                <div class="col-sm-2">
                                    <label for="logo" class="form-label fw-bold">Logo</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" name="logo" class="form-control">
                                    <img class="mt-2" src="uploads/<?= isset($row['logo']) ? $row['logo'] : ''; ?>" alt="" width="100">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-3 row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>