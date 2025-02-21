<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts
    </h2>
</x-slot>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($isOpen)
                @include('livewire.create')
            @endif

            <div class="flex justify-between">
            <input type="text" wire:model.live="search" placeholder="Search posts..."
            class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm py-2 px-4 rounded my-3">
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>
            </div>

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Content</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($posts->count() > 0)
                @foreach($posts as $post)
                <tr>
                    <td class="border px-4 py-2">{{ $post->title }}</td>
                    <td class="border px-4 py-2">{{ $post->content }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex justify-center space-x-8">
                            <button wire:click="edit({{ $post->id }})"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $post->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="h-32">
                    <td colspan="3" class="text-center py-4 align-bottom">No posts found.</td>
                </tr>
                @endif
                </tbody>

            </table><br>
            {{ $posts->links() }}
        </div>
    </div>
</div>