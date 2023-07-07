@section('title', __('My Account'))
<x-app-layout>
    <section class="py-5 px-4 bg-gray-100">
        <div class="flex flex-wrap -mx-4 mb-20 items-center justify-between bg-gray-100 py-5">
            <div class="flex">
                <div class="w-1/4 mx-4">
                    <div class="flex flex-col space-y-2 bg-gray-200 mt-2 py-4">
                        <button @click="tab = 'company'" :class="{ 'bg-green-500 text-white': tab === 'company' }"
                            class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors">
                            {{ __('My Account') }}
                        </button>
                    </div>
                </div>
                <div class="w-3/4 px-4">
                    @livewire('front.account')
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
