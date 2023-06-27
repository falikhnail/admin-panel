@extends('auth.layouts.app')

@section('title')
    Registrasi
@endsection

@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 body-bg-auth">
        <h1 class="text-4xl font-extrabold dark:text-white">Registrasi</h1>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-transparent shadow-md overflow-hidden sm:rounded-lg">
            <x-auth-validation-errors class="mb-4 card rounded shadow-lg bg-white p-3" :errors="$errors" />
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input name="tipe_user" value="user" hidden />
                <div>
                    <input type="nama" name="nama" placeholder="Masukkan Nama" class="form-rounded w-full" required />
                </div>
                <div class="mt-4">
                    <input type="email" name="email" placeholder="Masukkan Email" class="form-rounded w-full"
                        required />
                </div>
                <div class="mt-4">
                    <input type="password" name="password" placeholder="Masukkan Password" class="form-rounded w-full"
                        required autocomplete="current-password" />
                </div>
                <div class="flex items-center justify-center mt-5">
                    <button type="submit" class="btn-act btn-act-primary btn-act-md shadow-lg w-48">
                        Registrasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
