<div>
    @if ($race->type == 'triathlon')
    <div class="w-full py-5 px-4 mx-auto bg-gray-50 shadow-xl">
        <div x-data="{ activeTabs: 'swim' }">
            <div class="grid gap-4 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 mb-10 ">
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-white bg-red-600 uppercase border-b-2 border-red-100 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    @click="activeTabs = 'swim'"
                    :class="{
                        'border-red-200': activeTabs === 'swim',
                        'text-red-200': activeTabs === 'swim',
                        'hover:text-red-200': activeTabs !== 'swim'
                    }">
                    <h4 class="inline-block" :class="{ 'text-red-200': activeTabs === 'swim' }">
                        {{ __('Swim') }}
                    </h4>
                </div>
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-white bg-red-600 uppercase border-b-2 border-red-100 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    @click="activeTabs = 'bike'"
                    :class="{
                        'border-red-500': activeTabs === 'bike',
                        'text-red-500': activeTabs === 'bike',
                        'hover:text-red-500': activeTabs !== 'bike'
                    }">
                    <h4 class="inline-block" :class="{ 'text-red-400': activeTabs === 'bike' }">
                        {{ __('Bike') }}
                    </h4>
                </div>
                <div class="py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-white bg-red-600 uppercase border-b-2 border-red-100 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    @click="activeTabs = 'run'"
                    :class="{
                        'border-red-500': activeTabs === 'run',
                        'text-red-500': activeTabs === 'run',
                        'hover:text-red-500': activeTabs !== 'run'
                    }">
                    <h4 class="inline-block" :class="{ 'text-red-400': activeTabs === 'run' }">
                        {{ __('Run') }}
                    </h4>
                </div>
            </div>
            <div class="px-4" x-show="activeTabs === 'swim'">
                <div role="swim" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0"
                    class="w-full mb-16">
                    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                        @foreach ($this->swim as $product)
                            {{-- <x-product-card :product="$product" /> --}}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="px-4" x-show="activeTabs === 'bike'">
                <div role="bike" aria-labelledby="tab-1" id="tab-panel-1" tabindex="0" class="w-full mb-16">
                    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                        @foreach ($this->bike as $product)
                            {{-- <x-product-card :product="$product" /> --}}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="px-4" x-show="activeTabs === 'run'">
                <div role="run" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0"
                    class="w-full mb-16">
                    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                        @foreach ($this->run as $product)
                            {{-- <x-product-card :product="$product" /> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
