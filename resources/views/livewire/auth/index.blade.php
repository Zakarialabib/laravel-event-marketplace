<div>
    <div class="w-full lg:w-1/2 py-10 px-5 my-auto" x-data="{ isTab: 'login' }">
        <div class="flex mb-6">
            <button type="button"
                class="w-1/2 py-2 px-6 text-center bg-gray-100 text-black hover:bg-redBrick-600 hover:text-redBrick-100 rounded shadow-md"
                :class="{ 'bg-redBrick-600 text-redBrick-100': isTab === 'login' }" @click="isTab = 'login'">
                Login
            </button>
            <button type="button"
                class="w-1/2 py-2 px-6 text-center bg-gray-100 text-black hover:bg-redBrick-600 hover:text-redBrick-100 rounded shadow-md"
                :class="{ 'bg-redBrick-600 text-redBrick-100': isTab === 'register' }" @click="isTab = 'register'">
                Register
            </button>
        </div>
        <div x-show="isTab === 'login'">
            <h1 class="text-3xl md:text-xl font-bold text-center mb-4">
                {{ __('Login to your account') }}
            </h1>
            @livewire('auth.login')
        </div>
        <div x-show="isTab === 'register'">
            <h1 class="text-3xl md:text-xl font-bold text-center mb-4">
                {{ __('Register as') }}
            </h1>
            @livewire('auth.register')
        </div>
    </div>

    <div class="lg:w-1/2 sm:w-full relative pb-full md:flex md:pb-0">
        <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);"
            class="absolute pin bg-no-repeat md:bg-left w-full h-full bg-center bg-cover"></div>
    </div>
</div>
