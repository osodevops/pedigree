<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 'url', 'avatar_url',
    ];

    /**
     * An owner has many repositories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repositories()
    {
        return $this->hasMany(Repository::class);
    }
}
