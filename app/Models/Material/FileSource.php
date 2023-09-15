<?php


namespace App\Models\Material;


use App\Libraries\Base\BaseModel;
use Encore\OrgRbac\Models\Platform;
use App\Models\Admin\PlatformUser;
use Encore\OrgRbac\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileSource extends BaseModel
{
    use SoftDeletes;
    protected $connection = "business";

    protected $fillable = [
        'id',
        'platform_id',
        'name',
        'file_type',
        'origin_type',
        'origin_tpl_id',
        'operator',
        'original_url'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->morphMany(FileGroup::class,"groupable");
    }

    public function template()
    {
        return $this->belongsTo(FileTemplate::class,'origin_tpl_id');
    }

}
