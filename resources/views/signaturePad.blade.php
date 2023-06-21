<html>

<head>
    <title>Laravel Signature Pad Tutorial Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
    </style>

</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <div class="card">
                    <div class="card-body">

                        <div id="alertDiv" class="alert alert-danger alert-dismissible" style="display: none">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ 'Adatok feldolgozás alatt. Maradj ezen az oldalon!' }}</strong>
                        </div>

                        <form method="POST" action="{{ route('signaturepad.upload') }}">
                            @csrf
                            <div class="col-md-12">
                                <label class="" for="">Aláírás:</label>
                                <br />
                                <div id="sig"></div>
                                <br />
                                <button id="clear" class="btn btn-danger btn-sm">Törlés</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <br />
                            <button id="saveButton" class="btn btn-success">Mentés</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var saveButton = document.getElementById('saveButton');
            var alertDiv = document.getElementById('alertDiv');

            saveButton.addEventListener('click', function() {
                alertDiv.style.display = 'block';
            });
        });
    </script>

    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
</body>

</html>
