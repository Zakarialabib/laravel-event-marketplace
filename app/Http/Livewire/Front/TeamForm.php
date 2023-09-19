<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Participant;
use App\Mail\TeamInvitationMail;
use App\Enums\Status;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TeamForm extends Component
{
    use LivewireAlert;
    public $team;

    public $openTeamModal = false;

    public $name;

    public $enterPassword = false;

    public $teamPassword = '';

    public $resultTeam = '';

    public $invitationEmails = [''];

    public $isTeamRegistration = false;

    protected $rules = [
        'name'     => 'required|string|min:3|max:50',
        'password' => 'nullable|string|min:3|max:50',
    ];

    protected $listeners = [
        'openTeamModal',
    ];

    public function updatedIsTeamRegistration($value): void
    {
        $this->isTeamRegistration = $value;
    }

    public function attemptJoinWithPassword(): void
    {
        if (Hash::check($this->teamPassword, $this->team->password)) {
            $this->joinTeam();
        } else {
            $this->alert('error', 'Incorrect password. Please try again.');
        }
    }

    public function getTeamsProperty()
    {
        return Team::select('name', 'id')->get();
    }

    public function updatedName(): void
    {
        if (strlen((string) $this->name) > 3) {
            $this->resultTeam = Team::where('name', 'like', '%'.$this->name.'%')
                ->limit(5)
                ->get();
        } else {
            $this->resultTeam = [];
        }
    }

    public function openTeamModal(): void
    {
        $this->openTeamModal = true;
    }

    public function createTeam(): void
    {
        $participant = $this->getParticipantForAuthenticatedUser();

        if ( ! $participant) {
            $this->alert('error', 'Participant not found. Please register for the race.');

            return;
        }

        $this->team = Team::where('name', $this->name)->first();

        if ( ! $this->team) {
            $this->team = Team::create([
                'name'      => $this->name,
                'leader_id' => Auth::id(),
            ]);
        }

        $existingMembership = TeamMember::where('participant_id', $participant->id)->first();

        if ($existingMembership) {
            $this->alert('error', 'You are already a member of a team for this race.');

            return;
        }

        TeamMember::create([
            'team_id'           => $this->team->id,
            'participant_id'    => $participant->id,
            'invitation_emails' => $this->invitationEmails,
            'status'            => Status::PENDING,
        ]);

        foreach ($this->invitationEmails as $email) {
            Mail::to($email)->later(now()->addMinutes(10), new TeamInvitationMail($this->team, $participant));
        }

        $this->openTeamModal = false;
        $this->alert('success', 'Team created successfully and invites sent!');
    }

    public function joinTeam(): void
    {
        $participant = $this->getParticipantForAuthenticatedUser();

        if ( ! $participant) {
            $this->alert('error', 'Participant not found. Please register for the race.');

            return;
        }

        $existingMembership = TeamMember::where('team_id', $this->team->id)
            ->where('participant_id', $participant->id)
            ->first();

        if ($existingMembership) {
            $this->alert('error', 'You are already a member of this team.');

            return;
        }

        TeamMember::create([
            'team_id'        => $this->team->id,
            'participant_id' => $participant->id,
            'status'         => Status::PENDING,
        ]);

        $this->alert('success', 'Successfully joined the team!');
    }

    private function getParticipantForAuthenticatedUser()
    {
        return Participant::where('user_id', Auth::id())->first();
    }

    public function addMoreEmailFields(): void
    {
        $this->invitationEmails[] = '';
    }

    public function removeEmailField($index): void
    {
        unset($this->invitationEmails[$index]);
        $this->invitationEmails = array_values($this->invitationEmails); // Re-index the array
    }

    public function selectTeam($teamId): void
    {
        $this->team = Team::find($teamId);

        if ($this->team->password) {
            $this->enterPassword = true;
        } else {
            $this->joinTeam();
        }
    }

    public function render()
    {
        return view('livewire.front.team-form');
    }
}
