<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/password.js') }}"></script>
    <title>Login</title>
</head>

<body>

    <div class="login-container">
        <h1>LOGIN AKADEMIK</h1>
        <form action="login" method="POST">
            @csrf
            <table>
                <tr>
                    <td colspan="2">
                        <center>
                            <img src="{{ asset('images/logo_unikom.png') }}" alt="" width="150"
                                style="just">
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>NIM/NIP</td>
                    <td><input type="text" name="nim_atau_nip" required placeholder="Masukkan NIM/NIP..."></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" id="password" required
                            placeholder="Masukkan Password...">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- Checkbox for showing password -->
                        <label>
                            <input type="checkbox" id="showPasswordCheckbox" onclick="togglePasswordVisibility()">
                            <span class="show-password">Show
                                Password</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Login</button>
                    </td>
                </tr>
            </table>
        </form>
        <a href="/">Kembali</a>
    </div>

    <style>
        .show-password:hover {
            cursor: pointer
        }
    </style>

</body>

</html>
