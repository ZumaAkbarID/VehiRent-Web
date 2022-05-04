@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/main/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Choose Your Vehicle</h1>
        </div>
      </div>
    </div>
  </section>
      

      <section class="ftco-section bg-light">
      <div class="container">
          <div class="row">

            <div class="row mx-1">
                <div class="col-3">
                    <select name="filter" id="filter" class="form-control">
                        <option value="">Filter Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->type_slug }}" @if(request('filter') == $type->type_slug) selected @endif>{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-9 input-group mb-4">
                    <input type="text" class="form-control" placeholder="Search Vehicle" id="search" name="search" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="search_btn" onclick="search()" type="button">Search</button>
                    </div>
                </div>
            </div>

            <div id="main-rental"></div>
              
        </div>
      </div>
      </div>
  </section>
  
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

    $('#filter').on('change', function() {
        filter($('#filter').val());
    });

    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.get("{{ route('queryRental') }}", {}, function(data, status) {
            $('#main-rental').html(data);
        });
        
        $(document).on('click', '.custom-pagination a', function(e) {
            e.preventDefault();
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
                var url = "{{ route('queryRental') }}";
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
            var url = "{{ route('queryRental') }}";
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
            var url = "{{ route('queryRental') }}";
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
            $("#main-rental").empty().html(data);
            // location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
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
        });
    };
    
    // Create
    function createForm() {
        $.get("{{ route('AdminCreateVehicleForm') }}", {}, function(data, status) {
            $('#modal-section').empty().html(data);
            $('#modalDialog').modal('show');
        });
    };

    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

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
        }
        });
    });

    // Edit
    function editForm(id) {
        $.get("/admin/vehicle/edit/"+id, {}, function(data, status) {
            $('#modal-section').empty().html(data);
            $('#modalDialog').modal('show');
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
                        }
                    });
                }
            })
        }
</script>
@endsection