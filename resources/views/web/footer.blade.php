<div class="clearfix"></div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <a href="<?=url('/')?>"><img src="/images/footer-logo2.png" class="footer-logo" alt="Christianity Engaged"></a>
                <a href="/<?php $Videourl= App\Cms::getStaticSlug(3); echo $Videourl[0];?>" class="video-btn btn btn-info">WATCH VIDEOS</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="footer-menu">
                    <li>
                        <a href="/<?php $Contacturl= App\Cms::getStaticSlug(8); echo $Contacturl[0];?>">Contact Us</a>
                    </li>
                    <li>
                        <a href="/<?php $Termurl= App\Cms::getStaticSlug(6); echo $Termurl[0];?>">Terms Of Use</a>
                    </li>
                    <li>
                        <a href="/<?php $Policyurl= App\Cms::getStaticSlug(7); echo $Policyurl[0];?>">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="/<?php $Policyurl= App\Cms::getStaticSlug(10); echo $Policyurl[0];?>">Statement of Faith</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="social-links">
                        <ul>
                            <li><a href="https://www.youtube.com/ChristianityEngaged" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="https://www.instagram.com/christianity.engaged" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.facebook.com/ChristianityEngaged" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/christianity-engaged" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://twitter.com/CEvideos" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                    &copy; 2022 Christianity Engaged. All rights reserved.
                </div>
            </div>
        </div>
    </section>
</footer>


