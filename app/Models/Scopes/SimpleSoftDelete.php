<?php
namespace App\Models\Scopes;
use App\Models\Scopes\SimpleSoftDeleteScope;

trait SimpleSoftDelete
{
    protected static function bootSimpleSoftDelete()
    {
        static::addGlobalScope(new SimpleSoftDeleteScope);
    }

    public function restore()
    {
        $this->deleted_at = null;
        $this->save();
    }
}