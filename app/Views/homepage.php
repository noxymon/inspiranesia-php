<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Inspiranesia - Kelas Untuk Semua</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-wid 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,400;0,800;1,400&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/commons.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script defer src="js/jquery.min.js"></script>
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <script async inline="javascript">
        /*
        <![CDATA[*/
        var loginResponse = /*[[${loginResponse}]]*/ '{}';
        /*]]
    */
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116347823-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

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
<div class="container" style="margin-top: 80px;">
    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox" style="border-radius: 20px">
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="images/1.png">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="images/2.png">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="images/3.png">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
           data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
           data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <?php foreach ($course_list as $course):?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#">
                            <img class="card-img-top" src="<?= $course->floorImage ?>" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="<?= '/course/'.$course->id ?>"><?= $course->courseName ?></a>
                            </h4>
                            <br/>
                            <p class="card-text"><?= word_limiter($course->courseDescription, 40) ?></p>
                        </div>
                        <div class="card-footer">
                            <p><?= 'Presented by '.$course->instructorName ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<?= $this->include('footer') ?>
</body>
</html>
