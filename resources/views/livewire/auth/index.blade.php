<div>
    <section x-data="{ isTab: 'login' }" class="w-screen ">
        <div class="flex flex-col justify-center items-center py-24"
            style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);background-position: center center;background-size: fill;">
            <div class="w-full lg:w-6/12 sm:w-8/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-50 border-0">
                    <div class="px-6 py-6">
                        <div class="container flex justify-between mb-3">
                            <button type="button" @click="isTab = 'login'">
                                <h6 class="text-gray-600 hover:text-gray-800 focus:text-gray-800 text-sm font-bold">
                                    {{ __('Login') }}
                                </h6>
                            </button>
                            <button type="button" @click="isTab = 'register'">
                                <h6 class="text-gray-600 hover:text-gray-800 focus:text-gray-800 text-sm font-bold">
                                    {{ __('Register') }}
                                </h6>
                            </button>
                        </div>
                        <div class="w-full flex flex-wrap gap-6 justify-center mb-6">
                            @if ($isStoreOwner)
                                <a class="bg-white active:bg-gray-100 text-gray-800 px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                                    href="{{ route('login.facebook') }}">
                                    <span class="mr-1">
                                        <img alt="..." class="w-5 mr-1"
                                            src="{{ asset('images/login/facebook.svg') }}">
                                    </span>
                                    <p>{{ __('Login with Facebook') }}</p>
                                </a>
                                <a class="bg-white active:bg-gray-100 text-gray-800 px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                                    href="{{ route('login.google') }}">
                                    <span class="mr-1">
                                        <img alt="..." class="w-5 mr-1"
                                            src="{{ asset('images/login/google.svg') }}">
                                    </span>
                                    <p>{{ __('Login with Google') }}</p>
                                </a>
                            @endif
                        </div>
                        <div x-show="isTab === 'login'" id="login">
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <div class="text-gray-500 text-center mb-3 font-bold uppercase text-xl">
                                    <small>{{ __('Or sign in with credentials') }}</small>
                                </div>
                            </div>
                            @livewire('auth.login')
                        </div>
                        <div x-show="isTab === 'register'" id="register">
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <div class="text-gray-500 text-center mb-3 font-bold">
                                    <small>{{ __('Register as') }}</small>
                                </div>
                            </div>
                            @livewire('auth.register')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
