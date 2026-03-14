<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('failed'))
        <div class="bg-red-500 w-full h-20 text-red-200">
            <p class="p-4">
                {{ session('failed') }}
            </p>
        </div>
    @endif

    <div x-data="{ open: false }" class="py-12">

        <x-modal name="create-session-modal" :show="$errors->isNotEmpty()" focusable>
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Add a New Session') }}
                </h2>
            
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Please fill in the details below to create a new session.
                </p>
            
                <form method="post" action="{{ route('sessions.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="name" value="Session Title" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    
                        <x-primary-button class="ms-3">
                            {{ __('Save Session') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </x-modal>

        <x-modal name="qr-modal" :show="$errors->isNotEmpty()" focusable>
            <div class="p-6">
                
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Session QR
                </p>

                <div class="flex items-center justify-center">
                    <img class="p-4 " src="https://hexdocs.pm/qr_code/2.2.1/docs/qrcode.svg" alt="">

                </div>
            
                
                
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Close') }}
                    </x-secondary-button>
                </div>
            </div>
        </x-modal>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <div class="justify-between flex w-full py-4">
                <h1 class="text-2xl font-bold">Sessions</h1>

                <x-primary-button 
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-session-modal')"
                >
                    {{ __('Create Session') }}
                </x-primary-button>
            </div>
            <table class="w-full bg-gray-800 ">
                <tr>
                    <th>Session Id</th>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>QR</th>
                </tr>
                
                @foreach ($sessions as $session)
                    <tr>
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->name }}</td>
                        <td>{{ $session->teacher_id }}</td>
                        <td>{{ $session->created_at->format('d M Y, l') }}</td>
                        <td>
                            <a href="/attendance/check/{{ Crypt::encryptString($session->id) }}">lestry this link</a>
                            {{ $session->created_at->format('H:i:s') }}
                        </td>
                        <td class="grid">
                            <x-primary-button 
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'qr-modal')">
                                Open
                            </x-primary-button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>