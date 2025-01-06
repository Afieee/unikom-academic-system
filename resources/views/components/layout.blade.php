@if (Auth::check() && Auth::user()->role == 'sekretariat')
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            My Academic
        </title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <div class="header">
            <div class="user-info">
                <span>
                    Sekretariat
                </span>
                <i class="fas fa-question-circle">
                </i>
            </div>
        </div>
        <div class="sidebar">



            <div style="text-align: center; margin-bottom: 20px; margin: 5px 0;">
                <a href="/dashboard">
                    <img src="images/logo_unikom.png" alt="" width="120px"
                        style="margin-bottom: 10px; margin-top:10px">
                </a>
                <h3>{{ $user->name }}</h3>
                <h3>{{ $user->nim_atau_nip }}</h3>
                <form action="/proses-logout" method="get">
                    @csrf
                    <button type="submit" class="logout-button">Log-out <i class="fas fa-sign-out-alt"
                            style="margin-right: 8px;"></i></button>
                </form>
            </div>


            <x-nav-link class="menu-item" href="/manajemen-view-mahasiswa">
                <i class="fas fa-users">
                </i>
                Mahasiswa
            </x-nav-link>
            <a class="menu-item" href="/manajemen-view-dosen">
                <i class="fas fa-users">
                </i>
                Dosen
            </a>
            <a class="menu-item" href="/manajemen-view-sekretariat">
                <i class="fas fa-users">
                </i>
                Sekretariat
            </a>
            <a class="menu-item" href="/manajemen-view-matakuliah">
                <i class="fas fa-book">
                </i>
                <span style="margin-left: 6px"> Matakuliah</span>
            </a>
            <a class="menu-item" href="/manajemen-akademisi">
                <i class="fas fa-chalkboard-teacher">
                </i>
                <span>Manajemen Akademisi</span>
            </a>
        </div>
    </body>
    </center>
@elseif (Auth::user()->role == 'mahasiswa')
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            My Academic
        </title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">

    </head>

    <body>
        <div class="header">
            <div class="user-info">
                <span>
                    Mahasiswa
                </span>
                <i class="fas fa-question-circle">
                </i>
            </div>
        </div>


        <div class="sidebar">
            <a href="/dashboard">
                <img src="images/logo_unikom.png" alt="" width="120px"
                    style="margin-left: 82px; margin-top:10px">
            </a>


            <div style="text-align: center; margin-bottom: 20px; margin: 5px 0;">
                <h3>{{ $user->name }}</h3>
                <h3>{{ $user->nim_atau_nip }}</h3>
                <form action="/proses-logout" method="get">
                    @csrf
                    <button type="submit" class="logout-button">Log-out <i class="fas fa-sign-out-alt"
                            style="margin-right: 8px;"></i></button>
                </form>
            </div>

            <x-nav-link class="menu-item" href="/mahasiswa-view-nilai">
                <i class="fas fa-history">
                </i>
                Riwayat Nilai
            </x-nav-link>
            <a class="menu-item" href="/mahasiswa-view-jadwal">
                <i class="fas fa-calendar-alt">
                </i>
                Jadwal Kuliah
            </a>
            <x-nav-link class="menu-item" href="/mahasiswa-view-kurikulum">
                <i class="fas fa-book">
                </i>
                Kurikulum
            </x-nav-link>
        </div>
    </body>
@elseif (Auth::user()->role == 'dosen')
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            My Academic
        </title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    </head>

    <body>
        <div class="header">
            <div class="user-info">
                <span>
                    Dosen
                </span>
                <i class="fas fa-question-circle">
                </i>
            </div>
        </div>


        <div class="sidebar">
            <a href="/dashboard">
                <img src="images/logo_unikom.png" alt="" width="120px"
                    style="margin-left: 82px; margin-top:10px">
            </a>

            <div style="text-align: center; margin-bottom: 20px; margin: 5px 0;">
                <h3>{{ $user->name }}</h3>
                <h3>{{ $user->nim_atau_nip }}</h3>
                <form action="/proses-logout" method="get">
                    @csrf
                    <button type="submit" class="logout-button">Log-out <i class="fas fa-sign-out-alt"
                            style="margin-right: 8px;"></i></button>
                </form>
            </div>



            <a class="menu-item" href="#">
                <i class="fas fa-user">
                </i>
                Profile
            </a>

            <x-nav-link class="menu-item" href="/dosen-view-penilaian">
                <i class="fas fa-edit">
                </i>
                Penilaian
            </x-nav-link>
        </div>
    </body>
@endif

<div class="content">
    {{ $slot }}
</div>


<div class="footer">
    <p style="margin-right: 390px">
        Copyright © 2019 Divisi Academic Resource &amp; Data Center (ARDC-UNIKOM). This Website is Made for Educational
        Purpose.

    </p>
</div>
