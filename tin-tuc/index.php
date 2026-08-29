<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101923">
    <title>CL Group — Vận tải & Giao nhận toàn cầu</title>
    <?php include('../inc/head.php'); ?>
    <link rel="stylesheet" href="<?= asset(url_path.'assets/css/service.css') ?>">
</head>

<body>
    <?php include('../inc/header.php'); ?>

    <main>
        <div class="c-mv">
            <figure><img src="<?= url_path ?>assets/images/mv_img.jpg" class="object-cover" alt=""></figure>
            <div class="c-mv__content">
                <h1 class="c-mv__ttl">Tin Tức</h1>
                <nav class="c-breadcrumb">
                    <ul class="c-breadcrumb__list">
                        <li class="c-breadcrumb__item"><a href="<?= url_home ?>" class="c-breadcrumb__link">Trang Chủ</a></li>
                        <li class="c-breadcrumb__item"><span class="c-breadcrumb__txt">Tin Tức</span></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="c-content">
            <div class="container">
                <div class="c-content__head center wow fadeInUp">
                    <h2 class="c-content__ttl">Thị trường Logistics</h2>
                    
                </div>

                <div class="c-content__head center wow fadeInUp">
                    <h2 class="c-content__ttl">Kiến thức Logistics</h2>
                </div>
            </div>
        </div>
    </main>

    <?php include('../inc/footer.php'); ?>
</body>

</html>