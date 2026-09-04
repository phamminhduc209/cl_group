<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101923">
    <title>CL Group — Connecting Journeys. Optimizing Supply Chains.</title>
    <?php include('../inc/head.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= asset(url_path.'assets/css/contact.css') ?>">
</head>

<body>
    <?php include('../inc/header.php'); ?>

    <main>
        <div class="c-mv">
            <figure><img src="<?= url_path ?>assets/images/mv_img.jpg" class="object-cover" alt=""></figure>
            <div class="c-mv__content">
                <h1 class="c-mv__ttl">REQUEST A QUOTE</h1>
                <nav class="c-breadcrumb">
                    <ul class="c-breadcrumb__list">
                        <li class="c-breadcrumb__item"><a href="<?= url_home ?>en/" class="c-breadcrumb__link">HOME</a></li>
                        <li class="c-breadcrumb__item"><span class="c-breadcrumb__txt">REQUEST A QUOTE</span></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="c-content">
            <div class="container">
                <p style="text-align: center; margin-bottom: 40px;">Planning an upcoming shipment?<br>Send the details to CL Group.<br>Our team will review the route, cargo type, expected schedule and delivery requirements to recommend a suitable solution.</p>

                <div class="contact-box">
                    <h2 class="contact-box__ttl">Shipping rate consultation</h2>
                    <div class="contact-form">
                        <form action="<?= url_path ?>contact.php" method="POST" class="frm">
                            <input type="hidden" name="form_submit" value="1">
                            <input type="hidden" name="form_nonce" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="return_url" value="<?= url_path ?>en/request-a-quote/">
                            <div class="frm-row">
                                <p class="frm-ttl">Name<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="frm-row">
                                <p class="frm-ttl">Company<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_company" class="form-control" placeholder="Company" required>
                                </div>
                            </div>
                            <div class="frm-row">
                                <p class="frm-ttl">Phone<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="tel" name="frm_phone" class="form-control" placeholder="Phone" required>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Email<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="email" name="frm_mail" class="form-control" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Shipping method<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <select name="frm_lvc" class="form-control" required>
                                        <option value="">Select shipping method</option>
                                        <option value="frm_duongbien">Ocean Freight</option>
                                        <option value="frm_hangkhong">Air Freight</option>
                                        <option value="frm_noidia">Inland Transportation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">POL<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_pol" class="form-control" placeholder="POL" required>
                                    <p class="frm-note">Port where cargo is loaded onto the ship</p>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">POD<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_pod" class="form-control" placeholder="POD" required>
                                    <p class="frm-note">Port where cargo is unloaded from the ship</p>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Commodity<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_lmh" class="form-control" placeholder="Commodity" required>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Quantity<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_quantity" class="form-control" placeholder="Quantity" required>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Container Type<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <select name="frm_container" class="form-control" required>
                                        <option value="">Choose Container Type</option>
                                        <option value="20'RF">20'RF</option>
                                        <option value="20'DC">20'DC</option>
                                        <option value="20'HC">20'HC</option>
                                        <option value="40'DC">40'DC</option>
                                        <option value="40'RF">40'RF</option>
                                        <option value="40'HC">40'HC</option>
                                    </select>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Weight<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_weight" class="form-control" placeholder="Weight" required>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Additional services<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_pickup_time" class="form-control pickup_time" placeholder="Cargo ready date" required>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Cargo ready date<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <div class="recheck-block">
                                        <label class="recheck-item">
                                            <input class="recheck-input" type="checkbox" name="frm_bhhh" hidden="">
                                            <div class="recheck-checkbox"></div>
                                            <p class="recheck-text">Cargo insurance</p>
                                        </label>
                                        <label class="recheck-item">
                                            <input class="recheck-input" type="checkbox" name="frm_kbhq" hidden="">
                                            <div class="recheck-checkbox"></div>
                                            <p class="recheck-text">Customs declaration</p>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Notes<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <textarea class="form-control" placeholder="Nhập thông tin khác" name="frm_mess" title="Nhập thông tin khác"></textarea>
                                </div>
                            </div>

                            <div class="frm-row frm-row--action">
                                <button type="submit" class="btn btn--primary btn--submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('../inc/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(".pickup_time").flatpickr();
    </script>
</body>

</html>