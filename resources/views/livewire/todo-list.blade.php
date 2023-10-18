<div>
    <div id="head" class="flex border-blue-800 border-t-2">
        <div class="w-full">
            <header class="flex bg-white justify-between h-20 border-b border-b-gray-200 items-center px-6">
                <div id="left-header" class="">
                </div>
                <div id="right-header" class="text-gray-800 hover:text-gray-600 space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </header>
        </div>
    </div>
    <div id="content" class="mx-auto" style="max-width:500px;">
        @if(session('error'))
            <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                    <p class="font-bold">Error</p>
                    <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="container content py-6 mx-auto">
            <div class="mx-auto">
                <div id="create-form" class="hover:shadow p-6 bg-white border-blue-500 border-t-2">
                    <div class="flex ">
                        <h2 class="font-semibold text-lg text-gray-800 mb-5">Create New Todo</h2>
                    </div>
                    <div>
                        <form wire:submit="create">
                            <div class="mb-6">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    Todo </label>
                                <input wire:model="name" type="text" id="title" placeholder="Todo.."
                                    class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">

                                @error('name')
                                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                                @enderror

                            </div>
                            <button wire:click.prevent="create" type="submit"
                                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Create
                                +</button>

                            @if(session('success'))
                                <span class="text-green-500 text-xs">{{ session('success') }}</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.includes.search-box')

        <div id="todos-list">
            @foreach($todos as $todo)
                @include('livewire.includes.todo-card')
            @endforeach
            <div class="my-2">
                <!-- Pagination goes here -->
                {{ $todos->links() }}
            </div>
        </div>
    </div>
</div>
