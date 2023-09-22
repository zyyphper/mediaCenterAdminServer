<?php


namespace App\Models\Vip;


use App\Libraries\Base\BaseModel;
use Encore\OrgRbac\Models\Platform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VipPlatformEquity extends BaseModel
{
    protected $connection = "member";
    protected $table = "vip_platform_equity";

    protected $fillable = [
        'equity_id',
        'platform_id',
        'total_num',
        'total_unit',
    ];

    /**
     * @return BelongsTo
     */
    public function platform() : BelongsTo
    {
        return $this->belongsTo(Platform::class,'platform_id','id');
    }

    public function equity() : BelongsTo
    {
        return $this->belongsTo(VipEquity::class,'equity_id','id');
    }
}
