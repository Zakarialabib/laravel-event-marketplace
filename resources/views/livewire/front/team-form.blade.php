<div>
    <div class="mb-4 px-6">
        <label class="block mb-2 font-bold font-heading text-gray-700">Search for team Name</label>
        <input type="text" wire:model.debounce.300ms="name" placeholder="search team name"
            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200">
        @if (!empty($resultTeam))
            <ul class="mt-2 space-y-1">
                @foreach ($this->teams as $team)
                    <li x-show="!selectedTeam" class="px-3 py-1 hover:bg-gray-200 cursor-pointer">
                        {{ $team->name }}
                        <button wire:click="selectTeam('{{ $team->id }}')">Join</button>
                    </li>
                @endforeach
            </ul>
            @if ($enterPassword)
                <label class="block mb-2 font-bold font-heading text-gray-700">Enter Team Password</label>
                <x-input id="teamPassword" type="password" wire:model.defer="teamPassword" required />
                <button wire:click="attemptJoinWithPassword">Join</button>
            @endif
        @else
            <div class="mt-2 space-y-1">
                <x-button primary type="button" wire:click="openTeamModal">
                    {{ __('Create new team') }}
                </x-button>
            </div>
        @endif
    </div>

    <x-modal wire:model="openTeamModal">
        <x-slot name="title">
            <h2 class="text-lg font-bold">{{ __('Create Team') }}</h2>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="createTeam">
                <div class="mb-4 px-6">
                    <x-label for="password" :value="__('Team Name')" />
                    <x-input type="text" wire:model.defer="name" id="name"
                        placeholder="Enter new team name" />
                </div>
                <div class="mb-4 px-6">
                    <x-label for="password" :value="__('People will need to enter a password to join the Team')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                        wire:model.defer="password" required />
                </div>
                <div class="mb-4 px-6">
                    <label class="block mb-2 font-bold font-heading text-gray-700">Invite Team Members by
                        Email</label>

                    @foreach ($invitationEmails as $index => $email)
                        <div class="mb-2 flex justify-center">
                            @if ($index === 0)
                                <button wire:click="addMoreEmailFields" type="button"
                                    class="px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-r-md focus:outline-none">
                                    + Add More
                                </button>
                            @endif
                        </div>
                        <div class="mb-2 relative rounded-md shadow-sm">
                            <input wire:model.defer="invitationEmails.{{ $index }}" type="email"
                                placeholder="Enter email address"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <button wire:click="removeEmailField({{ $index }})" type="button"
                                    class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-r-md focus:outline-none">
                                    Remove
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
