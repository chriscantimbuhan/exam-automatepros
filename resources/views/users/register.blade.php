@extends('layouts.master')

@section('content')
<div class="col-lg-6 mx-auto">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card col-12">
            <div class="card-header">
                Register your account
            </div>
            <div class="card-body">
                <form id="register">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
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
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Repeat Password">
                        </div>
                    </div>
                    <div class='d-flex justify-content-center align-items-center'>
                        <button type="submit" id="btnRegister" class="btn btn-primary">Register</button>
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
            $('#register').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("users.store") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#btnRegister').prop('disabled', true);
                    },
                    success: function (response) {
                        window.location.href = response.redirect;
                    },
                    error: function (xhr, status, error) {
                        let response = JSON.parse(xhr.responseText);
                        manageInvalidFeedbacks(response.errors);
                    },
                    complete: function () {
                        $('#btnRegister').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection