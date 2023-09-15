<?php


namespace App\Models\Vip;


use App\Libraries\Base\BaseModel;
use Encore\OrgRbac\Models\Platform;
use Encore\OrgRbac\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VipPlatformEquityLog extends BaseModel
{
    protected $connection = "member";

    protected $fillable = [
        'equity_id',
        'platform_id',
        'user_id',
        'num',
        'unit',
        'desc'
    ];

    /**
     * @return BelongsTo
     */
    public function platform() : BelongsTo
    {
        return $this->belongsTo(Platform::class,'platform_id','id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function equity() : BelongsTo
    {
        return $this->belongsTo(VipEquity::class,'equity_id','id');
    }
}
