       <?php
        $queryCategory = mysqli_query($koneksi, "SELECT * FROM categories WHERE type='portofolio' ORDER BY id DESC");
        $rowCategory = mysqli_fetch_all($queryCategory, MYSQLI_ASSOC);

        $queryPortofolios = mysqli_query($koneksi, "SELECT DISTINCT categories.name, categories.id as id_kategori, portofolios.* FROM portofolios LEFT JOIN categories ON categories.id = portofolios.id_kategori WHERE is_active=1
        ORDER BY portofolios.id DESC");
        $rowPortofolios = mysqli_fetch_all($queryPortofolios, MYSQLI_ASSOC);


        ?>

       <!-- Page Header Start -->
       <div class="container-fluid page-header py-5">
           <div class="container text-center py-5">
               <h1 class="display-2 text-white mb-4 animated slideInDown">Portofolio</h1>
               <nav aria-label="breadcrumb animated slideInDown">
                   <ol class="breadcrumb justify-content-center mb-0">
                       <li class="breadcrumb-item"><a href="#">Home</a></li>
                       <li class="breadcrumb-item"><a href="#">Pages</a></li>
                       <li class="breadcrumb-item" aria-current="page">Portofolio</li>
                   </ol>
               </nav>
           </div>
       </div>
       <!-- Page Header End -->



       <!-- Portfolio Section -->

       <!-- Section Title -->
       <div class="container section-title" data-aos="fade-up">
           <h2>Portfolio</h2>
           <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
       </div>
       <!-- End Section Title -->

       <div class="container">

           <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

               <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                   <li data-filter="*" class="filter-active">All</li>
                   <?php foreach ($rowPortofolios as $key => $rowPortofolio): ?>
                       <li data-filter=".filter-<?= $rowPortofolio['id_kategori'] ?>"><?= $rowPortofolio['name'] ?></li>
                   <?php endforeach; ?>
               </ul>
               <!-- End Portfolio Filters -->

               <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                   <?php foreach ($rowPortofolios as $key => $row): ?>
                       <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?= $row['id_kategori'] ?>"><?= $row['name'] ?>">
                           <img src="portofolio/<?= $row['images'] ?>" class="img-fluid" alt="">
                           <div class="portfolio-info">
                               <h4><?= $row['title'] ?></h4>
                               <p><?= $row['content'] ?></p>
                               <a href="portofolio/<?= $row['images'] ?>" title="<?= $row['title'] ?>" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                               <a href="?page=portofolio-detail" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                           </div>
                       </div><!-- End Portfolio Item -->
                   <?php endforeach; ?>
               </div><!-- End Portfolio Container -->

           </div>

       </div>