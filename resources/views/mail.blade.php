<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <title>Ügyfél</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .col-md-6 {
            width: 48%;
        }

        h3 {
            margin-top: 0;
        }

        .list-group {
            list-style: none;
            padding: 0;
        }

        .list-group-item {
            border: none;
            padding: 10px 0;
        }

        .list-group-item strong {
            font-weight: bold;
        }

        h1 {
            background-color: red;
            border-radius: 10px 10px 0 0;
            margin: 0;
            padding: 20px;
            color: #333;
            text-align: center;

        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: red;
            border-radius: 0 0 10px 10px;
            font-weight: bold;
        }
    </style>
</head>

<body class="container">
    <main>
        <h1>{{ $ugyfel->Nev }} Ügyfél részletek</h1>

        <div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Általános információk</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>UgyfelID:</strong> {{ $ugyfel->UgyfelID }}</li>
                        <li class="list-group-item"><strong>Név:</strong> {{ $ugyfel->Nev }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $ugyfel->Email }}</li>
                        <li class="list-group-item"><strong>Objektum címe:</strong> {{ $ugyfel->ObjCim }}</li>
                        <li class="list-group-item"><strong>Telefonszám:</strong> {{ $ugyfel->Telefon }}</li>
                        <li class="list-group-item"><strong>Számlázási név:</strong> {{ $ugyfel->SzamNev }}</li>
                        <li class="list-group-item"><strong>Számlázási cím:</strong> {{ $ugyfel->SzamCim }}</li>
                        <li class="list-group-item"><strong>Kezdés dátuma:</strong> {{ $ugyfel->KezdDatum }}</li>
                        <li class="list-group-item"><strong>Befejezés dátuma:</strong> {{ $ugyfel->BefDatum }}</li>
                        <li class="list-group-item"><strong>Adószám:</strong> {{ $ugyfel->AdoSzam }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <br>
                    <h3>Munka és szerelő</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Szerelő:</strong> {{ $ugyfel->szerelo->Nev }}</li>
                        <li class="list-group-item"><strong>Szolgáltatás:</strong> {{ $ugyfel->szolgaltatas->jelleg }}
                        </li>
                        <li class="list-group-item"><strong>Munka:</strong> {{ $ugyfel->munka->Jelleg }}</li>
                        <li class="list-group-item"><strong>Munka leírás:</strong> {{ $ugyfel->munka->Leiras }}</li>
                        <li class="list-group-item"><strong>Felhasznált Anyagok:</strong>
                            {{ $ugyfel->FelhasznaltAnyagok }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div id="imageContainer">
            <h2>Aláírás kép</h2>
            <img src="{{asset('images/alairas.png')}}" alt="alairaskep" style="width: 20%;">
        </div>
        @php
        set_time_limit(120);
        @endphp

    </main>
    <footer>©2023 Triton Securty KFT.</footer>

</body>

</html>
