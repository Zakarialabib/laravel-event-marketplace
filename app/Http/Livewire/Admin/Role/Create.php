<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Role;

// use App\Models\Permission;
use Spatie\Permission\Models\Permission;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public Role $role;

    public array $permissions = [];

    public array $listsForFields = [];

    protected $listeners = [
        'submit',
    ];

    public function mount(Role $role): void
    {
        $this->role = $role;
        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.role.create');
    }

    public function submit(): RedirectResponse
    {
        $this->validate();

        $this->role->save();

        $this->role->givePermissionTo($this->permissions);

        // $this->alert('success', __('Role created successfully!') );

        return redirect()->route('admin.roles.index');
    }

    protected function rules(): array
    {
        return [
            'role.title' => [
                'string',
                'required',
            ],
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*.id' => [
                'integer',
                'exists:permissions,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['permissions'] = Permission::pluck('title', 'id')->toArray();
    }
}
