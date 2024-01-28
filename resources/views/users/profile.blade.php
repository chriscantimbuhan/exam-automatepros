@extends('layouts.master')

@section('content')
<div class="col-lg-6 mx-auto">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card col-12">
            <div class="card-header">
                My Profile
            </div>
            
                <div class="card-body">
                    <div class='d-flex justify-content-center align-items-center'>
                    <div class="card" style="width: 20rem;">
                        
                        <img id="profile-picture" src="{{ asset('assets/default-profile-picture.png') }}" />

                        <div class="card-body">
                            <form id="upload-picture" enctype="multipart/form-data">
                                @csrf
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <input type="file" class="form-control" id="picture" name="picture" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <button id="btnUpload" type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('submit','#upload-picture', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    method:"POST",
                    url: '{{ route("users.upload-picture") }}',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(data){
                        manageInvalidFeedbacks();
                        fetchImage();
                    },
                    error: function (xhr, status, error) {
                        let response = JSON.parse(xhr.responseText);
                        manageInvalidFeedbacks(response.errors);
                    },
                    complete: function () {
                        $('button[type="submit"]').prop('disabled', false);
                    }
                });
            });

            function fetchImage() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("users.get-picture") }}',
                    success: function(imageUrl) {
                        $('#profile-picture').prop('src', imageUrl);                        
                    },
                    error: function(error) {
                        console.log(error);
                        $('#imageContainer').text('Error loading image.');
                    }
                });
            }
        });
    </script>
@endsection

