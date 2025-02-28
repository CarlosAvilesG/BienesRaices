<?php

namespace App\Models; // ✅ Debe ser este
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
