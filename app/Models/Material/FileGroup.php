<?php


namespace App\Models\Material;


use App\Libraries\Base\BaseModel;
use Encore\OrgRbac\Models\Platform;

class FileGroup extends BaseModel
{

    protected $connection = "business";

    protected $fillable = [
        'platform_id',
        'name',
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function templates()
    {
        return $this->morphedByMany(FileTemplate::class,"groupable");
    }

    public function sources()
    {
        return $this->morphedByMany(FileSource::class,"groupable");
    }

}
