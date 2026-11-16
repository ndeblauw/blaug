<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories (admin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="/user/categories/create" class="rounded-sm px-4 py-1 bg-green-300" >CREATE NEW CATEGORY</a>
                    </div>

                    @foreach($categories as $category)
                        {{$category->name}}  DETAILS - EDIT -  DELETE<br/>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


