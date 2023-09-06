<?php

namespace App\Models;

use App\Enums\RequestType;
use App\Models\Builders\RequestBuilder;
use App\Models\Scopes\RequestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

/**
 * Class Request
 * @package App\Models
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $answer
 * @property string $status
 * @property integer $user_id
 *
 * @property User $user
 */
class Request extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'title',
        'text',
        'answer',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function newEloquentBuilder($query): RequestBuilder
    {
        return new RequestBuilder($query);
    }
}
