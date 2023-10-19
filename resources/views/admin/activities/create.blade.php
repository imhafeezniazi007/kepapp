@extends('layouts.admin')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="text-4xl text-custom-green text-center my-12">Add Activity</h1>
        <form action="{{ route('addActivity') }}" class="w-2/5" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <input type="text" name="name" placeholder="Name" class="bg-gray-00 border-2 border-custom-green w-full p-4 rounded-lg @error('name') border-red-500 @endError">
            </div>
            @error('name')
            <div class="my-4">
                <p class="text-xl text-red-500">{{ $message  }}</p>
            </div>
            @endError
            <div class="mb-4">
                <input type="file" name="picture" class="bg-gray-00 border-2 border-custom-green w-full p-4 rounded-lg @error('picture') border-red-500 @endError">
            </div>
            @error('picture')
            <div class="my-4">
                <p class="text-xl text-red-500">{{ $message  }}</p>
            </div>
            @endError
            <div>
                <button type="submit" class="text-xl rounded text-custom-green bg-gray-50 hover:text-white hover:bg-custom-green p-3 border border-custom-green">Add</button>
            </div>
        </form>
        <div class="w-full px-24 my-8">
                @if($activities->isNotEmpty())
                <div class="grid grid-cols-1 gap-y-8 md:grid-cols-3 md:gap-x-11 md:gap-y-12 lg:grid-cols-2 lg:gap-x-40 lg:gap-y-16 p-12">
                    @foreach($activities as $activity)
                        <div class="border border-custom-green shadow-2xl text-center rounded w-96">
                            <img src="{{ asset('storage/'.$activity->picture)  }}" class="w-full h-64" alt="">
                            <div class="p-4">
                                <p class="text-lg">{{ $activity->name }}</p>
                            </div>
                            <form action="{{ route('deleteActivity', $activity) }}" method="post" class="p-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xl rounded text-red-500 border border-red-500 bg-gray-50 hover:text-white hover:bg-red-500 p-3">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <span>
                {{$activities->links() }}
            </span>
            @else
                <div class="h-[43vh]">
                    <h1 class="text-2xl text-custom-green text-center my-12">No Activities Available to show</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
