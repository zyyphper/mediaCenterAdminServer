<?php

namespace App\Admin\Extensions\Tools;

use App\Models\Material\FileGroup;
use Encore\Admin\Actions\Action;
use Encore\Admin\Admin;
use Encore\OrgRbac\Traits\PlatformPermission;

class MaterialExportTool extends Action
{
    use PlatformPermission;

    public $name = '导出数据';
    protected $selector = '.export-post';

    public function getHandleRoute()
    {
        return 'source/examine';
    }

    public function form()
    {
        if (Admin::user()->isRootAdministrator()) {
            $this->select('platform_id', '平台')->options(function () {
                return PlatformModel::pluck('name', 'id');
            })->required();
        }
        $this->multipleSelect('group_id', '分组')->options(function () {
            return FileGroup::pluck('name', 'id');
        })->required();
        $this->date('start_time', '开始时间');
        $this->date('end_time', '结束时间');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post" style="margin-right: 10px"><i class="fa fa-upload"></i>导出数据</a>
HTML;
    }
}
