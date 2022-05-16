@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
            <button class="nav-link active" onclick="createForm()" id="#modalDialogBtn"><i class="bx bx-user me-1"></i> Create New Vehicle</button>
        </li>
    </ul>
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="d-inline">Manage Vehicle</h5>
                    <div class="btn-group" id="dropdown-icon-demo">
                        <button
                        type="button"
                        class="btn btn-outline-primary dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bx bx-filter"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button onclick="filter('latest')" class="dropdown-item d-flex align-items-center">
                                    <i class="bx bx-sort-up scaleX-n1-rtl"></i>Latest
                                </button>
                            </li>
                            <li>
                                <button onclick="filter('older')" class="dropdown-item d-flex align-items-center">
                                    <i class="bx bx-sort-down scaleX-n1-rtl"></i>Older
                                </button>
                            </li>
                            <li>
                                <button onclick="filter('asc')" class="dropdown-item d-flex align-items-center">
                                    <i class="bx bx-sort-a-z scaleX-n1-rtl"></i>Ascending
                                </button>
                            </li>
                            <li>
                                <button onclick="filter('desc')" class="dropdown-item d-flex align-items-center">
                                    <i class="bx bx-sort-z-a scaleX-n1-rtl"></i>Descending
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <input
                        type="text"
                        class="form-control"
                        placeholder="Search Vehicle..."
                        name="search"
                        value="{{ request('search') }}"
                        id="search"
                        aria-describedby="button-addon2"
                        />
                        <button class="btn btn-outline-primary" type="submit" onclick="search()" id="search-btn">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="table-section">
            
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDialog" data-bs-backdrop="static" tabindex="-1">
        <div id="modal-section"></div>
    </div>

    <script>
        function get_query(){
            var url = document.location.href;
            var qs = url.substring(url.indexOf('?') + 1).split('&');
            for(var i = 0, result = {}; i < qs.length; i++){
                qs[i] = qs[i].split('=');
                result[qs[i][0]] = decodeURIComponent(qs[i][1]);
            }
            return result;
        }

        function check_query(url) {
            var qs = url.substring(url.indexOf('?') + 1).split('&');
            for(var i = 0, result = {}; i < qs.length; i++){
                qs[i] = qs[i].split('=');
                result[qs[i][0]] = decodeURIComponent(qs[i][1]);
            }
            return result;
        }

        $(document).ready(function($){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.get("{{ route('AdminFetchVehicle') }}", {}, function(data, status) {
                $('#table-section').html(data);
            }).fail(function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: "[Page Error] Please reload this page.",
                })
            });
            
            $(document).on('click', '.pagination a',function(event) {
                event.preventDefault();
                var page = check_query($(this).attr('href'))['page'];

                if (get_query()['page'] && !get_query()['filter'] && !get_query()['search']) { // ada page
                    //get url and make final url for ajax 
                    var href = new URL(window.location.href);
                    var search_params = href.searchParams;
                    search_params.set('page', page);
                    href.search = search_params.toString();
                    var finalURL = href.toString();

                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else if (!get_query()['page'] && get_query()['filter'] && !get_query()['search']) { // ada filter
                    //get url and make final url for ajax 
                    var url = window.location.href;
                    var append = url.indexOf("&") == -1 ? "&" : "";
                    var finalURL = url + append + 'page=' + page;
                    
                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else if (!get_query()['page'] && !get_query()['filter'] && get_query()['search']) { // ada search
                    //get url and make final url for ajax 
                    var url = window.location.href;
                    var append = url.indexOf("&") == -1 ? "&" : "";
                    var finalURL = url + append + 'page=' + page;
                    
                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else if (get_query()['page'] && get_query()['filter'] && !get_query()['search']) { // ada page ada filter
                    //get url and make final url for ajax 
                    var href = new URL(window.location.href);
                    var search_params = href.searchParams;
                    search_params.set('page', page);
                    href.search = search_params.toString();
                    var finalURL = href.toString();

                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else if (get_query()['page'] && !get_query()['filter'] && get_query()['search']) { // ada page ada search
                    //get url and make final url for ajax 
                    var href = new URL(window.location.href);
                    var search_params = href.searchParams;
                    search_params.set('page', page);
                    href.search = search_params.toString();
                    var finalURL = href.toString();

                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else if (!get_query()['page'] && get_query()['filter'] && get_query()['search']) { // ada filter ada search
                    //get url and make final url for ajax 
                    var url = window.location.href;
                    var append = url.indexOf("&") == -1 ? "?" : "&";
                    var finalURL = url + append + 'page=' + page;
                    
                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else if (get_query()['page'] && get_query()['filter'] && get_query()['search']) { // ada semua
                    //get url and make final url for ajax 
                    var href = new URL(window.location.href);
                    var search_params = href.searchParams;
                    search_params.set('page', page);
                    href.search = search_params.toString();
                    var finalURL = href.toString();

                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                } else { // ga ada semua
                    //get url and make final url for ajax 
                    var url = "{{ route('AdminFetchVehicle') }}";
                    var append = url.indexOf("&") == -1 ? "?" : "&";
                    var finalURL = url + append + 'page=' + page;
                    
                    //set to current url
                    window.history.pushState({}, null, finalURL);
                    getData(finalURL);
                }
            });

        });

        function filter(filter) {
            if (get_query()['page'] && !get_query()['filter'] && !get_query()['search']) { // ada page
                //get url and make final url for ajax 
                var url = window.location.href;
                var append = url.indexOf("&") == -1 ? "&" : "";
                var finalURL = url + append + 'filter=' + filter;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (!get_query()['page'] && get_query()['filter'] && !get_query()['search']) { // ada filter
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('filter', filter);
                href.search = search_params.toString();
                var finalURL = href.toString();
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (!get_query()['page'] && !get_query()['filter'] && get_query()['search']) { // ada search
                //get url and make final url for ajax 
                var url = window.location.href;
                var append = url.indexOf("&") == -1 ? "&" : "";
                var finalURL = url + append + 'filter=' + filter;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (get_query()['page'] && get_query()['filter'] && !get_query()['search']) { // ada page ada filter
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('filter', filter);
                href.search = search_params.toString();
                var finalURL = href.toString();

                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (get_query()['page'] && !get_query()['filter'] && get_query()['search']) { // ada page ada search
                //get url and make final url for ajax 
                var url = window.location.href;
                var append = url.indexOf("&") == -1 ? "?" : "&";
                var finalURL = url + append + 'filter=' + filter;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (!get_query()['page'] && get_query()['filter'] && get_query()['search']) { // ada filter ada search
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('filter', filter);
                href.search = search_params.toString();
                var finalURL = href.toString();

                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (get_query()['page'] && get_query()['filter'] && get_query()['search']) { // ada semua
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('filter', filter);
                href.search = search_params.toString();
                var finalURL = href.toString();

                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else { // ga ada semua
                //get url and make final url for ajax 
                var url = "{{ route('AdminFetchVehicle') }}";
                var append = url.indexOf("&") == -1 ? "?" : "&";
                var finalURL = url + append + 'filter=' + filter;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            }
        }

        function search() {
            var search = $('#search').val();

            if (get_query()['page'] && !get_query()['filter'] && !get_query()['search']) { // ada page
                //get url and make final url for ajax 
                var url = window.location.href;
                var append = url.indexOf("&") == -1 ? "&" : "";
                var finalURL = url + append + 'search=' + search;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (!get_query()['page'] && get_query()['filter'] && !get_query()['search']) { // ada filter
                //get url and make final url for ajax 
                var url = window.location.href;
                var append = url.indexOf("&") == -1 ? "&" : "";
                var finalURL = url + append + 'search=' + search;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (!get_query()['page'] && !get_query()['filter'] && get_query()['search']) { // ada search
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('search', search);
                href.search = search_params.toString();
                var finalURL = href.toString();

                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (get_query()['page'] && get_query()['filter'] && !get_query()['search']) { // ada page ada filter
                //get url and make final url for ajax 
                var url = window.location.href;
                var append = url.indexOf("&") == -1 ? "?" : "&";
                var finalURL = url + append + 'search=' + search;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (get_query()['page'] && !get_query()['filter'] && get_query()['search']) { // ada page ada search
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('search', search);
                href.search = search_params.toString();
                var finalURL = href.toString();

                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (!get_query()['page'] && get_query()['filter'] && get_query()['search']) { // ada filter ada search
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('search', search);
                href.search = search_params.toString();
                var finalURL = href.toString();

                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else if (get_query()['page'] && get_query()['filter'] && get_query()['search']) { // ada semua
                //get url and make final url for ajax 
                var href = new URL(window.location.href);
                var search_params = href.searchParams;
                search_params.set('search', search);
                href.search = search_params.toString();
                var finalURL = href.toString();
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            } else { // ga ada semua
                //get url and make final url for ajax 
                var url = "{{ route('AdminFetchVehicle') }}";
                var append = url.indexOf("&") == -1 ? "?" : "&";
                var finalURL = url + append + 'search=' + search;
                
                //set to current url
                window.history.pushState({}, null, finalURL);
                getData(finalURL);
            }
        }

        function getData(finalURL){
            $.ajax({
                url: finalURL,
                type: "get",
                datatype: "html"
            }).done(function(data){
                $("#table-section").empty().html(data);
                // location.hash = page;
            }).fail(function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: "[Page Error] Please reload this page.",
                })
            });
        }

        // Hashing url ?page= to #
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        });

        // Create
        function viewDetail(id) {
            $.get("/admin/vehicle/view/"+id, {}, function(data, status) {
                $('#modal-section').empty().html(data);
                $('#modalDialog').modal('show');
            }).fail(function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: "[Page Error] Please reload this page.",
                })
            });
        };
        
        // Create
        function createForm() {
            $.get("{{ route('AdminCreateVehicleForm') }}", {}, function(data, status) {
                $('#modal-section').empty().html(data);
                $('#modalDialog').modal('show');
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
            }).fail(function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: "[Page Error] Please reload this page.",
                })
            });
        };

        function previewFile(input){
            var file = $("input[id=upload]").get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
            }
        }

        $(document).on('submit', '#createForm', function (event) {
          event.preventDefault();
          
          var formData = new FormData($('#createForm')[0]);
          var vehicle_name = $('#vehicle_name').val();

          $("#btn-submit").html('Please Wait...');
          $("#btn-submit"). attr("disabled", true);
         
        // // ajax
        $.ajax({
            type:"POST",
            url: "{{ route('AdminCreateVehicle') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res)  {
                $("#closeModalDialog").trigger("click");

                $.get("{{ route('AdminFetchVehicle') }}", {}, function(data, status) {
                    $('#table-section').html(data);
                });

                Swal.fire({
                    title: 'Vehicle Created!',
                    text: "Success create vehicle : " + vehicle_name,
                    icon: 'success',
                });

                $("#btn-submit").html('Create');
                $("#btn-submit"). attr("disabled", false);
            },
            error: function(data) {
                var errors = data.responseJSON;
                errorsHtml = '<ul class= "list-unstyled text-left">';
                  $.each(errors.errors,function (k,v) {
                         errorsHtml += '<li>'+ v + '</li>';
                  });
                  errorsHtml += '</ul>';
                  $("#closeModalDialog").trigger("click");
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: errorsHtml,
                })
                }
            });
        });

        // Edit
        function editForm(id) {
            $.get("/admin/vehicle/edit/"+id, {}, function(data, status) {
                $('#modal-section').empty().html(data);
                $('#modalDialog').modal('show');
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
            }).fail(function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: "[Page Error] Please reload this page.",
                })
            });
        };

        $(document).on('submit', '#updateForm', function (event) {
          event.preventDefault();
          
          var formData = new FormData($('#updateForm')[0]);
          var vehicle_name = $('#vehicle_name').val();

          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ route('AdminEditVehicle') }}",
            data: formData,
            processData: false,
            contentType: false,
                success: function(res)  {
                    $("#closeModalDialog").trigger("click");

                    $.get("{{ route('AdminFetchVehicle') }}", {}, function(data, status) {
                        $('#table-section').html(data);
                    });

                    Swal.fire({
                        title: 'Vehicle Edited!',
                        text: "Success save vehicle : " + vehicle_name,
                        icon: 'success',
                    });

                    $("#btn-save").html('Save');
                    $("#btn-save"). attr("disabled", false);
                },
            error: function(data) {
                var errors = data.responseJSON;
                errorsHtml = '<ul class= "list-unstyled text-left">';
                  $.each(errors.errors,function (k,v) {
                         errorsHtml += '<li>'+ v + '</li>';
                  });
                  errorsHtml += '</ul>';
                  $("#closeModalDialog").trigger("click");
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: errorsHtml,
                })
                }
            });
        });

        function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! Vehicle id : " + id,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type:"POST",
                        url: "{{ route('AdminDeleteVehicle') }}",
                        data: {
                            vehicle_id:id,
                        },
                            success: function(res)  {

                                $.get("{{ route('AdminFetchVehicle') }}", {}, function(data, status) {
                                    $('#table-section').html(data);
                                });

                                Swal.fire(
                                    'Deleted!',
                                    'Vehicle with id '+ id +' has been deleted.',
                                    'success'
                                )
                            },
            error: function(data) {
                var errors = data.responseJSON;
                errorsHtml = '<ul class= "list-unstyled text-left">';
                  $.each(errors.errors,function (k,v) {
                         errorsHtml += '<li>'+ v + '</li>';
                  });
                  errorsHtml += '</ul>';
                  $("#closeModalDialog").trigger("click");
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: errorsHtml,
                })
                }
            });
                    }
                })
            }
    </script>
@endsection