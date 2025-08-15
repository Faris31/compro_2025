<?php

$queryBlogs = mysqli_query($koneksi, "SELECT * FROM blogs ORDER BY id DESC");
$rowsBlogs = mysqli_fetch_all($queryBlogs, MYSQLI_ASSOC);

?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Our Blog</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item" aria-current="page">Blog</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Blog Start -->
<div class="container-fluid blog py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Our Blog</h5>
            <h1>Latest Blog & News</h1>
        </div>
        <div class="row g-5 justify-content-center">
            <?php foreach ($rowsBlogs as $rowBlogs) : ?>
                <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="blog-item position-relative bg-light rounded text-center">
                        <img src="admin/blog/<?= $rowBlogs['images'] ?>" class="img-fluid rounded-top" alt="">
                        <span class="position-absolute px-4 py-3 bg-primary text-white rounded" style="top: -28px; right: 20px;"><?= $rowBlogs['title'] ?></span>
                        <div class="blog-btn d-flex justify-content-between position-relative px-3" style="margin-top: -75px;">
                            <div class="blog-icon btn btn-secondary px-3 rounded-pill my-auto">
                                <a href="?page=blog-detail&id=<?= $rowBlogs['id'] ?>" class="btn text-white">Read More</a>
                            </div>
                            <div class="blog-btn-icon btn btn-secondary px-4 py-3 rounded-pill ">
                                <div class="blog-icon-1">
                                    <p class="text-white px-2">Share<i class="fa fa-arrow-right ms-3"></i></p>
                                </div>
                                <div class="blog-icon-2">
                                    <a href="" class="btn me-1"><i class="fab fa-facebook-f text-white"></i></a>
                                    <a href="" class="btn me-1"><i class="fab fa-twitter text-white"></i></a>
                                    <a href="" class="btn me-1"><i class="fab fa-instagram text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-center position-relative px-3" style="margin-top: -25px;">
                            <img src="asset/img/admin.jpg" class="img-fluid rounded-circle border border-4 border-white mb-3" alt="">
                            <h5 class=""><?= $rowBlogs['penulis'] ?></h5>
                            <?php
                            $date_blog = $rowBlogs['created_at'];
                            $date_blog = date("M d Y", strtotime($date_blog));
                            ?>
                            <span class="text-secondary"><?= $date_blog ?></span>
                            <p class="py-2"><?= $rowBlogs['content'] ?></p>
                        </div>
                        <div class="blog-coment d-flex justify-content-between px-4 py-2 border bg-primary rounded-bottom">
                            <a href="" class="text-white"><small><i class="fas fa-share me-2 text-secondary"></i>5324 Share</small></a>
                            <a href="" class="text-white"><small><i class="fa fa-comments me-2 text-secondary"></i>5 Comments</small></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Blog End -->