@extends('admin.layout')

@section('title', 'Home')

@section('content')

    <main class="page-content" style="margin-top: 75px;">
        <h2 class="title" style="text-align: center">
            Email Data
        </h2>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">First Name:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="first_name" />
                    </div>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">Last Name:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="last_name" />
                    </div>
                </div>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">Email:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="email" />
                    </div>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">Title:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="title" />
                    </div>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">Company:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="company" />
                    </div>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">Domain:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="domain" />
                    </div>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">City:&nbsp;</span>
                        <input type="search" id="inputCriteria" class="search-field" value=""
                            name="city" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="popular-searches btn-container text-left" style="margin-bottom: 0px;">
                    <a class="iq-button btn-radius" href="javascript:searchCriteria()"><span>Search</span></a>
                </div>
            </div>
        </div>



        <section id="sectionSrchResult" class="overview-block-ptb" style="padding: 10px 0px; min-height: 300px; margin-bottom: 300px">
            <img src="images/fancybox/overlay-dot2.png" class="overlay-right-top-2" alt="#">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9">
                        <div class="text-left iq-title-box pr-lg-5" style="margin-bottom: 5px;">
                            <h2 class="iq-title text-uppercase">Search Result</h2>
                            <p class="iq-line three"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4" style="display: flex !important; justify-content: end;">
                        <div id="btnUploadCsv" class="btn-container">
                            <a class="iq-button d-inline-block" href="javascript:upload()"
                                style="display: flex !important;padding-right: 10px; align-items: center; padding: 10px 20px;justify-content: center;">
                                <span style="font-size: 18px;">Upload CSV</span><i class="fa fa-file-text-o"
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



    </main>

    <script>
        const url = "{{ route('api.marketings.admin_search') }}";
        let lastQuery = '';

        function download() {
            if (lastQuery) {
                var link = document.createElement("a");
                link.href = "{{ route('marketings.admin_download') }}" + "?criteria=" + lastQuery;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                delete link;
            }
        }

        function searchCriteria() {
            $('#preloader').show();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    first_name: $('input[name="first_name"]').val(),
                    last_name: $('input[name="last_name"]').val(),
                    email: $('input[name="email"]').val(),
                    title: $('input[name="title"]').val(),
                    company: $('input[name="company"]').val(),
                    domain: $('input[name="domain"]').val(),
                    city: $('input[name="city"]').val(),
                    p: {
                        page: 0,
                        perPage: 100,
                    },
                },
                success: function(res) {
                    $('#preloader').hide();
                    if (!res.code) {
                        $('#sectionSrchResult').show();
                        $('#tbodyResult').html('');
                        if (res?.length > 0) {
                            res.forEach(function(item) {
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
                    $('#tbodyResult').html('');
                    let tagRes = '<tr><td colspan=5 class="no-result-found">No Result Found</td></tr>';
                    $('#tbodyResult').append($(tagRes));
                    toastMessage('error', msg.message ?? 'An error occured while searching data');
                    console.log(msg);
                }
            });
        }
        $('.input-search').on('keydown', function(e) {
            if (e.keyCode == 13) {
                searchCriteria();
            }
        });
        $('#btnSearch').click(function() {
            searchCriteria();
        })
    </script>
@endsection
