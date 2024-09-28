<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Login</title>
</head>
<body>
    <main class="flex items-center justify-center h-screen bg-teal-400">
        <div class="sm:w-2/5 sm:h-4/5 sm:p-12 p-6 h-full w-full bg-white flex items-center justify-center flex-col rounded-lg">
            <div class="w-full h-1/5 text-3xl flex items-center justify-center text-teal-400">
                <h3>Login</h3>
            </div>
            <form id="loginForm" action="" method="POST" class="flex gap-3 flex-col w-full h-3/5">
                <div class="flex float-start flex-col">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="border border-slate-200 h-10 p-6" 
                    placeholder="Enter email">
                </div>
                <div class="flex float-start flex-col">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="border border-slate-200 h-10 p-6" 
                    placeholder="Enter password">
                </div>
                <div class="flex float-start flex-row">
                    <input type="checkbox" name="show_password" id="show_password" class="mr-4">
                    <label for="show_password">Show password</label>
                </div>
                <button type="submit" class="w-full h-12 bg-teal-500 text-white hover:bg-teal-600">Sign in</button>
            </form>
            <div class="flex items-center justify-center flex-col w-full h-1/5">
                <p>Forgot <a href="" class="text-blue-400 underline hover:no-underline hover:text-blue-600">username</a> / <a href="" class="text-blue-400 underline hover:no-underline hover:text-blue-600">password</a>?</p>
                <p>Don't have an account? <a href="/register" class="text-blue-400 underline hover:no-underline hover:text-blue-600">Sign up</a></p>
            </div>
        </div>
    </main>
    <script src="/js/main.js"></script>
</body>
</html>