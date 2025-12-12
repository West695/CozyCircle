<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CozyCircle')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'jive-purple': '#D4C4FC',
                        'jive-yellow': '#FDF5A5',
                    }
                }
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            background: linear-gradient(135deg, #D4C4FC 0%, #E8D7FF 100%);
            min-height: 100vh;
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
