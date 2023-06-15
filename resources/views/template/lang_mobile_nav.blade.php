<div class="px-4">
                <div class="font-medium text-base text-gray-800"> 
                 
                                @if (session()->has('locale'))
                                    {{strtoupper(session()->get('locale'))}}
                                @else
                                      {{ __('EN') }}
                                @endif
                                
                </div>
                <div class="font-medium text-sm text-gray-500"></div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('change.lang','en')">
                    {{ __('EN') }}
                </x-responsive-nav-link>

                <!-- Authentication -->

                    <x-responsive-nav-link :href="route('change.lang','es')">
                        {{ __('ES') }}
                    </x-responsive-nav-link>
                
            </div>