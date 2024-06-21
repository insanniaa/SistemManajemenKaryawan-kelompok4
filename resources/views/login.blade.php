@extends('layouts.main')

@section('login')
    <div class="h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <form action="/login" method="post" style="width: 400px;" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 w-full block border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-200 dark:text-gray-800 dark:border-gray-400"
                    required value="{{ old('email') }}">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 w-full block border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-200 dark:text-gray-800 dark:border-gray-400"
                    required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm">
                    Sign in
                </button>
            </div>
        </form>
    </div>
@endsection
