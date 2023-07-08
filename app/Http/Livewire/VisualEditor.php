<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class VisualEditor extends Component
{
    public $components = [];

    public $logoUrl = '';

    public $menuItems = [];
    public $cardContent = [];
    public $listItems = [];
    public $headerSettings = [];
    public $footerSettings = [];
    public $accordionItems = [];
    public $tabItems = [];

    public $themeColor = [];

    public $title = 'page';

    public $colorOptions = [];

    public $colors;

    public $selectedColor;

    public $breadcrumbsSettings = [];
    public $pageLoaderSettings = [];

    protected $listeners = ['addComponent'];

    public function mount()
    {
        $this->components = [
            'listItems' => array_map(function ($item) {
                return ['itemText' => $item['itemText']];
            }, $this->listItems),
            'tabItems' => array_map(function ($item) {
                return [
                    'title'   => $item['title'],
                    'content' => $item['content'],
                ];
            }, $this->tabItems),
            'accordionItems' => array_map(function ($item) {
                return [
                    'title'   => $item['title'],
                    'content' => $item['content'],
                ];
            }, $this->accordionItems),
            'textContent' => [],
            'cardContent' => [],
            'layout'      => [
                'columns' => 2,
                'rows'    => 1,
                'content' => [],
            ],
            'sections' => [],
            'videos'   => [],
        ];
        $this->headerSettings = [
            'numberOfColumns' => 1,
            'headerHeight'    => 100,
            'logoUrl'         => null,
            'logoSize'        => 50,
            'logoPosition'    => 'left',
            'hasSearchIcon'   => false,
            'searchIcon'      => null,
        ];

        $this->footerSettings = [
            'numberOfColumns'    => 1,
            'headerHeight'       => 100,
            'logoUrl'            => null,
            'logoSize'           => 50,
            'logoPosition'       => 'left',
            'hasNewslettersForm' => false,
        ];

        $this-> breadcrumbsSettings = [
            'isCentered' => true,
            'isSimple'   => false,
        ];

        $this-> pageLoaderSettings = [
            'backgroundColor' => '#ffffff',
            'color'           => '#000000',
            'customLoader'    => null,
        ];

        $this->colors = ['gray', 'red', 'green', 'blue', 'indigo'];
        $this->colorOptions = [100, 200, 300, 400, 500, 600, 700, 800, 900];
        $this->selectedColor = 'gray';
    }

    public function selectedColor($color)
    {
        $this->themeColor = $color;
    }

    public function selectedColors($index, $color)
    {
        $selectedColors = $this->themeColor;

        // Check if the selected color already exists in the array
        $colorExists = array_filter($selectedColors, function ($value) use ($color) {
            return $value == $this->selectedColor.'-'.$color;
        });

        // If the selected color does not exist, add it to the array
        if (empty($colorExists)) {
            // If there are already 8 colors in the array, remove the first one
            if (count($selectedColors) == 8) {
                array_shift($selectedColors);
            }

            // Add the selected color to the end of the array
            $selectedColors[] = $this->selectedColor.'-'.$color;
        }

        // Update the selectedColors property
        $this->themeColor = array_map(function ($index, $value) {
            return [$index => $value];
        }, array_keys($selectedColors), $selectedColors);
    }

    public function addTextContent()
    {
        $this->components['textContent'][] = [
            'textContent' => '',
        ];
    }

    public function addLogo($logoUrl)
    {
        $this->components['logo'] = $logoUrl;
    }

    public function addComponent($type, $props = [])
    {
        $component = [
            'type'     => $type,
            'props'    => $props,
            'children' => [],
        ];

        array_push($this->components, $component);
    }

    public function addLayout()
    {
        $this->components['layout'] = [
            'columns' => 2,
            'rows'    => 1,
            'content' => [],
        ];
    }

    public function addSection($bgColor = null)
    {
        $this->components['sections'][] = [
            'bgColor' => $bgColor,
            'content' => [],
        ];
    }

    public function addColumn($width = 1)
    {
        $this->components['layout']['content'][] = [
            'type'    => 'column',
            'width'   => $width,
            'content' => [],
        ];
    }

    public function addVideo($url = '', $autoplay = false)
    {
        $this->components['videos'][] = [
            'url'      => $url,
            'autoplay' => $autoplay,
        ];
    }

    public function saveBreadcrumbs()
    {
        $breadcrumbs = [
            'type'  => $this->breadcrumbType,
            'image' => ($this->breadcrumbType == 'image') ? $this->breadcrumbImage : null,
        ];

        // Save the values to the breadcrumbsSettings component
        $this->breadcrumbsSettings = $breadcrumbs;
    }

    public function saveLoader()
    {
        $loader = [
            'backgroundColor' => $this->pageLoaderSettings['backgroundColor'],
            'color'           => $this->pageLoaderSettings['color'],
            'customLoader'    => $this->pageLoaderSettings['customLoader'],
        ];

        // Save the values to the pageLoaderSettings component
        $this->pageLoaderSettings = $loader;
    }

    // Menu manipulation
    public function addMenu()
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

    public function removeMenu($index)
    {
        unset($this->menuItems[$index]);
        $this->menuItems = array_values($this->menuItems);
    }

    public function addMenuItem($index)
    {
        $this->menuItems[$index]['items'][] = [
            'label' => '',
            'url'   => '',
        ];
    }

    public function removeMenuItem($menuIndex, $itemIndex)
    {
        unset($this->menuItems[$menuIndex]['items'][$itemIndex]);
        $this->menuItems[$menuIndex]['items'] = array_values($this->menuItems[$menuIndex]['items']);
    }

    public function saveMenuItems()
    {
        foreach ($this->menuItems as $index => $menu) {
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
    public function saveHeaderSettings()
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
    public function saveFooterSettings()
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

    public function addCardContent()
    {
        $this->cardContent[] = [
            'cardImage'      => '',
            'cardTitle'      => '',
            'cardText'       => '',
            'cardButtonText' => '',
            'cardButtonLink' => '',
            'cardBgColor'    => '',
            'cardTextColor'  => '',
            'cardSize'       => '',
        ];
    }

    public function saveCardContent()
    {
        $this->cardContent = array_map(function ($item) {
            return [
                'cardImage'      => $item['cardImage'],
                'cardTitle'      => $item['cardTitle'],
                'cardText'       => $item['cardText'],
                'cardButtonText' => $item['cardButtonText'],
                'cardButtonLink' => $item['cardButtonLink'],
                'cardBgColor'    => $item['cardBgColor'],
                'cardTextColor'  => $item['cardTextColor'],
                'cardSize'       => $item['cardSize'],
            ];
        }, $this->cardContent);
    }

    public function removeCardContent($itemIndex)
    {
        unset($this->cardContent[$itemIndex]);
        $this->cardContent = array_values($this->cardContent);
    }

    // accordion items manipulation
    public function addAccordionItem()
    {
        $this->components['accordionItems'][] = [
            'title'   => '',
            'content' => '',
        ];
    }

    public function saveAccordionItems()
    {
        $this->components['accordionItems'] = array_map(function ($item) {
            return [
                'title'   => $item['title'],
                'content' => $item['content'],
            ];
        }, $this->components['accordionItems']);
    }

    public function removeAccordionItem($itemIndex)
    {
        unset($this->components['accordionItems'][$itemIndex]);
        $this->components['accordionItems'] = array_values($this->components['accordionItems']);
    }

    // tab items manipulation
    public function addTabItem()
    {
        $this->components['tabItems'][] = [
            'title'   => '',
            'content' => '',
        ];
    }

    public function saveTabItems()
    {
        $this->components['tabItems'] = array_map(function ($item) {
            return [
                'title'   => $item['title'],
                'content' => $item['content'],
            ];
        }, $this->components['tabItems']);
    }

    public function removeTabItem($itemIndex)
    {
        unset($this->components['tabItems'][$itemIndex]);
        $this->components['tabItems'] = array_values($this->components['tabItems']);
    }

    // list items manipulation
    public function addListItem()
    {
        $this->components['listItems'][] = [
            'itemText' => '',
        ];
    }

    public function saveListItems()
    {
        $this->listItems = array_map(function ($item) {
            return ['itemText' => $item['itemText']];
        }, $this->components['listItems']);
    }

    public function removeListItem($index)
    {
        unset($this->components['listItems'][$index]);
        $this->components['listItems'] = array_values($this->components['listItems']);
    }

    public function removeComponent($componentIndex): void
    {
        unset($this->components[$componentIndex]);
        $this->components = array_values($this->components);
    }

    public function removeCard($cardIndex): void
    {
        unset($this->cardContent[$cardIndex]);
        $this->cardContent = array_values($this->cardContent);
    }

    public function removeTextContent($itemIndex): void
    {
        $this->textContent[$itemIndex] = '';
        unset($this->textContent[$itemIndex]);
    }

    public function removeLogo()
    {
        $this->logoUrl = '';
        unset($this->logoUrl);
    }

    public function removeColor($index)
    {
        unset($this->themeColor[$index]);
    }

    public function createPage()
    {
        // Convert the components data to a string
        $components = json_encode([
            'cardContent' => $this->cardContent,
            'menuItems'   => $this->menuItems,
            // Add other components data here...
        ]);
        $name = Str::snake($this->title);
        $content = '';

        foreach (json_decode($components, true) as $component) {
            $content .= '<x-'.$component['type'].' ';

            foreach ($component['attributes'] as $key => $value) {
                $content .= $key.'="'.$value.'" ';
            }

            $content .= '>'.PHP_EOL;

            if ( ! empty($component['slot'])) {
                $content .= '{{ $'.$component['slot'].' }}';
            }

            $content .= '</x-'.$component['type'].'>'.PHP_EOL;
        }

        File::put(resource_path('views/pages/'.$name.'.blade.php'), $content);
    }

    public function store()
    {
        // Pagesettings::find(1);
        // $this->menuWidget =
    }

    public function render(): View
    {
        return view('livewire.visual-editor');
    }
}
