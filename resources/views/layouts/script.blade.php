<script src="{{ asset('assets/js/bundle.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/scripts.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/charts/gd-analytics.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/libs/jqvmap.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/libs/editors/summernote.js?ver=3.2.2')}}"></script>
<script src="{{ asset('assets/js/editors.js?ver=3.2.2')}}"></script>
<script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/charts/gd-default.js?ver=3.2.2') }}"></script>
<script src="{{ asset('assets/js/example-chart.js?ver=3.2.2') }}"></script>
<script src="{{ asset('tagify/tagify.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script>
$(document).ready(function() {
    ajaxModal();
});

// Ajax modal
function ajaxModal() {
    let $ajaxModalTrigger = $('.ajax-modal-trigger'),
        $modal = $('#ajax-modal');

    $ajaxModalTrigger.on('click', function() {
        $.get($(this).data('route'), {}, function(data) {
            // console.log(data);
            $modal.html(data);
            $modal.modal('show');
        });
    });
}

// ajax form submit
function ajaxFormSubmit() {
    let $ajaxForm = $('.ajax-form'),
        $validation = $('.validation');

    $ajaxForm.on('submit', function(e) {
        e.preventDefault();
        $.ajax($(this).attr('action'), {
            method: 'post',
            processData: false,
            contentType: false,
            data: new FormData($(this)[0])
        }).done(function(data) {
            if (data.redirect == true) {
                return window.location.replace(data.route);
            }
            // location.reload();
        }).fail(function(data) {
            $validation.html('');
            $validation.prev().removeClass('is-invalid');
            Object.entries(data.responseJSON.errors).forEach(([key, value]) => {
                let $field = $('#' + key + '-validation');
                $field.prev().toggleClass('is-invalid');
                $field.html(value[0]);
            });
        });
    });
}
</script>
