@extends('layout')

@section('title', 'Home')

@section('content')

    <main class="page-content" style="margin-top: 75px;">
        <div id="search-2" class="widget widget_search" style="margin-bottom: 0px">
            <form class="search-form" autocomplete="off" >
                <label for="search-form-5e875eae921cb">
                    <span class="screen-reader-text">Search for:</span>
                </label>
                <input type="search" id="inputCriteria" class="search-field" placeholder="Search &hellip;" value=""
                    name="criteria" />
                <button type="submit" class="search-submit" id="btnSearch"><i class="fa fa-search"></i><span
                        class="screen-reader-text">Search</span></button>
            </form>
        </div>
        <h2 class="title" style="text-align: center">
            Popular Searches
        </h2>
        <div class="popular-searches btn-container text-left">
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Affiliate')"><span>Affiliate</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Andre')"><span>Andre</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Advertiser')"><span>Advertiser</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Summit')"><span>Summit</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('FindInfluencers')"><span>FindInfluencers</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Clickdealer')"><span>Clickdealer</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Affilate Manager')"><span>Affilate Manager</span></a>
            <a class="iq-button btn-radius" href="javascript:searchCriteria('Ad Network')"><span>Ad Network</span></a>
        </div>
        <section id="sectionSrchResult" class="overview-block-ptb" style="padding: 10px 0px; display: none;">
            <img src="images/fancybox/overlay-dot2.png" class="overlay-right-top-2" alt="#">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-9">
                        <div class="text-left iq-title-box pr-lg-5" style="margin-bottom: 5px;">
                            <h2 class="iq-title text-uppercase">Search Result<span style="font-size: 26px; margin-left: 10px;" id="spanTotal"></span></h2>
                            <p class="iq-line three"></p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3" style="display: flex !important; justify-content: end;">
                        <div id="btnDownloadCsv" class="btn-container" style="width: 100px; display:none;">
                            <a class="iq-button d-inline-block" href="javascript:download()"
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
                    <div class="col-12 text-center">
                        <ul class="page-numbers" id="pagination">
                         </ul>
                    </div>
                </div>
            </div>
            <img src="images/fancybox/overlay.png" class="overlay-left-bottom" alt="#" style="z-index: -1">
        </section>
        @if (!Auth::user() || !Auth::user()->is_paid)
            <div class="to-regist iq-agency-block" style="margin-top: 30px;">
                <div class="auto-container" style="padding: 0px 0px 0px 50px;">
                    <div class="inner-container" style="padding: 30px 100px 30px 95px;border-bottom: 2px solid #f05c42;">
                        <div class="iq-pattern-style" style="width: 100%;"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-left iq-title-box">
                                    <h2 class="iq-title text-white text-uppercase wow fadeIn"
                                        style="visibility: visible; animation-name: fadeIn;">You are currently viewing 5 out
                                        of
                                        28,000+ results</h2>
                                    <p class="text-white wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                                        Access all data + lifetime updates to the full database of attendees and their
                                        contact information:</span></p>
                                </div>
                                <div class="btn-container text-left wow fadeIn"
                                    style="visibility: visible; animation-name: fadeIn;">
                                    @if (!Auth::user())
                                        <a class="iq-button btn-radius" href="signup"><span>Access All
                                                Data!</span><em></em></a>
                                    @else
                                        <a class="iq-button btn-radius" href="payout"><span>Access All
                                                Data!</span><em></em></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="to-regist iq-agency-block" style="margin-top: 50px;">
                <div class="auto-container" style="padding: 0px 0px 0px 50px;">
                    <div class="inner-container" style="padding: 30px 100px 30px 95px;border-bottom: 2px solid #f05c42;">
                        <div class="iq-pattern-style" style="width: 100%;"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-left iq-title-box">
                                    <h2 class="iq-title text-white text-uppercase wow fadeIn"
                                        style="visibility: visible; animation-name: fadeIn;">You are currently viewing
                                        unlimited 28,000+ results</h2>
                                    <p class="text-white wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                                        You can access all data!! </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
        <div id="limitModal" tabindex="-1" aria-hidden="true" class="modal fade">
            <div class="modal-dialog" size="lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Account Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 style="text-align: center">You have reached the free search limit<span
                                style="color: red">*</span></h1>
                        <p id="msgFromServer" style="text-align: center"></p>
                        <h2 style="text-align: center"><span>OR</span></h2>
                        <h3 style="text-align: center">Upgrade now to access all data + unlimited searches:</h3>
                        <div class="row text-center mt-3" style="justify-content: center" id="dvBtnChangePsd">
                            <div class="col-6">
                                @if (Auth::user())
                                    <a class="btn-normal iq-button d-flex" style="align-items: center" href="payout">
                                        <i class="fa fa-key mr-2"></i>
                                        <span>Access All Data</span>
                                    </a>
                                @elseif(!Auth::user())
                                    <a class="btn-normal iq-button d-flex" style="align-items: center" href="signup">
                                        <i class="fa fa-key mr-2"></i>
                                        <span>Access All Data</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        @auth
        const url = "{{ route('api.marketings.search') }}";
        @else
            const url = "{{ route('api.marketings.free_search') }}";
        @endif
        let lastQuery = '';
        let curPage = 1;

        function download() {
            if (lastQuery) {
                var link = document.createElement("a");
                link.href = "{{ route('marketings.download') }}" + "?criteria=" + lastQuery;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                delete link;
            }
        }

        function searchCriteria(criteria) {
            lastQuery = criteria;
            $('input[name="criteria"]').val(criteria);
            $('#preloader').show();
            $('#pagination').html('');
            $('#spanTotal').html('');
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    criteria: criteria,
                    page: curPage,
                    perPage: 20,
                },
                success: function(res) {
                    $('#preloader').hide();
                    if (!res.code) {
                        $('#sectionSrchResult').show();
                        $('#tbodyResult').html('');
                        if (res?.data?.length > 0) {
                            $('#btnDownloadCsv').show();
                            res.data?.forEach(function(item) {
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
                                    '<i class="ion-ios-email" style="vertical-align: middle; font-size: 20px;"></i> : <a class="email-link" href="mailto:' +
                                    item.email + '">' + item.email + '</a>';;
                                const linkedin =
                                    '<br><i class="ion-social-linkedin" style="vertical-align: middle; font-size: 20px;"></i> : <a class="email-link" href="' +
                                    item.linkedin_url + '">LinkedIn</a>';
                                tagRes += '<td class="result-detail text-left">' + email + linkedin +
                                    '</td>';
                                tagRes += '<td class="result-detail">' + item.city + '</td>';
                                tagRes += '</tr>';
                                $('#tbodyResult').append($(tagRes));
                            });
                            if(res.total > res.per_page) {
                                const pageTags = getPagination(res);
                                $('#pagination').html(pageTags);
                                $('#pagination li').off('click');
                                $('#pagination li').click(function() {
                                    curPage = $(this).attr('pageNum');
                                    searchCriteria($('input[name="criteria"]').val());
                                })
                            }
                            $('#spanTotal').html(' (Total: ' + res.total + ')');
                        } else {
                            $('#btnDownloadCsv').hide();
                            let tagRes = '<tr><td colspan=5 class="no-result-found">No Result Found</td></tr>';
                            $('#tbodyResult').append($(tagRes));
                        }
                    } else if (res.code == 10008) {
                        $('#msgFromServer').html(res.message);
                        $('#limitModal').modal('show');
                    } else {
                        toastMessage('error', res.message ?? 'An error occured while searching data');
                    }

                },
                error: function(msg) {
                    $('#preloader').hide();
                    $('#btnDownloadCsv').hide();
                    $('#tbodyResult').html('');
                    let tagRes = '<tr><td colspan=5 class="no-result-found">No Result Found</td></tr>';
                    $('#tbodyResult').append($(tagRes));
                    toastMessage('error', msg.message ?? 'An error occured while searching data');
                    console.log(msg);
                }
            });
        }
        $('#inputCriteria').on('keydown', function(e) {
            if (e.keyCode == 13) {
                curPage = 1;
                searchCriteria($('input[name="criteria"]').val());
            }
        });
        $('#btnSearch').click(function() {
            curPage = 1;
            searchCriteria($('input[name="criteria"]').val());
        })
        $('form').on('keypress', function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        });
    </script>
@endsection
