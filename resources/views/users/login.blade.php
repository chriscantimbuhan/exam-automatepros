@extends('layouts.master')

@section('content')
    <div class="col-lg-6 mx-auto">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card col-12">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <form id="login">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class='d-flex justify-content-center align-items-center'>
                            <button id="btnLogin" type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function () {
            $('#login').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("user-login") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#btnLogin').prop('disabled', true);
                    },
                    success: function (response) {
                        window.location.href = response.redirect;
                    },
                    error: function (xhr, status, error) {
                        let response = JSON.parse(xhr.responseText);

                        console.log(response);

                        manageInvalidFeedbacks(response.errors);
                    },
                    complete: function () {
                        $('#btnLogin').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection