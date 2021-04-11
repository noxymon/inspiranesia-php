<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Login - Inspiranesia Course</title>
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,400;0,800;1,400&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
        <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
        <link href="/css/commons.css}" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="/css/my-login.css">

        <script defer src="/js/jquery.min.js}"></script>
        <script defer src="/js/bootstrap.bundle.min.js}"></script>
        <script defer src="/js/my-login.js}"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116347823-3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-116347823-3');
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

    <body class="my-login-page">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K7Q7BWJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="brand">
                            <img src="/images/logo_black.png">
                        </div>
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title">Login</h4>
                                <?php if($isLoginFailed == true): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <div><?= $failedLoginMessage ?></div>
                                    </div>
                                <?php endif ?>
                                <form action="/login/auth" method="POST" class="my-login-validation">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" value="" placeholder="email Address" required autofocus>
                                        <div class="invalid-feedback">
                                            Email is invalid
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="password" required data-eye>
                                        <div class="invalid-feedback">
                                            Password is required
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                            <label for="remember" class="custom-control-label">Remember Me</label>
                                            <a href="forgot.html" class="float-right">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Login
                                        </button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        Don't have an account?
                                        <a href="/register">Create One</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            &mdash; Inspiranesia Project
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
