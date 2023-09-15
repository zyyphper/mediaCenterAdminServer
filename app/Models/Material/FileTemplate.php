<?php


namespace App\Models\Material;


use App\Libraries\Base\BaseModel;
use Encore\OrgRbac\Models\Platform;
use Encore\OrgRbac\Models\User;

class FileTemplate extends BaseModel
{

    protected $connection = "business";

    protected $fillable = [
        'id',
        'platform_id',
        'name',
        'file_type',
        'status',
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

    public function sources()
    {
        return $this->hasMany(FileSource::class,'origin_tpl_id');
    }


}
