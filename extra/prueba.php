<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add or Remove Input Fields Dynamically using jQuery - www.pakainfo.com</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="container"style="max-width: 700px;">

        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="https://www.pakainfo.com/" target="_blank" rel="noopener"><img src="https://i.imgur.com/hHZjfUq.png"></a><br>
            <span class="text-secondary">Add or Remove Input Fields Dynamically using jQuery</span>
        </div>

        <form method="post" action="">
            <div class="row">
                <div class="col-lg-12">
                    

                    <div id="addMore"></div>
                    <button id="freshAddedContent" type="button" class="btn btn-info">Add Row</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        // add row
        $("#freshAddedContent").click(function () {
            var content = '';
            content += '<div id="contentFrmTxt">';
            content += '<div class="input-group mb-3">';
            content += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            content += '<div class="input-group-append">';
            content += '<button id="deleteContent" type="button" class="btn btn-danger">Remove</button>';
            content += '</div>';
            content += '</div>';

            $('#addMore').append(content);
        });

        // remove row
        $(document).on('click', '#deleteContent', function () {
            $(this).closest('#contentFrmTxt').remove();
        });
    </script>
</body>
</html>