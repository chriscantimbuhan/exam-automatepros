@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-header">
                    Registered Users
                </div>
                <div class="card-body">

                    <div id="paginated-content">
                        <!-- Paginated data goes here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function () {
            loadPaginatedData();

            function loadPaginatedData(page = 1) {
                $.ajax({
                    url: '{{ route("users.index") }}',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        per_page: '5',
                        page: page
                    },
                    success: function(response) {
                        $('#paginated-content').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading paginated data:', error);
                    }
                });
            }

            $(document).on('click', '.pagination li a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadPaginatedData(page);
            });
        });
    </script>
@endsection
