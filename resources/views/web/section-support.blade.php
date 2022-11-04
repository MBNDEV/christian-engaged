<section class="mission-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>You can <span>support</span> our mission by: </h1>

                <ul>
                    <li>
                        <a href="{{ url('prayer')}}">
                            <span class="praying-icon icon"></span>
                            <h3>Praying </h3>
                            <h4>for our ministry</h4>
                        </a>
                    </li>
                    <li>
                        <a href="/<?php $Videourl= App\Cms::getStaticSlug(3); echo $Videourl[0];?>">
                            <span class="promoting-icon icon"></span>
                            <h3>Promoting  </h3>
                            <h4>our videos</h4>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/donate/')}}">
                            <span class="donating-icon icon"></span>
                            <h3>Donating  </h3>
                            <h4>to our cause</h4>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('contact')}}">
                            <span class="sponsoring-icon icon"></span>
                            <h3>Sponsoring </h3>
                            <h4>a video</h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section><!-- End mission-wrap -->