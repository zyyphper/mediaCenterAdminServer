<?php

namespace App\Admin\Controllers\Material\File;


use App\Admin\Extensions\Tools\MaterialFileImportTool;
use App\Helpers\Tools;
use App\Libraries\Base\BaseAdminController;
use App\Models\Material\Enums\FileOriginType;
use App\Models\Material\Enums\FileType;
use App\Models\Material\FileSource;
use Encore\Admin\Table;

class SourceController extends BaseAdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文件资源';

    protected $model;

    public function __construct(FileSource $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    /**
     * 表格
     * @return Table
     * @throws \Exception
     */
    protected function table()
    {
        $table = new Table($this->model);
        $table->model()->latest();

        $table->tools(function ($tools) use ($table) {
            $tools->append(new MaterialFileImportTool());
        });
        $table->disableCreateButton();

        $table->column('id', '文件资源ID');
        if ($this->isRootPlatform()) {
            $table->platform()->name("平台");
        }
        $table->groups()->name("分组集合");
        $table->column('name', '文件名称')->editable();
        $table->column('type','文件类型')->using(FileType::$texts);
        $table->column('origin_type', '来源类型')->using(FileOriginType::$texts);

        $table->column('created_at', '创建时间');
        $table->operator()->name('操作员');

        $table->actions(function ($actions) {
            $actions->disableView();
        });

        return $table;
    }


    /**
     * 数据导入
     * @return mixed
     */
    public function import()
    {
        $data = Tools::checkRequest('import_data');
        $importData = json_decode($data['import_data'], JSON_UNESCAPED_UNICODE);
        $this->service->importData($importData);
        return $this->ajaxSuccess('导入成功');
    }

}
