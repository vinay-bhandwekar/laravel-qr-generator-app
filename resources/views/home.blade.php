<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ URL::asset('js/jquery.min.js') }}" /> </script>
        <style>
            
            .bg-green-50 {
                background: #00800082;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
               @include('template.login_nav')
               @include('template.lang_desktop_nav')
                
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @include('template.login_nav')
            @include('template.lang_mobile_nav')            
        </div>
    </div>
</nav>


            <!-- Page Content -->
            <main>
                  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     @if(session('error_message'))
                        
                        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                        <div>
                          {{ session('error_message') }}
                        </div>
                    </div>
                     

                    @endif 
                    @if(session('message'))
                        <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Check icon</span>
                            <div>
                              {{ session('message') }}
                            </div>
                        </div>

                    @endif    
                    <h1 class="mb-4 text-center text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{__("message.home_page_title")}}</h1>
                    <!--<p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>-->

                    <form method="POST" action="{{ route('save-qr')}}">
                        @csrf
                      <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.email.label') }}</label>
                        <input type="email" id="title" name="email" :value="old('email')"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                               placeholder="{{ __('message.qr_form.email.placeholder')}}" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      </div>
                     <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.title.label') }}</label>
                        <input type="text" id="title" name="title" :value="old('title')"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                               placeholder="{{ __('message.qr_form.title.placeholder')}}" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                      </div>
                      <div class="mb-6">
                        <label for="uuid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.id.label') }}</label>
                        <input type="text" id="uuid" name="uuid"
                               value="{{$uuid}}"
                               readonly
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                               required>
                        <x-input-error :messages="$errors->get('uuid')" class="mt-2" />
                      </div>
                        <div class="mv-6">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.type.label') }}</label>
                            <div class="flex mt-2">
                                <div class="flex items-center mr-4">
                                    <input id="type-dynamic" type="radio" value="dynamic" name="type" class="type-radio w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="type-dynamic" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.dynamic') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="type-resource" type="radio" value="resource" name="type" class="type-radio w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="type-resource" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.resource') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="type-remote" type="radio" value="remote" name="type" class="type-radio w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="type-remote" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.remote') }}</label>
                                </div>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                        </div>
                        <div class="mv-6 mt-4 hidden" id="resource-div">
                            <label for="resource" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.resource.label') }}</label>
                            
                            <div class="flex mt-2">
                                <div class="flex items-center mr-4">
                                    <input checked id="resource-redirection_url" type="radio" value="redirection_url" name="resource" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="resource-redirection_url" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.redirection_url') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="resource-data_array" type="radio" value="data_array" name="resource" class="w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="resource-data_array" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.data_array') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="resource-remote_query" type="radio" value="remote_query" name="resource" class="w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="resource-remote_query" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.remote_query') }}</label>
                                </div>
                                
                                <x-input-error :messages="$errors->get('resource')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mv-6 mt-4">
                             <textarea id="resource" name="resource_body" rows="4" class="mt-4 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                            <x-input-error :messages="$errors->get('resource_body')" class="mt-2" />
                        </div>

                        <div class="mv-6 mt-4">
                            <label for="resource" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.is_locked.label') }}</label>
                            
                            <div class="flex mt-2">
                                <div class="flex items-center mr-4">
                                    <input id="is_locked-true" type="radio" value="true" name="is_locked" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="is_locked-true" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.true') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="is_locked-false" type="radio" value="false" name="is_locked" class="w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="is_locked-false" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.false') }}</label>
                                </div>
                                  <x-input-error :messages="$errors->get('is_locked')" class="mt-2" />                             
                            </div>
                        </div>
                        <div class="mv-6 mt-4">
                            <label for="resource" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.owner.label') }}</label>
                            
                            <div class="flex mt-2">
                                <div class="flex items-center mr-4">
                                    <input id="owner-user" type="radio" value="user" name="owner" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="owner-user" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.user') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="owner-pincode" type="radio" value="pincode" name="owner" class="w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="owner-pincode" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.pincode') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="owner-email" type="radio" value="email" name="owner" class="w-4 h-4 ml-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="owner-email" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('message.email') }}</label>
                                </div>
                                <x-input-error :messages="$errors->get('owner')" class="mt-2" />  
                            </div>
                        </div>
                        <div class="mb-6 mt-4">
                        <label for="owner_details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('message.qr_form.owner_details.label') }}</label>
                        <input type="text" id="owner_details" name="owner_details" :value="old('owner_details')"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                               required>
                        <x-input-error :messages="$errors->get('owner_details')" class="mt-2" /> 
                      </div>
                       
                      <button type="submit" 
                              class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">
                          {{ __('message.save') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
            </main>
        </div>
<script>
$(document).on("click",".type-radio",function(event) {
    
   var type = $(this).val();
   if (type == "resource"){
       $("#resource-div").removeClass("hidden");
   }else{
       $("#resource-div").addClass("hidden");
   }
});

</script>
    </body>
</html>
