@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="d-inline">Rental Action</h5>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <input
                        type="text"
                        class="form-control"
                        placeholder="Input Transaction Code"
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
        <div id="table-section" style="height: 500px">
            
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

        function search() {
            var search = $('#search').val();
            
            if (get_query()['search']) { // ada search
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
                var url = "{{ route('getRentalAction') }}";
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

        // Edit
        function editForm(id) {
            $.get("/admin/edit-rental-action/"+id, {}, function(data, status) {
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

        $(document).on('submit', '#updateForm', function (event) {
          event.preventDefault();
          
          var formData = new FormData($('#updateForm')[0]);
          var transaction_code = $('#transaction_code').val();

          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ route('rentalActionSave') }}",
            data: formData,
            processData: false,
            contentType: false,
                success: function(res)  {
                    $("#closeModalDialog").trigger("click");

                    Swal.fire({
                        title: 'Transaction Updated!',
                        text: "Success update transaction : " + transaction_code,
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
    </script>
@endsection