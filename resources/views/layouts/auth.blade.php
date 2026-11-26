<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Serenity Spa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="auth-body">
  <span class="blob b1"></span><span class="blob b2"></span><span class="blob b3"></span>
  @yield('content')
  <script>
    document.querySelectorAll('.toggle-eye').forEach(e => e.addEventListener('click', () => {
      const i = document.getElementById(e.dataset.target);
      i.type = i.type === 'password' ? 'text' : 'password';
      e.classList.toggle('bi-eye'); e.classList.toggle('bi-eye-slash');
    }));
  </script>
</body>
</html>
