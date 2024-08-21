@extends('layouts.master')
@section('title')
    Inicio
@endsection
@section('content')
    <div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            @foreach($users as $user)
            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="min-w-0 flex-1">
                    <a href="#" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-medium text-gray-900">{{ $user->full_name }}</p>
                        <p class="truncate text-sm text-gray-500">{{ $user->email }}</p>
                    </a>
                </div>
                <div class="min-w-0 flex-1">
                        <p class="text-sm text-gray-500">
                            Endereço: {{ $user->address->street }} - Número: {{ $user->address->number }}
                            - Bairro: {{ $user->address->district }} - CEP: {{ $user->address->postal_code }}
                            {{ $user->address->city }} - {{ $user->address->state }}
                        </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
@endpush
