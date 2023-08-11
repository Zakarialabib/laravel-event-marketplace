<div>
    @section('title', __('Login & Register'))
    <section x-data="{ isTab: 'login' }" class="py-24 px-10 bg-gray-100 h-auto my-auto flex justify-Pcemter items-center">
        <div class="max-w-full w-full px-10">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-50 border-0">
                <div class="px-6 py-6">
                    <div class="w-full flex justify-between border-collapse px-4 mb-3">
                        <button type="button" @click="isTab = 'login'"
                            :class="{ 'border-b-2 border-blue-500 text-blue-500': isTab === 'login' }"
                            class="w-full border border-gray-800 py-2 px-4 text-gray-600 hover:text-gray-800 focus:text-gray-800 text-sm font-bold border-b-2 transition-all">
                            {{ __('Login') }}
                        </button>
                        <button type="button" @click="isTab = 'register'"
                            :class="{ 'border-b-2 border-blue-500 text-blue-500': isTab === 'register' }"
                            class="w-full border border-gray-800 py-2 px-4 text-gray-600 hover:text-gray-800 focus:text-gray-800 text-sm font-bold border-b-2 transition-all">
                            {{ __('Register') }}
                        </button>
                    </div>
                    <div class="w-full flex flex-wrap gap-6 justify-center mb-6">
                        <a class="bg-white active:bg-gray-100 text-gray-800 px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                            href="{{ route('login.facebook') }}">
                            <span class="mr-1">
                                <img alt="..." class="w-5 mr-1" src="{{ asset('images/login/facebook.svg') }}">
                            </span>
                            <p>{{ __('Login with Facebook') }}</p>
                        </a>
                        <a class="bg-white active:bg-gray-100 text-gray-800 px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                            href="{{ route('login.google') }}">
                            <span class="mr-1">
                                <img alt="..." class="w-5 mr-1" src="{{ asset('images/login/google.svg') }}">
                            </span>
                            <p>{{ __('Login with Google') }}</p>
                        </a>
                    </div>

                    <div x-show="isTab === 'login'" id="login">
                        <div class="flex-auto px-4 lg:px-10 pb-2 pt-4">
                            <div class="text-gray-500 text-center mb-3 font-bold uppercase text-xl">
                                <small>{{ __('Or sign in with credentials') }}</small>
                            </div>
                        </div>
                        @livewire('auth.login')
                    </div>
                    <div x-show="isTab === 'register'" id="register">
                        <div class="flex-auto px-4 lg:px-10 pb-2 pt-4">
                            <div class="text-gray-500 text-center mb-3 font-bold uppercase text-xl">
                                <small>{{ __('Registration') }}</small>
                            </div>
                        </div>
                        @livewire('auth.register')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
