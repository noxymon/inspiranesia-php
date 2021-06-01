<?php
    use CodeIgniter\I18n\Time;

    function isValidToJoinClass($courseDetail): bool
    {
        return $courseDetail->isOpenForRegistration && !$courseDetail->isAlreadyJoined;
    }

    function isValidToStartClass($courseDetail): bool
    {
        return $courseDetail->isAlreadyJoined && $courseDetail->isAlreadyStart;
    }

    function isNotValidToRegister($courseDetail): bool
    {
        return !$courseDetail->isOpenForRegistration && !$courseDetail->isAlreadyJoined;
    }

    function isAlreadyRegistered($courseDetail): bool
    {
        return $courseDetail->isAlreadyJoined && !$courseDetail->isAlreadyStart;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $courseDetail->courseName ?></title>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,400;0,800;1,400&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/commons.css" rel="stylesheet">
    <link href="/css/shop-item.css" rel="stylesheet">
    <script defer src="/js/jquery.min.js"></script>
    <script defer src="/js/bootstrap.min.js"></script>
    <script async inline="javascript">
        const loginResponse = <?= json_encode($loginResponse); ?>;
        const courseResult = <?= json_encode($courseDetail)?>;
    </script>
    <script defer src="/js/course-detail.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116347823-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-116347823-3');
        gtag('set', {'user_id': "'"+loginResponse.email+"'"});
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K7Q7BWJ');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K7Q7BWJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?= $this->include('navbar') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="card text-center mt-4">
                <div class="card-header text-center">
                    <h5 class="font-weight-bold"><?= Time::parse($courseDetail->courseStartDate)->toLocalizedString("dd MMMM YYYY") ?></h5>
                    <span>
                        <?= Time::parse($courseDetail->courseStartTime)->toLocalizedString("hh:mm a").' - '.Time::parse($courseDetail->courseEndTime)->toLocalizedString("hh:mm a") ?>
                    </span>
                </div>
                <?php if($courseDetail->daysBeforeStartDate > 0): ?>
                    <div class="card-footer text-muted">
                        Ditutup <span><?= $courseDetail->daysBeforeStartDate ?></span> hari
                        lagi
                    </div>
                <?php endif ?>
                <div class="card-body">
                    <h5 class="card-title"><?= 'Tersisa '.($courseDetail->capacity - $courseDetail->registeredCount).' kursi lagi' ?></h5>
                    <?php if(isValidToJoinClass($courseDetail)) : ?>
                        <button id="btnJoinCourse" type="button" class="btn btn-block btn-lg btn-primary">
                            Join Course
                        </button>
                    <?php endif ?>
                    <?php if(isNotValidToRegister($courseDetail)) : ?>
                        <button id="btnClosedRegistration" type="button" class="btn btn-block btn-lg btn-secondary" disabled>
                            Pendaftaran Sudah Ditutup
                        </button>
                    <?php endif ?>
                    <?php if( isAlreadyRegistered($courseDetail) ): ?>
                        <button id="btnAlreadyJoined" class="btn btn-block btn-lg btn-success">
                                <span class="fa fa-check" role="status" aria-hidden="true"></span>
                        Terdaftar
                        </button>
                    <?php endif ?>
                    <?php if(isValidToStartClass($courseDetail)): ?>
                        <a href="<?= $courseDetail->courseStartUrl ?>" id="btnStartCourse" class="btn btn-block btn-lg btn-danger">
                            <span class="fa fa-play-circle " role="status" aria-hidden="true"></span>
                            Mulai Kelas
                        </a>
                    <?php endif ?>
                    <button id="btnJoinCourseLoading" class="btn btn-block btn-lg btn-primary" style="display: none" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Loading ...
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card mt-4">
                <img class="card-img-top img-fluid" src="<?= $courseDetail->detailImage ?>"
                     alt="">
                <div class="card-body">
                    <h3 class="card-title"><?= $courseDetail->courseName ?></h3>
                    <p class="card-text mt-4"><?= $courseDetail->courseDescription ?></p>
                </div>
            </div>

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Instructor
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 text-justify">
                            <strong><?= $courseDetail->instructorName ?></strong>
                            <p><?= $courseDetail->instructorDescription ?></p>
                        </div>
                        <div class="col-md-4">
                            <img src="https://lh3.googleusercontent.com/8nFFbolv0VrMYUfFbqGQHF7wh7tECq8zKlDLCOw2lIawBZeV_seaGuDDYis5nkKU0PVMQurgt5m6Kuo4xXvGMbY6gJcLeTSbTDbIC1c1b7rs1gjwuQbcvlbtc1BvBReErpar1_GJCQ=w200">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Course Outline
                </div>
                <div class="card-body">
                    <div><?= $courseDetail->courseOutline ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('footer') ?>
<?= $this->include('error-modal') ?>
</body>
</html>
