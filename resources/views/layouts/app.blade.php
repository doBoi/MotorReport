<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>


  <title> | SoJo</title>




</head>

<body class="antialiased">



  <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 flex items-end bg-black bg-opacity-50 z-1 sm:items-center sm:justify-center"></div>


  <div class="flex flex-col flex-1 w-full">



    @yield('content')

  </div>

  </div>


</body>

</html>
