<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Pagesetting;
use App\Http\Livewire\WithSorting;
use Livewire\WithPagination;

class Settings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithSorting;

    public $headerSettings;

    public $footerSettings;

    public $themeColor;

    public $popularProducts;

    public $flashDeal;

    public $bestSellers;

    public $topBrands;

    public $selectedColor;

    public $status;

    public $menuItems;

    public $featured_banner_id;

    public $page_id;

    public $language_id;

    public $settings;

    public $createSettingsModal = false;

    public $showHeaderModal = false;

    public $showFooterModal = false;

    public $topHeaderModal = false;

    public $bottomFooterModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

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

    // Menu manipulation
    public function addMenu(): void
    {
        $this->menuItems[] = [
            'menuName' => '',
            'items'    => [
                [
                    'label' => '',
                    'url'   => '',
                ],
            ],
        ];
    }

    public function removeMenu($index): void
    {
        unset($this->menuItems[$index]);
        $this->menuItems = array_values($this->menuItems);
    }

    public function addMenuItem($index): void
    {
        $this->menuItems[$index]['items'][] = [
            'label' => '',
            'url'   => '',
        ];
    }

    public function removeMenuItem($menuIndex, $itemIndex): void
    {
        unset($this->menuItems[$menuIndex]['items'][$itemIndex]);
        $this->menuItems[$menuIndex]['items'] = array_values($this->menuItems[$menuIndex]['items']);
    }

    public function saveMenuItems(): void
    {
        foreach ($this->menuItems as $menu) {
            $menuName = $menu['menuName'];

            foreach ($menu['items'] as $item) {
                $label = $item['label'];
                $url = $item['url'];
            }
        }
    }

    public function usePredefinedMenu(): void
    {
        $this->menuItems[] = [
            'menuName' => 'Main Menu',
            'items'    => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'About', 'url' => '/about'],
                ['label' => 'Contact', 'url' => '/contact'],
            ],
        ];
    }

    // Header settings
    public function saveHeaderSettings(): void
    {
        $column = [
            'numberOfColumns' => $this->headerSettings['numberOfColumns'],
            'headerHeight'    => $this->headerSettings['headerHeight'],
            'logoUrl'         => $this->headerSettings['logoUrl'],
            'logoSize'        => $this->headerSettings['logoSize'],
            'logoPosition'    => $this->headerSettings['logoPosition'],
            'hasSearchIcon'   => $this->headerSettings['hasSearchIcon'],
            'searchIcon'      => $this->headerSettings['searchIcon'],
        ];

        // Save the values to the headerLayout component
        $this->headerSettings[] = $column;
    }

    // Footer settings
    public function saveFooterSettings(): void
    {
        $column = [
            'numberOfColumns' => $this->footerSettings['numberOfColumns'],
            'footerHeight'    => $this->footerSettings['footerHeight'],
            'hasSocialIcons'  => $this->footerSettings['hasSocialIcons'],
            'socialIcons'     => $this->footerSettings['socialIcons'],
        ];

        // Save the values to the footerLayout component
        $this->footerSettings[] = $column;
    }

    public function updatePagesettings($id): void
    {
        $this->settings = Pagesetting::where('page_id', $id)->first();

        $this->validate([
            'header'             => 'nullable|string',
            'footer'             => 'nullable|string',
            'themeColor'         => 'nullable|string',
            'popularProducts'    => 'nullable|string',
            'flashDeal'          => 'nullable|string',
            'bestSellers'        => 'nullable|string',
            'topBrands'          => 'nullable|string',
            'status'             => 'nullable|string',
            'featured_banner_id' => 'nullable|string',
            'page_id'            => 'nullable|string',
            'language_id'        => 'nullable|string',

        ]);

        $this->settings->save();

        $this->alert('success', 'Settings updated successfully.');
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Pagesetting())->orderable;
    }

    public function render()
    {
        $query = Pagesetting::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $pagesettings = $query->paginate($this->perPage);

        return view('livewire.admin.page.settings', ['pagesettings' => $pagesettings]);
    }

    public function selectedColor($color): void
    {
        $this->themeColor = $color;
    }

    public function selectedColors($index, string $color): void
    {
        $selectedColors = $this->themeColor;

        // Check if the selected color already exists in the array
        $colorExists = array_filter($selectedColors, function ($value) use ($color): bool {
            return $value == $this->selectedColor.'-'.$color;
        });

        // If the selected color does not exist, add it to the array
        if ($colorExists === []) {
            // If there are already 8 colors in the array, remove the first one
            if (count($selectedColors) == 8) {
                array_shift($selectedColors);
            }

            // Add the selected color to the end of the array
            $selectedColors[] = $this->selectedColor.'-'.$color;
        }

        // Update the selectedColors property
        $this->themeColor = array_map(static function ($index, $value): array {
            return [$index => $value];
        }, array_keys($selectedColors), $selectedColors);
    }
}
