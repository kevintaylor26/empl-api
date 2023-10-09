@extends('layout')

@section('title', 'Home')

@section('content')

    <main class="page-content" style="margin-top: 75px;">
        <div id="search-2" class="widget widget_search" style="margin-bottom: 0px">
            <div class="search-form">
                <label for="search-form-5e875eae921cb">
                    <span class="screen-reader-text">Search for:</span>
                </label>
                <input type="search" id="inputCriteria" class="search-field" placeholder="Search &hellip;" value=""
                    name="criteria" />
                <button type="submit" class="search-submit" id="btnSearch"><i class="fa fa-search"></i><span
                        class="screen-reader-text">Search</span></button>
            </div>
        </div>
        <h2 class="title" style="text-align: center">
            Popular Searches
        </h2>
        <div class="popular-searches btn-container text-left">
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Affiliate')"><span>Affiliate</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Andre')"><span>Andre</span></a>
            <a class="iq-button btn-radius" href="about-us.html"><span>Advertiser</span></a>
            <a class="iq-button btn-radius" href="about-us.html"><span>Summit</span></a>
            <a class="iq-button btn-radius" href="about-us.html"><span>FindInfluencers</span></a>
            <a class="iq-button btn-radius" href="about-us.html"><span>Clickdealer</span></a>
            <a class="iq-button btn-radius" href="about-us.html"><span>Affilate Manager</span></a>
            <a class="iq-button btn-radius" href="about-us.html"><span>Ad Network</span></a>
        </div>
        <section id="sectionSrchResult" class="overview-block-ptb" style="padding: 10px 0px; display: none;">
            <img src="images/fancybox/overlay-dot2.png" class="overlay-right-top-2" alt="#">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-9">
                        <div class="text-left iq-title-box pr-lg-5" style="margin-bottom: 5px;">
                            <h2 class="iq-title text-uppercase">Search Result</h2>
                            <p class="iq-line three"></p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3" style="display: flex !important; justify-content: end;">
                        <div id="btnDownloadCsv" class="btn-container" style="width: 100px; display:none;">
                            <a class="iq-button d-inline-block" href="our-team.html"
                                style="display: flex !important;padding-right: 10px; align-items: center; padding: 10px 20px;justify-content: center;">
                                <span style="font-size: 18px;">CSV</span><i class="fa fa-file-text-o"
                                    style="margin-top: -5px; margin-left: 5px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-sm-center">
                    <div class="col-sm-12">
                        <table style="z-index: 2">
                            <thead>
                                <tr style="background: white">
                                    <th style="width: 140px;">Full Name</th>
                                    <th style="width: 200px;">Position</th>
                                    <th style="width: 200px;">Company</th>
                                    <th style="min-width: 200px;">Contact</th>
                                    <th style="min-width: 200px;">Address</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyResult">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <img src="images/fancybox/overlay.png" class="overlay-left-bottom" alt="#" style="z-index: -1">
        </section>
        <div class="to-regist iq-agency-block" style="margin-top: 30px;">
            <div class="auto-container" style="padding: 0px 0px 0px 50px;">
                <div class="inner-container" style="padding: 30px 100px 30px 95px;border-bottom: 2px solid #f05c42;">
                    <div class="iq-pattern-style" style="width: 100%;"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-left iq-title-box">
                                <h2 class="iq-title text-white text-uppercase wow fadeIn"
                                    style="visibility: visible; animation-name: fadeIn;">You are currently viewing 5 out of
                                    28,000+ results</h2>
                                <p class="text-white wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                                    Get instant access + lifetime updates to the full database of attendees and their
                                    contact information:</span></p>
                            </div>
                            <div class="btn-container text-left wow fadeIn"
                                style="visibility: visible; animation-name: fadeIn;">
                                <a class="iq-button btn-radius" href="signup"><span>Get Instant
                                        Access!</span><em></em></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="position-relative overview-block-ptb drak-bg overview-block-ptb iq-portfolio-after"
            style="padding-top: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="text-left iq-title-box pr-lg-5" style="margin-bottom: 5px;">
                            <h2 class="iq-title text-white text-uppercase">About Our Team</h2>
                        </div>
                    </div>
                    {{-- <div class="col-lg-8 col-md-6">
                        <div class="btn-container">
                            <a class="iq-button btn-radius btn-white" href="portfolio-details.html"><span>Click
                                    Here</span><em></em></a>
                        </div>
                    </div> --}}
                </div>
                <div class="row text-center position-relative">
                    <div class="col-sm-12">
                        <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false"
                            data-dots="true" data-items="3" data-items-laptop="3" data-items-tab="2"
                            data-items-mobile="1" data-items-mobile-sm="1" data-margin="30">
                            <div class="item">
                                <div class="iq-portfolio2">
                                    <div class="iq-portfolio-img-block">
                                        <a href="#" class="iq-portfolio-img">
                                            <img loading="lazy" src="images/team/team-1.jpg" alt="portfolio">
                                            <div class="portfolio-link">
                                                <div class="icon">
                                                    <i class="ion-android-arrow-forward"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="iq-portfolio-content">
                                        <a href="#">
                                            <h4 class="link-color">
                                                Web Development
                                            </h4>
                                        </a>
                                        <ul class="iq-portfolio-cat">
                                            <li>
                                                Business
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="iq-portfolio2">
                                    <div class="iq-portfolio-img-block">
                                        <a href="#" class="iq-portfolio-img">
                                            <img loading="lazy" src="images/team/team-2.jpg" alt="portfolio">
                                            <div class="portfolio-link">
                                                <div class="icon">
                                                    <i class="ion-android-arrow-forward"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="iq-portfolio-content">
                                        <a href="#">
                                            <h4 class="link-color">
                                                Revenue Generation
                                            </h4>
                                        </a>
                                        <ul class="iq-portfolio-cat">
                                            <li>
                                                business
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="iq-portfolio2">
                                    <div class="iq-portfolio-img-block">
                                        <a href="#" class="iq-portfolio-img">
                                            <img loading="lazy" src="images/team/team-3.jpg" alt="portfolio">
                                            <div class="portfolio-link">
                                                <div class="icon">
                                                    <i class="ion-android-arrow-forward"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="iq-portfolio-content">
                                        <a href="#">
                                            <h4 class="link-color">
                                                Agency Bussiness Work
                                            </h4>
                                        </a>
                                        <ul class="iq-portfolio-cat">
                                            <li>
                                                Consulting
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        @auth
        const url = "{{ route('api.marketings.search') }}";
        @else
            const url = "{{ route('api.marketings.free_search') }}";
        @endif
        function searchCriteria(criteria) {
            $('input[name="criteria"]').val(criteria);
            $('#preloader').show();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    criteria: criteria
                },
                success: function(res) {
                    $('#preloader').hide();
                    $('#sectionSrchResult').show();
                    $('#tbodyResult').html('');
                    if (res.code == 0) {
                        if (res.data?.length > 0) {
                            $('#btnDownloadCsv').show();
                            res.data.forEach(function(item) {
                                let tagRes = '<tr>';
                                tagRes += '<td class="result-detail text-left">' + item.first_name +
                                    ' ' + item.last_name + '</td>';
                                tagRes += '<td class="result-detail">' + item.title + '</td>';
                                const domain = item.domain.startsWith('http') ? item.domain :
                                    'https://' + item.domain
                                let domainUrl = '<br><a href="' + domain + '" target="_blank">' + item
                                    .domain + '</a>';
                                tagRes += '<td class="result-detail">' + item.company + domainUrl +
                                    '</td>';
                                const email =
                                    '<i class="ion-ios-email" style="vertical-align: middle; font-size: 20px;"></i> : <a class="email-link" href="' +
                                    item.email + '">' + item.email + '</a>';;
                                const linkedin =
                                    '<br><i class="ion-social-linkedin" style="vertical-align: middle; font-size: 20px;"></i> : <a class="email-link" href="' +
                                    item.linkedin_url + '">LinkedIn</a>';
                                tagRes += '<td class="result-detail text-left">' + email + linkedin +
                                    '</td>';
                                tagRes += '<td class="result-detail">' + item.city + '</td>';
                                tagRes += '</tr>';
                                $('#tbodyResult').append($(tagRes));
                            })
                        } else {
                            $('#btnDownloadCsv').hide();
                            let tagRes = '<tr><td colspan=5 class="no-result-found">No Result Found</td></tr>';
                            $('#tbodyResult').append($(tagRes));
                        }
                    }

                },
                error: function(msg) {
                    $('#preloader').hide();
                    $('#btnDownloadCsv').hide();
                    $('#tbodyResult').html('');
                    let tagRes = '<tr><td colspan=5 class="no-result-found">No Result Found</td></tr>';
                    $('#tbodyResult').append($(tagRes));
                    console.log(msg);
                }
            });
        }
        $('#inputCriteria').on('keydown', function(e) {
            if (e.keyCode == 13) {
                searchCriteria($('input[name="criteria"]').val());
            }
        });
        $('#btnSearch').click(function() {
            searchCriteria($('input[name="criteria"]').val());
        })
    </script>
@endsection
