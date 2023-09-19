<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\WithSorting;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $listeners = [
        'refreshIndex' => '$refresh', 'delete',
    ];

    public $showModal = false;

    public $user;

    public $role;

    public $filterRole;

    public $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $rules = [
        'user.name'       => 'required|string|max:255',
        'user.email'      => 'required|email|unique:users,email',
        'user.password'   => 'required|string|min:8',
        'user.phone'      => 'required|numeric',
        'user.city'       => 'nullable',
        'user.country'    => 'nullable',
        'user.address'    => 'nullable',
        'user.tax_number' => 'nullable',
    ];

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty(): int
    {
        return count($this->selected);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function filterRole($role): void
    {
        $this->filterRole = $role;
        $this->resetPage(); // Reset pagination to the first page
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new User())->orderable;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('user_access'), 403);

        $query = User::with('roles')->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        if ($this->filterRole === 'admin') {
            $query->where(function ($query): void {
                $query->whereHas('roles', function ($query): void {
                    $query->where('name', $this->filterRole);
                });
            });
        } elseif ($this->filterRole === 'client') {
            $query->where(function ($query): void {
                $query->whereHas('roles', function ($query): void {
                    $query->where('name', $this->filterRole);
                });
            });
        }

        $users = $query->paginate($this->perPage);

        return view('livewire.admin.users.index', ['users' => $users]);
    }

    // getrolesproperty
    public function getRolesProperty()
    {
        return Role::pluck('name', 'id');
    }

    // assign or change user role
    public function assignRole(User $user, $role): void
    {
        $user->assignRole($role);
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('user_delete'), 403);

        User::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(User $user): void
    {
        abort_if(Gate::denies('user_delete'), 403);

        $user->delete();

        $this->alert('warning', __('User deleted successfully!'));
    }

    public function showModal(User $user): void
    {
        $this->user = $user;

        $this->showModal = true;
    }
}
