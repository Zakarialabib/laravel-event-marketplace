<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\RaceResult;
use Livewire\Component;
use App\Http\Livewire\WithSorting;
use Livewire\WithPagination;

class TriathlonResults extends Component
{
    use WithSorting;
    use WithPagination;

    public $race;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortBy'        => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function mount($race): void
    {
        $this->race = $race;
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new RaceResult())->orderable;
    }

    public function calculateRank($result, $field): int
    {
        $sortedResults = $result->sortByDesc($field);

        return $sortedResults->pluck('id')->search($result->id) + 1;
    }

    public function calculateGenderRank($result, $field): int|float
    {
        $genderSortedResults = RaceResult::where('race_id', $this->race->id)
            ->where('gender', $result->participant->gender) // Use the corresponding field for each discipline
            ->orderBy($field)
            ->get();

        return $genderSortedResults->pluck('id')->search($result->id) + 1;
    }

    public function calculateOverallRank($results, $result): int|float
    {
        // Sort results based on time (or any other relevant criteria)
        $sortedResults = $results->orderBy('time');

        return $sortedResults->search(static function ($item) use ($result): bool {
            return $item->id === $result->id;
        }) + 1;
    }

    public function render()
    {
        $query = RaceResult::where('race_id', $this->race->id)
            ->with(['participant' => function ($query): void {
                $query->where('name', 'like', '%'.$this->search.'%');
            }])->advancedFilter([
                's'               => $this->search ?: null,
                'order_column'    => $this->sortBy,
                'order_direction' => $this->sortDirection,
            ]);

        $results = $query->paginate($this->perPage);

        return view('livewire.front.triathlon-results', ['results' => $results]);
    }
}
