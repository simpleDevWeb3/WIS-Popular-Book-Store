$(() => {
    
    // Autofocus
    $('form :input:not(button):first').focus();
    $('.err:first').prev().focus();
    $('.err:first').prev().find(':input:first').focus();

    // Confirmation message
    $('[data-confirm]').on('click', e => {
        const text = e.target.dataset.confirm || 'Are you sure?';
        if (!confirm(text)) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //return;
        }
    });
    
    // Initiate GET request
    $('[data-get]').on('click', e => {
        e.preventDefault();
        const url = e.target.dataset.get;
        location = url || location;
    });

    // Initiate POST request
    $('[data-post]').on('click', e => {
        e.preventDefault();
        const url = e.target.dataset.post;
        const f = $('<form>').appendTo(document.body)[0];
        f.method = 'POST';
        f.action = url || location;
        f.submit();
    });

    // Reset form
    $('[type=reset]').on('click', e => {
        e.preventDefault();
        location = location;
    });

    // Photo preview
    $('input[type=file]').on('change', e => {
        const f = e.target.files[0];
        //const img = $(e.target).siblings('img')[0];

        // Get the unique identifier from the file input
        const targetId = $(e.target).data('target');

        // Find the corresponding image using the unique identifier
        const img = $(`.admin_crud_product_img_container img[data-id="${targetId}"]`)[0];

        if (!img) return;

        img.dataset.src ??= img.src;

        if (f?.type.startsWith('image/')) {
            img.src = URL.createObjectURL(f);
        }
        else {
            img.src = img.dataset.src;
            e.target.value = '';
        }
    });




    $('form[data-post]').submit(function(e) {
        e.preventDefault(); // Prevent normal form submission

        let form = $(this); // Get the form element
        let actionUrl = form.data('post'); // Get the URL from data-post
        let formData = new FormData(this); // Gather the form data

        // Send the form data via AJAX
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            contentType: false, // Don't set content type manually
            processData: false, // Let jQuery handle the data
            success: function(response) {
                // Handle the response (you can update your page here)
                $('body').html(response); // Or update a specific part of the page
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.log('Error:', error);
            }
        });
    });


});