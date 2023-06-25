<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Menu extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id', 'name', 'type','status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name','label','url','type','sort_order','placement',
        'parent_id','new_window','icon','status'
    ];

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
