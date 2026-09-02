<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101923">
    <title>CL Group — Kết nối hành trình - Tối ưu chuỗi cung ứng</title>
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
                <h1 class="c-mv__ttl">NHẬN TƯ VẤN & BÁO GIÁ</h1>
                <nav class="c-breadcrumb">
                    <ul class="c-breadcrumb__list">
                        <li class="c-breadcrumb__item"><a href="<?= url_home ?>" class="c-breadcrumb__link">Trang Chủ</a></li>
                        <li class="c-breadcrumb__item"><span class="c-breadcrumb__txt">NHẬN TƯ VẤN & BÁO GIÁ</span></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="c-content">
            <div class="container">
                <p style="text-align: center; margin-bottom: 40px;">Bạn đang cần phương án vận chuyển cho lô hàng sắp tới?<br>Hãy gửi thông tin cho CL Group.<br>Đội ngũ của chúng tôi sẽ xem xét tuyến vận chuyển, loại hàng, lịch dự kiến và yêu cầu giao nhận để tư vấn phương án phù hợp.</p>

                <div class="contact-box">
                    <h2 class="contact-box__ttl">Tư vấn cước vận chuyển</h2>
                    <div class="contact-form">
                        <form action="#" method="POST" class="frm">
                            <div class="frm-row">
                                <p class="frm-ttl">Họ và tên<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_name" class="form-control" placeholder="Nhập Họ và tên" require>
                                </div>
                            </div>
                            <div class="frm-row">
                                <p class="frm-ttl">Công ty<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_name" class="form-control" placeholder="Nhập Công ty" require>
                                </div>
                            </div>
                            <div class="frm-row">
                                <p class="frm-ttl">Số điện thoại<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="tel" name="frm_phone" class="form-control" placeholder="Nhập Số điện thoại" require>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Email<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="email" name="frm_mail" class="form-control" placeholder="Nhập Email" require>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Chọn dịch vụ<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <select name="frm_lvc" class="form-control" require>
                                        <option value="">Chọn Vận chuyển bằng</option>
                                        <option value="frm_duongbien">Vận chuyển đường biển</option>
                                        <option value="frm_hangkhong">Vận tải hàng không</option>
                                        <option value="frm_noidia">Vận tải nội địa</option>
                                    </select>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">POL<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_pol" class="form-control" placeholder="Nhập POL" require>
                                    <p class="frm-note">Cảng nơi hàng hóa được xếp lên tàu</p>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">POD<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_pod" class="form-control" placeholder="Nhập POD" require>
                                    <p class="frm-note">Cảng nơi hàng hóa được dỡ khỏi tàu</p>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Loại hàng<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_lmh" class="form-control" placeholder="Nhập Loại hàng" require>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Số lượng<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" name="frm_lmh" class="form-control" placeholder="Nhập Số lượng" require>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Loại Container<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <select name="frm_lvc" class="form-control" require>
                                        <option value="">Chọn Loại Cont</option>
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
                                <p class="frm-ttl">Trọng lượng<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" class="form-control pickup_time" placeholder="Trọng lượng" require>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Thời gian lấy hàng<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <input type="text" class="form-control pickup_time" placeholder="Thời gian lấy hàng" require>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Dịch vụ cần hỗ trợ<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <div class="recheck-block">
                                        <div class="recheck-item">
                                            <input class="recheck-input" type="checkbox" name="frm_bhhh" hidden="">
                                            <div class="recheck-checkbox"></div>
                                            <p class="recheck-text">Bảo hiểm hàng hoá</p>
                                        </div>
                                        <div class="recheck-item">
                                            <input class="recheck-input" type="checkbox" name="frm_kbhq" hidden="">
                                            <div class="recheck-checkbox"></div>
                                            <p class="recheck-text">Khai báo hải quan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="frm-row">
                                <p class="frm-ttl">Ghi chú<span class="frm-rq">*</span></p>
                                <div class="frm-content">
                                    <textarea class="form-control" placeholder="Nhập thông tin khác" name="frm_mess" title="Nhập thông tin khác"></textarea>
                                </div>
                            </div>

                            <div class="frm-row frm-row--action">
                                <button type="submit" class="btn btn--primary btn--submit">Gửi</button>
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