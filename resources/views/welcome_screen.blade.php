<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('dist/css/welcome-screen.css') }}">
</head>
<body>
    <div class="landing-page-container">
        <div class="landing-page-title">
            <h1 class="title">selamat datang di website<h1 class="title-mini">PAK O.</h1></h1><br>
            <h2 class="sub-title-login"><a href="{{ url('/login') }}">Login</a></h2>
            <p class="jargon">Daftar Project yang belum di kerjakan dan Remidi</p> 
            <table class="table-mandiri">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Kelas</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>XI TJKT 2</td>
                        <td><a href="">https://www.link.g/k</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>XI TJKT 3</td>
                        <td><a href="">https://www.link.g/k</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>XII TJKT 3</td>
                        <td><a href="">https://www.link.g/k</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>XII TJKT 3</td>
                        <td><a href="">https://www.link.g/k</a></td>
                    </tr>
                </tbody>
            </table>
            <!-- <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSDqglcAIZIjKFJT7WFRAP1QoTS3KooYL6-Jfeqkte3VrkkQdvp84HzqQdnrERBoAV4lzKvP0KzfrAY/pubhtml" frameborder="0" width="100%" height="400px"></iframe> -->
        </div>
    </div>
</body>
</html>