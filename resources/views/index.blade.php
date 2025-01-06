<title>Sistem Akademik</title>
<link rel="stylesheet" href="{{ asset('css/landing-page.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <nav class="nav-bar">
        <img src="{{ asset('images/logo_unikom.png') }}" alt="" width="80px" height="80px"class="logo-image" />

        <div class="kontak">
            <strong class="kontak">Kontak Akademik :</strong>
            <small class="kontak">akademik@email.unikom.ac.id</small>
        </div>

        <div class="siakad-text">
            <h1>SISTEM AKADEMIK</h1>
        </div>

        <a href="/Login" class="login-button">Log-in <i class="fas fa-sign-in-alt"></i>
        </a>
    </nav>

    <section class="first-section" style="background-image: url('{{ asset('storage/images/bg-akademik.png') }}');">
        <h1 class="text1-first-section">
            SELAMAT DATANG DI SISTEM AKADEMIK UNIKOM
        </h1>
        <br />
        <h3 class="text2-first-section">
            Sistem Akademik UNIKOM merupakan media akademik daring untuk
            memudahkan proses perkuliahan di lingkungan Universitas Komputer
            Indonesia
        </h3>
    </section>
</body>

</html>
