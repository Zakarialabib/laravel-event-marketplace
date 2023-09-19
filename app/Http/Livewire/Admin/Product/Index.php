<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Enums\Status;
use App\Exports\ProductExport;
use App\Http\Livewire\WithSorting;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithFileUploads;
    use LivewireAlert;

    public $product;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'promoAllProducts',
        'delete', 'downloadAll',
        'exportAll',
    ];

    public $selectType;

    public $filterStore;

    public $promoAllProducts = false;

    public $percentage;

    public $copyPriceToOldPrice = false;

    public $copyOldPriceToPrice = false;

    public $percentageMethod;

    public int $perPage;

    public $refreshIndex;

    public array $orderable;

    public $selectAll;

    public $file;

    public float $price;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

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

    public function selectStore($storeId): void
    {
        $this->filterStore = $storeId;
        $this->resetPage(); // Reset pagination to the first page
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
        $this->file = null;
        $this->selectType = 'category_id';
    }

    public function render(): View|Factory
    {
        $query = Product::with(['category' => static function ($query): void {
            $query->select('id', 'name');
        },
        ])->select('products.*')->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])
            ->when($this->filterStore, function ($query) {
                return $query->where('user_id', $this->filterStore);
            });

        $products = $query->paginate($this->perPage);

        return view('livewire.admin.product.index', ['products' => $products])->extends('layouts.dashboard');
    }

    public function delete(Product $product): void
    {
        abort_if(Gate::denies('product_delete'), 403);

        $product->delete();

        $this->alert('success', __('Product deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('product_delete'), 403);

        Product::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function selectAll(): void
    {
        if (count(array_intersect($this->selected, Product::pluck('id')->toArray())) === count(Product::pluck('id')->toArray())) {
            $this->selected = [];
        } else {
            $this->selected = Product::pluck('id')->toArray();
        }
    }

    public function selectPage(): void
    {
        if (count(array_intersect($this->selected, Product::paginate($this->perPage)->pluck('id')->toArray())) === count(Product::paginate($this->perPage)->pluck('id')->toArray())) {
            $this->selected = [];
        } else {
            $this->selected = array_intersect($this->selected, Product::paginate($this->perPage)->pluck('id')->toArray());
        }
    }

    // Product  Clone
    public function clone(Product $product): void
    {
        $product_details = Product::find($product->id);
        // dd($product_details);
        Product::create([
            'code'             => $product_details->code,
            'slug'             => $product_details->slug,
            'name'             => $product_details->name,
            'price'            => $product_details->price,
            'description'      => $product_details->description,
            'meta_title'       => $product_details->meta_title,
            'meta_description' => $product_details->meta_description,
            'category_id'      => $product_details->category_id,
            'subcategories'    => $product_details->subcategories,
            'brand_id'         => $product_details->brand_id,
            'status'           => Status::INACTIVE,
        ]);

        $this->alert('success', __('Product Cloned successfully!'));
    }

    public function promoAllProducts(): void
    {
        $this->promoAllProducts = true;
    }

    public function updateSelected(): void
    {
        $products = Product::whereIn('id', $this->selected)->get();

        foreach ($products as $product) {
            if ($this->copyPriceToOldPrice) {
                $product->discount_price = $product->price;
            } elseif ($this->copyOldPriceToPrice) {
                $product->price = $product->discount_price;
                $product->discount_price = null;
            } elseif ($this->percentageMethod === '+') {
                $product->price = round((float) $product->price * (1 + $this->percentage / 100));
            } else {
                $product->price = round((float) $product->price * (1 - $this->percentage / 100));
            }

            $product->save();
        }

        $this->alert('success', __('Product Prices changed successfully!'));

        $this->resetSelected();

        $this->promoAllProducts = false;

        $this->copyPriceToOldPrice = '';
        $this->copyOldPriceToPrice = '';
        $this->percentage = '';
    }

    public function downloadSelected()
    {
        $products = Product::whereIn('id', $this->selected)->get();

        return (new ProductExport($products))->download('products.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function downloadAll(Product $products)
    {
        return (new ProductExport($products))->download('products.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function exportSelected(): BinaryFileResponse
    {
        return $this->callExport()->forModels($this->selected)->download('products.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }

    public function exportAll(): BinaryFileResponse
    {
        return $this->callExport()->download('products.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }

    private function callExport(): ProductExport
    {
        return new ProductExport();
    }
}
