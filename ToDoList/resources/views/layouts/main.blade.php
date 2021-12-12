<script defer>
function confirmAdd() {
    event.preventDefault();
    const form = document.getElementById('form')
    const input = document.getElementById('input')
    if (confirm('할 일을 등록하시겠습니까?'))
        form.submit()
    else {
        input.value = ''
    }
}

function confirmDelete() {
    const delForm = document.getElementById('delForm')
    console.log(delForm.action)
    if (confirm('할 일을 삭제하시겠습니까?')) {
        delForm.submit()
        // return false
    } else
        event.preventDefault();
}

function confirmDone() {
    // event.preventDefault();
    const doneForm = document.getElementById("doneForm")
    if (confirm('할 일을 완료하셨습니까?'))
        doneForm.submit()
    else
        event.preventDefault();
}

function confirmEdit() {
    // event.preventDefault();
    const editForm = document.getElementById("editForm")
    const todoInput = document.getElementById("todoInput")
    todoInput.hidden = false;
    todoInput.focus()
    const hiddenInput = document.getElementById("hiddenInput")
    hiddenInput.value = todoInput.value
    if (todoInput.value != '' && confirm('할 일을 수정하시겠습니까?')) {
        editForm.submit()
    } else
        event.preventDefault();
    console.log(hiddenInput.value)
}
</script>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="h-full" style=" background-image: url(' /storage/images/Galaxy.jpg'); background-size:cover">

    @auth
    <div class="flex justify-end">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('POST')
            <button type="submit" class="btn justify-end border-2 rounded-2xl m-3 font-bold text-xl p-1 text-white">
                Log Out
            </button>
        </form>
    </div>
    <div class="flex justify-center font-sans">
        <div class="bg-transparent rounded shadow p-2 ">
            <div class="mb-4">
                <form id="form" action="{{route('create')}}" method="POST">
                    @csrf
                    <h1 class="text-gray-700 text-2xl p-1 uppercase underline font-bold text-center bg-white">Todo List
                    </h1>
                    <div class="flex mt-2">
                        <input id="input" type="text" name="todo"
                            class="shadow appearance-none border rounded w-full px-3 mr-3 text-gray-700"
                            placeholder="Add Todo" required>
                        @error('todo')
                        <div class="text-white">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                        <button class="border-2 p-1 rounded text-blue-500 border-blue-500 hover:text-white
                            hover:bg-blue-500 bg-yellow-50" type="submit" onclick="confirmAdd()">Add</button>
                    </div>
                </form>
            </div>
            <div class="p-2" style="overflow:auto;height:350px;">
                @if ($lists!=null)
                @foreach ($lists as $list)
                @if ($loop->index==0)
                <div class="rounded-xl bg-purple-500 flex font-bold justify-center text-white text-lg opacity-90">
                    <p>
                        {{$list->user->name}}님 로그인되었습니다.
                    </p>
                </div>
                @endif
                <div class=" flex items-center">
                    <p id="editDiv" class="w-full text-xl rounded-3xl bg-gray-400 px-2 py-2 text-white">
                        {{$loop->index+1}}.&nbsp;{{$list->todo}}
                        <input type="text" id="todoInput" placeholder="{{$list->todo}}" class="pl-3 bg-gray-400 ml-3"
                            hidden>&nbsp;@if ($list->done==0)✘ @else ✔@endif
                    </p>


                    @if ($list->done==0)

                    <form class=" mt-4" action="{{route('update',['li'=>$list->id])}}" method="POST" id="doneForm">
                        @csrf
                        @method('patch')
                        <button
                            class="p-1 ml-3 border-2 rounded hover:text-white text-green-500 border-green-500 hover:bg-green-500 bg-yellow-50	"
                            onclick="confirmDone()">Done</button>
                    </form>
                    @endif
                    <form class="mt-4" action="{{route('updateTodo',['li'=>$list->id])}}" method="POST" id="editForm">
                        @csrf
                        @method('patch')
                        <input type="text" name="todo" id="hiddenInput" hidden>
                        <button
                            class="p-1 ml-2 mr-2 border-2 rounded hover:text-white text-purple-500 border-purple-500 hover:bg-purple-500 bg-yellow-50"
                            onclick="confirmEdit()">Edit</button>
                    </form>
                    <form id="delForm" class="mt-4" action="{{route('destroy',['id'=>$list->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button
                            class="p-1 border-2 rounded text-red-500 border-red-500 hover:text-white hover:bg-red-500 bg-yellow-50"
                            onclick="confirmDelete()">
                            Remove</button>
                    </form>
                </div>
                <div class="flex mb-3 justify-center">
                    <!-- @foreach ($sameUserId as $userId)
                    <div class="flex ml-3 text-xs border-pink-500 border-2 
                    bg-pink-700 hover:bg-pink-300 rounded-xl p-1 justify-center text-white font-bold cursor-pointer">
                        <a href="/profile/{{$userId}}"></a>
                    </div>
                    @endforeach -->
                    @foreach ($sameUserName as $userName)
                    <div class="flex ml-3 text-xs border-pink-500 border-2 
                    bg-pink-700 hover:bg-pink-300 rounded-xl p-1 justify-center text-white font-bold cursor-pointer">
                        <a href="/profile/{{$userName}}">{{$userName}}</a>
                    </div>
                    @endforeach
                </div>

                <!-- <div class=" flex items-center">
                            <p class="w-full line-through text-green-500">Submit Todo App Component to Tailwind
                                Components
                            </p>
                            <button
                                class="p-1 ml-4 mr-2 border-2 rounded hover:text-white text-gray-500 border-gray-500 hover:bg-gray-500 bg-yellow-50	">Not
                                Done</button>
                                <button
                                class="p-1 ml-2 border-2 rounded text-red-500 border-red-500 hover:text-white hover:bg-red-500 bg-yellow-50	">Remove</button>
                            </div> -->

                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="p-2 border-solid border-white border-2 text-xl m-5 font-bold text-white">
        <p class="flex justify-center">
            완료한 할 일 목록
        </p>
        <div class="flex justify-center text-lg">
            @foreach ($dones as $done)
            {{$done->todo}}&nbsp;&nbsp;
            @endforeach
        </div>
    </div>
    @endauth

    <div class="opacity-70 m-5">
        <div class="flex justify-center">
            <p class="text-2xl absolute bottom-2 text-center b-3 italic bold text-white" id="says">
                @foreach ($says as $say)
                @if($rand==$say->id)
                {{$say->says}} - {{$say->sayer}}
                @endif
                @endforeach
            </p>
        </div>
    </div>
    @guest
    <!-- Session Status -->
    <div class="m-auto flex justify-center w-5/12 bg-white opacity-80 p-2 rounded-xl">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
                <a href="/regiView" class="underline ml-5">Register</a>
            </div>
        </form>
    </div>
    @endguest
</div>