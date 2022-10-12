<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>SG Cars Login</title>
</head>
<body>

    <div class="h-screen w-screen flex items-center justify-center bg-gray-100">
        <div class="w-6/12 p-4 bg-white shadow-lg rounded-md">
            <h1 class="text-xl font-bold text-blue-500 text-center">SG Cars Login</h1>
            <hr class="my-4">
            <form class="flex flex-col items-center justify-center gap-y-4 mt-4" method="POST">
                @if(Session::has('error'))
                <div class="p-2 bg-red-300 rounded-md w-6/12">
                    <p class="text-red-800">{{ Session::get('error') }}</p>
                </div>
                @endif
                @csrf
                <div class="frm-grp w-6/12">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required class="w-full rounded text-sm">
                </div>
                <div class="frm-grp w-6/12">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required class="w-full rounded text-sm">
                </div>
                <div class="frm-grp w-6/12">
                    <button type="submit" class="w-full rounded text-sm bg-blue-500 text-white py-2">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
