<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-head />
</head>
<body>
    <div id="app">

        <x-header />
        
        <main class="py-2">
            @yield('content')
        </main>

        <x-footer />

    </div>
    @livewireScripts
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#createDataModal').modal('hide');
        });
    </script>
</body>
</html>
