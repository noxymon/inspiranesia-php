<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $courseDetail->courseName ?></title>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,400;0,800;1,400&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/commons.css" rel="stylesheet">
    <script defer src="/js/jquery.min.js"></script>
    <script defer src="/js/bootstrap.bundle.min.js"></script>
    <script async inline="javascript">
        const courseResult = <?= json_encode($courseDetail)?>;
        const courseStartUrl = "<?= $courseStartUrl ?>";
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
    <script defer src="/js/course-start.js"></script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K7Q7BWJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div replace="navbar :: navbar"></div>
<div class="container mt-5 mb-lg-5">
    <div class="text-center">
        <img src="/images/student-with-laptop.svg" width="40%"/>
        <h1 class="font-weight-bold text-center">Semua Siap !</h1>
    </div>
    <div class="text-center">
        <h1>Kelas anda akan berlangsung sesaat lagi :)</h1>
        <p>Jika tidak, silahkan klik <a type="button" class="btn btn-primary" href="/course/<?= $courseDetail->id ?>/start?useFallback=true">disini</a></p>
    </div>
</div>

<?= $this->include('footer') ?>
<?= $this->include('fallback-modal') ?>
</body>
</html>
