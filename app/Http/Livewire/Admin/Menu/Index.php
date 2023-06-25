<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\WithSorting;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    
    public string $perPage = '100';

    protected $listeners = [
        'refreshIndex' => '$refresh'
    ];
    public $links = []; 
    public $menu;
    public $menus;
    public $name;
    public $label;
    public $url;
    public $type;
    public $placement;
    public $icon;
    public $parent_id;
    public $new_window;

    protected $rules = [
        'menus.*.name' => 'required',
        'menus.*.type' => 'required',
        'menus.*.placement' => 'nullable',
        'menus.*.label' => 'required',
        'menus.*.url' => 'required',
        'menus.*.icon' => 'nullable',
        'menus.*.parent_id' => 'nullable|exists:menus,id',
        'menus.*.new_window' => 'boolean',
    ];

    public function mount()
    {
        $this->menus = Menu::when($this->placement, function ($query) {
            $query->where('placement', $this->placement);
        })->orderBy('sort_order')
        ->get()->toArray();

        $this->links = [
            'Link 1',
            'Link 2',
            'Link 3',
            // Add more links as needed
        ];
        
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function filterByPlacement($value)
    {
        $this->placement = $value;
        $this->mount();
    }

    public function render()
    {
        $menus = Menu::when($this->placement, function ($query) {
            $query->where('placement', $this->placement);
        })->paginate($this->perPage);

        return view('livewire.admin.menu.index', compact('menus'))->extends('layouts.dashboard');
    }


    public function update($id)
    {
        try{ 
            $this->menu = Menu::find($id);
            
            $this->validate();

            foreach ($this->menus as $menu) {
                $this->menu = Menu::find($menu['id']);
                $this->menu->name = $menu['name'];
                $this->menu->label = $menu['label'];
                $this->menu->type = $menu['type'];
                $this->menu->placement = $menu['placement'];
                $this->menu->url = $menu['url'];
                $this->menu->icon = $menu['icon'];
                $this->menu->parent_id = $menu['parent_id'] ?? null;
                $this->menu->new_window = $menu['new_window'] ?? false;

                $this->menu->save();

            }
            $this->alert('success', __('Menu updated successfully.'));
        
            $this->reset(['name', 'label', 'url', 'type','icon', 'placement', 'parent_id', 'new_window']);
        } catch (\Throwable $th) {
            $this->alert('warning' , __('Something went wrong!').$th->getMessage());
        }
    }
    
    public function store()
    {

        try {
       
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'placement' => 'required',
            'label' => 'required',
            'url' => 'required',
            'parent_id' => 'nullable|exists:menus,id',
            'new_window' => 'boolean',
        ]);
    
        $menu = new Menu();
        $menu->name = $this->name;
        $menu->label = $this->label;
        $menu->type = $this->type;
        $menu->placement = $this->placement;
        $menu->url = $this->url;
        $menu->icon = $this->icon;
        $menu->parent_id = $this->parent_id ?? null;
        $menu->new_window = $this->new_window ?? false;
    
        $menu->save();
    
        $this->alert('success', __('Menu created successfully.'));
    
        $this->mount();
         } catch (\Throwable $th) {
            $this->alert('warning' , __('Something went wrong!').$th->getMessage());
        }
    }

    public function updateMenuOrder($ids)
    {
        try{
            foreach ($ids as $index => $id) {
                $menu = Menu::find($id);
                $menu->sort_order = $index + 1;
                $menu->save();
            }
            $this->alert('success', __('Menu order updated successfully.'));
            $this->mount();
        } catch (\Throwable $th) {
            $this->alert('warning' , __('Something went wrong!').$th->getMessage());
        }
    }
    
    public function predefinedMenu(): void
    {
        try {

            $this->menus = [
                [
                    'name' => 'Home',
                    'type' => 'route',
                    'label' => 'Home',
                    'url' => 'home',
                    'parent_id' => null,
                    'new_window' => false,
                ],
                [
                    'name' => 'About',
                    'type' => 'route',
                    'label' => 'About',
                    'url' => 'about',
                    'parent_id' => null,
                    'new_window' => false,
                ],
                [
                    'name' => 'Contact',
                    'type' => 'route',
                    'label' => 'Contact',
                    'url' => 'contact',
                    'parent_id' => null,
                    'new_window' => false,
                ],
                [
                    'name' => 'Login',
                    'type' => 'route',
                    'label' => 'Login',
                    'url' => 'login',
                    'parent_id' => null,
                    'new_window' => false,
                ],
                [
                    'name' => 'Register',
                    'type' => 'route',
                    'label' => 'Register',
                    'url' => 'register',
                    'parent_id' => null,
                    'new_window' => false,
                ],
            ];
            // create the menus
            foreach ($this->menus as $menu) {
                Menu::create($menu);
            }
            $this->mount();
            $this->alert('success', __('Predefined menus created successfully.'));
        } catch (\Throwable $th) {
            $this->alert('warning' , __('Something went wrong!').$th->getMessage());
        }
    }

    public function delete(Menu $menu)
    {
        // abort_if(Gate::denies('menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->delete();
        $this->mount();
        $this->alert('success', __('Menu deleted successfully.'));
    }


}
