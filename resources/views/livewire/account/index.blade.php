<div>
    @section('title', __('My account'))

    <section class="py-24 px-4 bg-gray-100 h-auto my-auto flex items-center">
        <div class="w-full py-10 mx-4 mt-12 flex bg-white" x-data="{ activeTab: 'account' }">
            <div class="w-1/4">
                <ul class="flex flex-col space-y-2 bg-white py-4">
                    <li @click="activeTab = 'account'" :class="{ 'bg-green-500 text-white': activeTab === 'account' }"
                        class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors cursor-pointer">
                        {{ __('Account Info') }}
                    </li>
                    @isset($participant?->id)
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
                    @endisset
                    <li @click="activeTab = 'orders'" :class="{ 'bg-green-500 text-white': activeTab === 'orders' }"
                        class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors cursor-pointer">
                        {{ __('Orders') }}
                    </li>
                    <li @click="activeTab = 'raceResults'" :class="{ 'bg-green-500 text-white': activeTab === 'raceResults' }"
                        class="px-4 py-2 w-full text-left text-green-800 hover:bg-green-500 hover:text-white transition-colors cursor-pointer">
                        {{ __('Race results') }}
                    </li>
                    
                </ul>
            </div>
            <div class="w-3/4 px-6 pb-6">

                <div x-show="activeTab === 'account'" class="w-full">
                    @livewire('account.user-infos', ['user' => $user])
                </div>

                @isset($participant->id)
                <div x-show="activeTab === 'registration'" class="w-full">
                    @livewire('account.registration-infos', ['participant' => $participant])
                </div>

                <div x-show="activeTab === 'participation'" class="w-full">
                    @livewire('account.participant-infos', ['participant' => $participant])
                </div>
                @endisset

                <div x-show="activeTab === 'orders'" class="w-full">
                    @livewire('account.orders')
                </div>
               
                <div x-show="activeTab === 'raceResults'" class="w-full">
                    @livewire('account.race-results', ['participant' => $participant])
                </div>
            </div>
        </div>
    </section>
</div>
