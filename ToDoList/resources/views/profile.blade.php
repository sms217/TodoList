<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

<body class="font-sans antialiased text-gray-900 leading-normal tracking-wider bg-cover"
    style="background-image:url('https://source.unsplash.com/1L71sPT5XKc');">



    <div class="max-w-4xl flex items-center h-auto lg:h-screen flex-wrap mx-auto my-32 lg:my-0">

        <!--Main Col-->
        <div id="profile"
            class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white mx-6 lg:mx-0">


            <div class="p-4 md:p-12 text-center lg:text-left">
                <!-- Image for mobile view-->
                <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 opacity-75 w-48 bg-cover bg-center"
                    style="background-image: url('/storage/images/profile.jpg')"></div>

                <h1 class="text-3xl font-bold pt-8 lg:pt-0">{{$name}}</h1>
                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-green-500 opacity-25"></div>
                <p class="pt-4 underline text-base font-bold flex items-center justify-center lg:justify-start"><svg
                        class="h-4 fill-current text-green-700 pr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                    </svg> TodoList</p>
                @foreach ($list as $li)
                <p class="pt-2 text-gray-600 text-xl lg:text-xl flex items-center justify-center lg:justify-start"><svg
                        class="h-4 fill-current text-green-700 pr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                    </svg> {{$loop->index+1}}.{{$li->todo}}@if ($li->done==0)✘ @else ✔@endif
                    @endforeach

                <div class="pt-12 pb-8">
                    <button class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full">
                        <a href="javascript:history.back()">
                            목록으로
                        </a>
                    </button>
                </div>


                <!-- Use https://simpleicons.org/ to find the svg for your preferred product -->

            </div>

        </div>

        <!--Img Col-->
        <div class=" w-full lg:w-2/5">
            <!-- Big profile image for side bar (desktop) -->
            <img src="/storage/images/profile.jpg" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
            <!-- Image from: http://unsplash.com/photos/MP0IUfwrn0A -->

        </div>


        <!-- Pin to top right corner -->
        <div class="absolute top-0 right-0 h-12 w-18 p-4">
            <button class="js-change-theme focus:outline-none">🌙</button>
        </div>

    </div>

    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script>
    //Init tooltips
    tippy('.link', {
        placement: 'bottom'
    })

    //Toggle mode
    const toggle = document.querySelector('.js-change-theme');
    const body = document.querySelector('body');
    const profile = document.getElementById('profile');


    toggle.addEventListener('click', () => {

        if (body.classList.contains('text-gray-900')) {
            toggle.innerHTML = "☀️";
            body.classList.remove('text-gray-900');
            body.classList.add('text-gray-100');
            profile.classList.remove('bg-white');
            profile.classList.add('bg-gray-900');
        } else {
            toggle.innerHTML = "🌙";
            body.classList.remove('text-gray-100');
            body.classList.add('text-gray-900');
            profile.classList.remove('bg-gray-900');
            profile.classList.add('bg-white');

        }
    });
    </script>

</body>