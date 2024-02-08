<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('css/vector.css') }}">
    <link rel="stylesheet" href="{{ url('vector/spider/css/admin/login.css') }}">
    <link rel="stylesheet" href="{{ url('vector/spider/css/admin/theme.css') }}">
</head>

<body>
    <main class="cflex aic jcc">
        <form action="{{ Request::url() }}" method="post" class="cflex">
            <div class="form_details">
                @csrf
                <div class="img_wrap">
                    <img src="{{ url('vector/spider/images/logo.png') }}" alt="Vector Logo">
                </div>
                <h4 id="form_title">Admin Verification</h4>
            </div>
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
                @error('username')
                    <i class="text error"><b>{{ $message }}</b></i>
                @enderror
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                @error('password')
                    <i class="text error"><b>{{ $message }}</b></i>
                @enderror
            </div>
            @if (session()->has('result'))
                <i class="text error">
                    <b>{{ session()->get('result')['msg'] }}</b>
                </i>
            @endif
            <button type="submit" class="btn">Validate</button>
        </form>
        <div class="brand_footer jse">
            <h3>Spider</h3>
            <p>Powered By Vector</p>
        </div>
    </main>
    <script src="{{ url('js/vector.js') }}"></script>
    <script>
        $('#form_title').VU.VUText.split();
    </script>
</body>

</html>
