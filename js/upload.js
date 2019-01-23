$(document).ready(function () {

    // Add eventhandlers for dragover and prevent the default actions for this event
    $('#dock').on('dragover', function (e) {
        $(this).attr('class', 'dock_hover'); // If drag over the window, we change the class of the #dock div by "dock_hover"
        e.preventDefault();
        e.stopPropagation();
    });

    // Add eventhandlers for dragenter and prevent the default actions for this event
    $('#dock').on('dragenter', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    $('#dock').on('dragleave', function (e) {
        $(this).attr('class', 'dock'); // If drag OUT the window, we change the class of the #dock div by "dock" (the original one)
    });

    // When drop the images
    $('#dock').on('drop', function (e) { // drop-handler event
        if (e.originalEvent.dataTransfer) {
            $('.progress-bar').attr('style', 'width: 0%').attr('aria-valuenow', '0').text('0%'); // Bootstrap progress bar at 0%
            if (e.originalEvent.dataTransfer.files.length) { // Check if we have files
                e.preventDefault();
                e.stopPropagation();
                // Launch the upload function
                upload(e.originalEvent.dataTransfer.files); // Access the dropped files with e.originalEvent.dataTransfer.files
            }
        }
    });

    function upload(files) { // upload function
        var fd = new FormData(); // Create a FormData object
        for (var i = 0; i < files.length; i++) { // Loop all files
            fd.append('file_' + i, files[i]); // Create an append() method, one for each file dropped
        }
        fd.append('nbr_files', i); // The last append is the number of files

        $.ajax({ // JQuery Ajax
            type: 'POST',
            url: 'ajax/upload.php', // URL to the PHP file which will insert new value in the database
            data: fd, // We send the data string
            processData: false,
            contentType: false,
            success: function (data) {
                $('#result').html(data); // Display images thumbnail as result
                $('#dock').attr('class', 'dock'); // #dock div with the "dock" class
                $('.progress-bar').attr('style', 'width: 100%').attr('aria-valuenow', '100').text('100%'); // Progress bar at 100% when finish
            },
            xhrFields: { //
                onprogress: function (e) {
                    if (e.lengthComputable) {
                        var pourc = e.loaded / e.total * 100;
                        $('.progress-bar').attr('style', 'width: ' + pourc + '%').attr('aria-valuenow', pourc).text(pourc + '%');
                    }
                }
            },
        });
    }

});