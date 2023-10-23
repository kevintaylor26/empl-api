@extends('admin.layout')

@section('title', 'Home')

@section('content')

    <main class="page-content" style="margin-top: 75px;">
        <h2 class="title" style="text-align: center">
            Users Management
        </h2>
        <form class='container' autocomplete="off">
            <div class='row'>
                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <div class="search-form display-flex admin-search-form">
                        <span class="form-label">Email:&nbsp;</span>
                        <input type="search" class="search-field" value="" role="presentation" autocomplete="off"
                            name="email" />
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="popular-searches btn-container text-left" style="margin-bottom: 0px;">
                    <a class="iq-button btn-radius" href="javascript:searchCriteria()"><span>Search</span></a>
                </div>
            </div>
        </div>
        <section id="sectionSrchResult" class="overview-block-ptb" style="padding: 10px 0px; min-height: 300px; margin-bottom: 150px">
            <img src="images/fancybox/overlay-dot2.png" class="overlay-right-top-2" alt="#">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9">
                        <div class="text-left iq-title-box pr-lg-5" style="margin-bottom: 5px;">
                            <h2 class="iq-title text-uppercase">Search Result<span style="font-size: 26px; margin-left: 10px;" id="spanTotal"></span></h2>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-4" style="display: flex !important; justify-content: end;">
                        <div id="btnUploadCsv" class="btn-container">
                            <a class="iq-button d-inline-block" href="javascript:upload()"
                                style="display: flex !important;padding-right: 10px; align-items: center; padding: 10px 20px;justify-content: center;">
                                <span style="font-size: 18px;">Upload CSV</span><i class="fa fa-file-text-o"
                                    style="margin-top: -5px; margin-left: 5px;"></i>
                            </a>
                        </div>
                    </div> --}}
                </div>
                <div class="row justify-content-sm-center" style=" min-height: 300px;">
                    <div class="col-sm-12">
                        <table style="z-index: 2;">
                            <thead>
                                <tr style="background: white">
                                    <th style="width: 140px;">Email</th>
                                    <th style="width: 200px;">Created At</th>
                                    <th style="width: 200px;">Full Access</th>
                                    <th style="width: 200px;">Pait At</th>
                                    <th style="min-width: 200px;">Operate</th>
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

        <div id="deleteModal" tabindex="-1" aria-hidden="true" class="modal fade">
            <div class="modal-dialog" size="lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Warning</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 style="text-align: center" id='emailWarning'>Are you sure to delete?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <script>
        const url = "{{ route('api.users.users_search') }}";
        let lastQuery = '';
        let curPage = 1;
        let delEmail = '';
        function download() {
            if (lastQuery) {
                var link = document.createElement("a");
                link.href = "{{ route('admin.users.download') }}" + "?criteria=" + lastQuery;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                delete link;
            }
        }
        function searchCriteria() {
            $('#preloader').show();
            $('#pagination').html('');
            $('#spanTotal').html('');
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: $('input[name="email"]').val(),
                    page: curPage,
                    perPage: 20,
                },
                success: function(res) {
                    $('#preloader').hide();
                    if (!res.code) {
                        $('#sectionSrchResult').show();
                        $('#tbodyResult').html('');
                        if (res?.data?.length > 0) {
                            res?.data.forEach(function(item) {
                                let tagRes = '<tr>';
                                tagRes += '<td class="result-detail text-left">' + item.email + '</td>';
                                tagRes += '<td class="result-detail">' + item.created_at + '</td>';
                                tagRes += '<td class="result-detail text-center"><input type="checkbox" style="width: 100%; height: 25px;" readonly onclick="return false;" ' + (item.is_paid ? 'checked' : '') + '></td>';
                                tagRes += '<td class="result-detail">' + (item.last_paid_at ?? '') + '</td>';
                                tagRes += '<td class="result-detail"><button class="btn btn-danger user-delete" email="' + item.email + '">Delete</button>' + '</td>';
                                tagRes += '</tr>';
                                $('#tbodyResult').append($(tagRes));
                            });
                            if(res.total > res.per_page) {
                                const pageTags = getPagination(res);
                                $('#pagination').html(pageTags);
                                $('#pagination li').off('click');
                                $('#pagination li').click(function() {
                                    curPage = $(this).attr('pageNum');
                                    searchCriteria();
                                })
                            }
                            $('.user-delete').off('click');
                            $('.user-delete').click(function(){
                                email = $(this).attr('email');
                                $('#emailWarning').html('Are you sure to delete <span style="font-family:inherit; color: red;">' + email + '</span> user?');
                                $('#deleteModal').modal('show');
                            })
                            $('#spanTotal').html(' (Total: ' + res.total + ')');
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
        $('.search-field').on('keydown', function(e) {
            if (e.keyCode == 13) {
                searchCriteria();
            }
        });
        $('#btnSearch').click(function() {
            searchCriteria();
        })
        $('form').on('keypress', function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        });
        searchCriteria();
    </script>
@endsection
