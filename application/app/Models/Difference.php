<?php

namespace App\Models;

use App\Models\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Difference extends Model
{
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'base_repository_id', 'repository_id', 'status', 'ahead_by', 'behind_by',
    ];

    /**
     * A difference belongs to a base repository.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function baseRepository()
    {
        return $this->belongsTo(Repository::class, 'base_repository_id');
    }

    /**
     * A difference belongs to a repository.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repository()
    {
        return $this->belongsTo(Repository::class, 'repository_id');
    }
}
