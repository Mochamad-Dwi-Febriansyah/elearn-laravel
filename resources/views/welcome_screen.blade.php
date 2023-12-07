<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pak O</title>
    <link rel="stylesheet" href="{{ url('dist/css/welcome-screen.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="landing-page-container">
        <div class="landing-page-title">
            <h1 class="title">selamat datang di website<h1 class="title-mini">PAK O.</h1></h1><br>
            <a href="{{ url('/login') }}"><h2 class="sub-title-login">Login</h2></a>
            <p class="jargon">Daftar Project yang belum di kerjakan dan Remidi</p> 
            <table class="table-mandiri table">
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
                        <td>X TJKT 2</td>
                        <td><span style="color: #0011FF; cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">Click Me</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>X TJKT 3</td>
                        <td><span style="color: #0011FF; cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">Click Me</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>XI TJKT 3</td>
                        <td><span style="color: #0011FF; cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">Click Me</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>XI TJKT 3</td>
                        <td><span style="color: #0011FF; cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">Click Me</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="img-guru">
                <img src="{{ url('dist/img/guru-bg.webp') }}" alt="">
            </div>
            {{-- <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSDqglcAIZIjKFJT7WFRAP1QoTS3KooYL6-Jfeqkte3VrkkQdvp84HzqQdnrERBoAV4lzKvP0KzfrAY/pubhtml" frameborder="0" width="100%" height="400px"></iframe> --}}
            {{-- <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSDqglcAIZIjKFJT7WFRAP1QoTS3KooYL6-Jfeqkte3VrkkQdvp84HzqQdnrERBoAV4lzKvP0KzfrAY/pubhtml?widget=true&amp;headers=false"></iframe> --}}
  
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSDqglcAIZIjKFJT7WFRAP1QoTS3KooYL6-Jfeqkte3VrkkQdvp84HzqQdnrERBoAV4lzKvP0KzfrAY/pubhtml" frameborder="0" width="100%" height="400px"></iframe>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
            
              
        </div>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>