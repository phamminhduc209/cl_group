<!DOCTYPE html>
<html lang="en">

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
                <h1 class="c-mv__ttl">Vietnam - China, Hong Kong and Taiwan.</h1>
                <nav class="c-breadcrumb">
                    <ul class="c-breadcrumb__list">
                        <li class="c-breadcrumb__item"><a href="<?= url_home ?>en/" class="c-breadcrumb__link">HOME</a></li>
                        <li class="c-breadcrumb__item"><a href="<?= url_home ?>en/trade-lane-cargo-type/" class="c-breadcrumb__link">TRADE LANES & CARGO TYPES</a></li>
                        <li class="c-breadcrumb__item"><span class="c-breadcrumb__txt">Vietnam - China, Hong Kong and Taiwan.</span></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="c-content">
            <div class="container">
                <div class="ttime-content">
                    <h2 class="c-content__ttl">Vietnam - China, Hong Kong and Taiwan.</h2>
                    <div class="cstep">
                        <div class="cstep-odt-steps">
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon"><img width="24" height="24" src="<?= url_path ?>assets/images/step1.svg" class="attachment-full size-full" alt="" decoding="async"> </span>
                                    <span class="text">Awaiting Confirmation</span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon"><img width="25" height="24" src="<?= url_path ?>assets/images/step2.svg" class="attachment-full size-full" alt="" decoding="async"> </span>
                                    <span class="text">Awaiting Pickup</span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon"><img width="27" height="24" src="<?= url_path ?>assets/images/step3.svg" class="attachment-full size-full" alt="" decoding="async" loading="lazy"> </span>
                                    <span class="text">Picked Up</span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon"><img width="26" height="24" src="<?= url_path ?>assets/images/step4.svg" class="attachment-full size-full" alt="" decoding="async" loading="lazy"> </span>
                                    <span class="text">In Transit</span>
                                </div>
                            </div>
                            <div class="cstep-odt-step step-pass">
                                <div class="cstep-odt-icon">
                                    <span class="icon"><img width="27" height="25" src="<?= url_path ?>assets/images/step5.svg" class="attachment-full size-full" alt="" decoding="async" loading="lazy"> </span>
                                    <span class="text">Ready for Pickup</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="margin-bottom: 20px;">Please contact our Customer Service team for further information.</p>
                    <ul>
                        <li><p>Phone: <a href="tel:0923989239">(+84)-923-989-239</a></p></li>
                        <li><p>Email: <a href="mailto:info@cl-group.com.vn">info@cl-group.com.vn</a></p></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php include('../../inc/footer.php'); ?>
</body>

</html>