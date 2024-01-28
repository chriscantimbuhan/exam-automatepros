<script src="{{ mix('js/app.js') }}"></script>

<script>
    /*
    * Show error message per invalid form field
    */
    function showInvalidFeedback(fieldSelector, errorMessage)
    {
        if (errorMessage.length > 0) {
            var invalidFeedbackDiv = $('<div class="invalid-feedback">' + errorMessage + '</div>');

            $('#' + fieldSelector).after(invalidFeedbackDiv);

            $('.invalid-feedback').show();
        }
    }

    /*
    * Manage the error messages before displaying to the page
    */
    function manageInvalidFeedbacks(errors = null)
    {
        $('.invalid-feedback').remove();

        if (errors) {
            $.each(errors, function (key, value) {
                showInvalidFeedback(key,  value[0]);
            });
        }
    }
</script>
