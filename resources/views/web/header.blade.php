<header id="header" class="header <?= Request::segment(1) ?> innernav">
    <div class="container-fluid">
        <div class="row">
            <div class="logo">
                <a href="<?= url('/') ?>"><img src="<?= asset('images/logo2.png') ?>" alt="" /></a>
            </div>

            <!-- <div class="cart-menu">
                <a href="<?= url('/cart') ?>" id='cartDetail'>
                    <span class="cart-icon">&nbsp; <em data-count='0'>0</em> </span>
                </a>
            </div> -->

            <div class="nav-right-block">
                <a href="javascript:void(0)" class="mobile-nav">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <nav class="main-nav">
                    <ul class="header-top-menu">
                        <li><a href="<?php $Videourl = App\Cms::getStaticSlug(3);echo url($Videourl[0]); ?>"><span data-hover="Video"> Videos</a></li>
                        <li>
                            <a href="<?= url('/social/') ?>">
                                Social Media
                            </a>
                        </li>
                        <li><a href="<?php $Abouturl = App\Cms::getStaticSlug(1);echo url($Abouturl[0]); ?>">About</a></li>
                        <li>
                            <a href="https://christianityengaged.org/store">
                                Store
                            </a>
                        </li>
                        <li>
                            <a href="<?= url('/donate/') ?>">
                                Donate
                            </a>
                        </li>
                        <li class="cart-btn">
                            <a href="https://christianityengaged.org/store" id='cartDetail'>
                                Cart <em data-count='0'>0</em>
                                <span class="cart-icon">&nbsp;</span>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

        </div>
    </div>
</header>

<div class="clearfix"></div>
<script>
    $(document).ready(function (e) {
        var currentUrl = $(location).attr('href');
        var menuUrl  = '';
        $('.header-top-menu').find('li').each(function () {
            var menuUrl = $(this).find('a').attr('href');
            if(menuUrl == currentUrl){
                $(this).addClass('active');
            }
        });
    });
</script>
