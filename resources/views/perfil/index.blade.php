@extends('layouts.app')

@section('titulo')
    Editar perfil de {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form
                method="POST"
                action="{{ route('perfil.store') }}"
                class="mt-10 md:mt-0"
                enctype="multipart/form-data"
            >
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" 
                        id="username"
                        name="username"
                        placeholder="Tu usuario..."
                        value="{{ auth()->user()->username }}"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input type="file" 
                        id="imagen"
                        name="imagen"
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png"
                        />
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo electrónico
                    </label>
                    <input type="email" 
                        id="email"
                        name="email"
                        placeholder="Tu correo electrónico..."
                        value="{{ auth()->user()->email }}"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Cambiar contraseña
                    </label>
                    <input type="password" 
                        id="password"
                        name="password"
                        placeholder="Ingresá tu nueva contraseña..."
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir nueva contraseña
                    </label>
                    <input type="password" 
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirmá tu nueva contraseña..."
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña actual
                    </label>
                    <input type="password" 
                        id="password_actual"
                        name="password_actual"
                        placeholder="Ingresa tu contraseña actual..."
                        class="border p-3 w-full rounded-lg"
                    />
                    @error('password_actual')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                </div>

                <input
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transitions-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection