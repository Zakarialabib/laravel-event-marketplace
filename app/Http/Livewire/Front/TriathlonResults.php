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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function mount($race)
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
        $rank = $sortedResults->pluck('id')->search($result->id) + 1;

        return $rank;
    }

    public function calculateGenderRank($result, $field)
    {
        $genderSortedResults = RaceResult::where('race_id', $this->race->id)
            ->where('gender', $result->participant->gender) // Use the corresponding field for each discipline
            ->sortBy($field)
            ->get();

        $genderRank = $genderSortedResults->pluck('id')->search($result->id) + 1;

        return $genderRank;
    }

    public function calculateOverallRank($results, $result)
    {
        // Sort results based on time (or any other relevant criteria)
        $sortedResults = $results->sortBy('time');

        $overallRank = $sortedResults->search(function ($item) use ($result) {
            return $item->id === $result->id;
        }) + 1;

        return $overallRank;
    }

    public function render()
    {
        $query = RaceResult::where('race_id', $this->race->id)
            ->with(['participant' => function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            }])->advancedFilter([
                's'               => $this->search ?: null,
                'order_column'    => $this->sortBy,
                'order_direction' => $this->sortDirection,
            ]);

        $results = $query->paginate($this->perPage);

        return view('livewire.front.triathlon-results', compact('results'));
    }
}
