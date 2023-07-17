<div>
    @section('title', __('My Account'))

    <section class="py-5 px-4 bg-gray-100">
        <div class="table w-full py-5">
            <div class="mt-12 flex" x-data="{ activeTab: 'account' }">
                <div class="w-1/4">
                    <ul class="flex flex-col space-y-2 bg-white py-4">
                        <li @click="activeTab = 'account'"
                            :class="{ 'bg-green-500 text-white': activeTab === 'account' }"
                            class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors cursor-pointer">
                            {{ __('Account Info') }}
                        </li>
                        <li @click="activeTab = 'registration'"
                            :class="{ 'bg-green-500 text-white': activeTab === 'registration' }"
                            class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors cursor-pointer">
                            {{ __('Registrations Info') }}
                        </li>
                        <li @click="activeTab = 'participation'"
                            :class="{ 'bg-green-500 text-white': activeTab === 'participation' }"
                            class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors cursor-pointer">
                            {{ __('Participations Infos') }}
                        </li>
                    </ul>
                </div>
                <div class="w-3/4 px-6 pb-6">

                    <div x-show="activeTab === 'account'" class="w-full">
                        @livewire('account.user-infos', ['user' => $user])
                    </div>

                    <div x-show="activeTab === 'registration'" class="w-full">
                        @livewire('account.registration-infos', ['participant' => $participant])
                    </div>

                    <div x-show="activeTab === 'participation'" class="w-full">
                        @livewire('account.participant-infos', ['participant' => $participant])
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
