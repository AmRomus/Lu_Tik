<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
    </body>
    <script type="module">
        $(document).ready(function() {
          window.feather.replace();
          if (typeof window.Livewire !== 'undefined') {
              window.Livewire.hook('morph.updating', (message, component) => {
               //   $('[data-bs-toggle="tooltip"]').tooltip();
                  window.feather.replace();
              });
          }
        });
      </script>  
       @stack('js')   
</html>
