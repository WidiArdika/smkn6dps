<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMK Negeri 6 Denpasar</title>
    <link rel="icon" href="{{ asset('images/SMKN6.svg') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script> --}}
</head>

<body class="min-h-screen flex flex-col">

    <x-header></x-header>

    <main class=" flex-grow">
        <div class="bg-stone-900 w-full h-18 lg:h-26"></div>
        {{$slot}}
        {{-- <div class="lg:mx-33"></div> kasi div untuk ngatur marginnya/paddingnya di dalam slot nanti --}}
    </main>

    <x-footer></x-footer>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/685e22873819e5190c8b5584/1iunrdp2n';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>