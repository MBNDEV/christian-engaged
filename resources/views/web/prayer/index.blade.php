<section class="shop-banner">
    <figure>
        <img src="{{ asset('images/prayer-1.png') }}" alt="" />
        <figcaption>
            <h1>
                Pray for Our Ministry
                <span>
                    <img src="{{ asset('images/symbol.png') }}" alt="" />
                </span>
            </h1>
        </figcaption>
    </figure>
</section><!-- End .shop-banner -->

<div class="clearfix"></div>

<section class="shop-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <div class="table">
                    <div class="table-cell">
                        <h2>
                        We believe in the power of prayer.
                        </h2>
                    </div>
                    <div class="table-cell">
                        <h4>
                            We would be honored if you would regularly pray for our ministry. Below are a few different ways you can lift us up:
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End .shop-top -->

<section class="prayer-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>
                        <h2>
                            Pray for spiritual wisdom.
                        </h2>
                        <h4>
                            We seek continued wisdom as we execute to the vision the Lord gave us and make adjustments along the way.
                        </h4>
                    </li>
                    <li>
                        <h2>
                            Pray for spiritual protection.
                        </h2>
                        <h4>
                            Christianity Engaged will be attacked. The enemy seeks to destroy and will not want our ministry to be effective.
                        </h4>
                    </li>
                    <li>
                        <h2>
                            Pray for our leaders and their families.
                        </h2>
                        <h4>
                            May our families grow closer to the Lord and walk in His truth, believing what He says about us.
                        </h4>
                    </li>
                    <li>
                        <h2>
                            Pray for the hearts of our viewers.
                        </h2>
                        <h4>
                            We want the right people to watch the right video at the right time, and for our content to bring them closer to the Lord.
                        </h4>
                    </li>
                    <li>
                        <h2>
                            Pray for increased influence.
                        </h2>
                        <h4>
                            We want to reach more people, from atheists to mature believers, and reveal truth in love.
                        </h4>
                    </li>
                    <li>
                        <h2>
                            Pray for financial blessings.
                        </h2>
                        <h4>
                            May cheerful givers give generously to fund this ministry in its early years until we get more consistent income.
                        </h4>
                    </li>
                    <li>
                        <h2>
                            Pray for us to withstand the critics.
                        </h2>
                        <h4>
                            We get a lot of comments from atheists on social media. Some are respectful. Others are not.
                        </h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section><!-- End .prayer-list -->


<section class="prayer-mark">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <h2>
                    "Therefore I tell you, whatever you ask in prayer, believe that you have received it, and it will be yours."
                    <span>Mark 11:24</span>
                </h2>
            </div>
        </div>
    </div>
</section><!-- End .prayer-list -->

@include('web.section-support')

@include('web.section-donate')
    
@include('web.featured_product') 

<section class="newsletter-wrap">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12">
                <h3>We invite you join our newsletter to be notified when we release new videos.</h3>
                    <h3>You can also <a href="javascript:void(0)">subscribe</a> and click the bell notification on YouTube.</h3>

                    <ul>
                        <li>
                            <a class="join-btn btn btn-primary" data-toggle="modal" data-target="#newsletter">JOIN</a>
                        </li>
                        <li>
                            <a class="join-btn btn btn-primary" href="https://www.youtube.com/ChristianityEngaged" target="_blank"><img src="/images/yt-w.png" class="sub-img" />SUBSCRIBE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End newsletter-wrap -->

@include('web.section-social') 