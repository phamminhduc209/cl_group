<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101923">
    <title>CL Group — Kết nối hành trình - Tối ưu chuỗi cung ứng</title>
    <?php include('../../inc/head.php'); ?>
    <link rel="stylesheet" href="<?= asset(url_path.'assets/css/trade.css') ?>">
</head>

<body>
    <?php include('../../inc/header.php'); ?>

    <main>
        <div class="c-mv">
            <figure><img src="<?= url_path ?>assets/images/mv_img.jpg" class="object-cover" alt=""></figure>
            <div class="c-mv__content">
                <h1 class="c-mv__ttl">Việt Nam - các nước ASEAN.</h1>
                <nav class="c-breadcrumb">
                    <ul class="c-breadcrumb__list">
                        <li class="c-breadcrumb__item"><a href="<?= url_home ?>" class="c-breadcrumb__link">Trang Chủ</a></li>
                        <li class="c-breadcrumb__item"><span class="c-breadcrumb__txt">Việt Nam - các nước ASEAN.</span></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="c-content">
            <div class="container">
                <div class="ttime-content">
                    <h2 class="c-content__ttl">Việt Nam - các nước ASEAN.</h2>
                    <div class="cstep">
                        <div class="cstep-odt-steps">
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon">
                                        <img width="24" height="24" src="<?= url_path ?>assets/images/step1.svg" class="attachment-full size-full" alt="" decoding="async"> </span>
                                    <span class="text">
                                        Chờ xác nhận </span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon">
                                        <img width="25" height="24" src="<?= url_path ?>assets/images/step2.svg" class="attachment-full size-full" alt="" decoding="async"> </span>
                                    <span class="text">
                                        Chờ lấy hàng </span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon">
                                        <img width="27" height="24" src="<?= url_path ?>assets/images/step3.svg" class="attachment-full size-full" alt="" decoding="async" loading="lazy"> </span>
                                    <span class="text">
                                        Đến lấy hàng </span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon">
                                        <img width="26" height="24" src="<?= url_path ?>assets/images/step4.svg" class="attachment-full size-full" alt="" decoding="async" loading="lazy"> </span>
                                    <span class="text">
                                        Đang vận chuyển </span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon">
                                        <img width="27" height="25" src="<?= url_path ?>assets/images/step5.svg" class="attachment-full size-full" alt="" decoding="async" loading="lazy"> </span>
                                    <span class="text">
                                        Chờ lấy hàng </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="margin-bottom: 20px;">Vui lòng liên hệ với bộ phận Chăm sóc khách hàng để được cung cấp thông tin</p>
                    <ul>
                        <li><p>Điện thoại: <a href="tel:0923989239">0923 989 239</a></p></li>
                        <li><p>Email: <a href="mailto:info@cl-group.com.vn">info@cl-group.com.vn</a></p></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php include('../../inc/footer.php'); ?>
</body>

</html>