@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg mb-5">
            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard
            </header>

            <div class="w-full p-6">
                <p class="text-gray-700">
                    You are logged in!
                </p>
            </div>
        </section>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            <form class="w-full px-6 py-6 space-y-6 sm:px-10 sm:py-8 sm:space-y-8" method="POST" action="{{ route('message') }}">
                @csrf

                <div class="flex flex-wrap">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                        {{ __('Title') }}:
                    </label>

                    <input id="title" type="text"
                        class="form-input w-full @error('email') border-red-500 @enderror" name="title"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('title')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="flex flex-wrap">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                        {{ __('Message') }}:
                    </label>

                    <textarea id="message" type="text"
                        class="form-input w-full @error('password') border-red-500 @enderror" name="message"
                        required></textarea>

                    @error('message')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="flex flex-wrap">
                    <button type="submit"
                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </section>

        <section>
            @foreach($messages as $message)
                {{ $message->title }}<br/>
            @endforeach
        </section>
    </div>
</main>
@endsection
