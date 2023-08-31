<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 */
class Request extends Model
{
    use HasFactory;

    public const PENDING_STATUS = 1;
    public const ANSWERED_STATUS = 2;

    protected $fillable = [
        'title',
        'text',
        'answer',
        'status',
        'user_id',
    ];

    public static function getStatuses(): array
    {
        return [
            self::PENDING_STATUS => 'Pending',
            self::ANSWERED_STATUS => 'Answered',
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
