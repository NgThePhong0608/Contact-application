<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait AllowedFilterSearch
{
    public function scopeAllowedFilters(Builder $query, ...$keys)
    {
        foreach ($keys as $key) {
            if ($value = request()->query($key)) {
                $query->where($key, $value);
            }
        }
        return $query;
    }

    public function scopeAllowedSearch(Builder $query,  ...$keys)
    {
        $search_value = trim(request()->query('search'));
        if ($search_value) {
            foreach ($keys as $key => $value) {
                $method = $key === 0 ? 'where' : 'orWhere';
                $query->{$method}($value, 'LIKE', "%{$search_value}%");
            }
        }
        return $query;
    }

    public function scopeAllowedTrashed(Builder $query)
    {
        if (request()->query('trash')) {
            return $query->onlyTrashed();
        }
        return $query;
    }
}