<?php

namespace App\Models;

use App\Models\Scopes\SimpleSoftDelete;
use App\Models\Scopes\SimpleSoftDeleteScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'address', 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function scopeSortByNameAlpha(Builder $query)
    {
        return $query->orderBy('first_name');
    }

    public function scopeFilterByCompany(Builder $query)
    {
        $companyId = request()->query('company_id');
        if ($companyId) {
            $query->where('company_id', $companyId);
        }
        return $query;
    }

    public function scopeWithFilter(Builder $query)
    {
        $search_value = trim(request()->query('search'));
        if ($search_value) {
            $query->where('first_name', 'LIKE', "%{$search_value}%")
                ->orWhere('last_name', 'LIKE', "%{$search_value}%")
                ->orWhere('address', 'LIKE', "%{$search_value}%")
                ->orWhere('email', 'LIKE', "%{$search_value}%")
                ->orWhere('phone', 'LIKE', "%{$search_value}%");
        }
        return $query;
    }
}
