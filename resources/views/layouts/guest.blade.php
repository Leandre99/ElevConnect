<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="logo" >
            <a href="/">
                <img src="{{asset('assets/images/logoe.png')}}" style="width: 50%; margin-left:25%; padding-bottom:15%">
            </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg" style=" border: 6px solid #cccccc; margin-top: -5%; margin-bottom:6%">
                {{ $slot }}
            </div>
        </div>
        <script>
// Assuming you're using Javascript within your Blade template
document.addEventListener('DOMContentLoaded', function() {
  const roleSelect = document.getElementById('role');
  const descriptionContainer = document.getElementById('description-container');
  const descriptionInput = document.getElementById('description');

  // Hide description initially
  descriptionContainer.classList.add('hidden');

  // Handle click event on role select
  roleSelect.addEventListener('click', function() {
    handleRoleChange();
  });

  function handleRoleChange() {
    if (roleSelect.value === 'Veterinaire') {
      descriptionContainer.classList.remove('hidden');
      descriptionInput.setAttribute('required', true);
    } else {
      descriptionContainer.classList.add('hidden');
      descriptionInput.removeAttribute('required');
    }
  }
});
</script>

    </body>
</html>
