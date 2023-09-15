<?php


namespace App\Admin\Controllers\Material\File;


use App\Libraries\Base\BaseAdminController;
use App\Models\Material\FileGroup;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Table;
use Encore\OrgRbac\Traits\PlatformPermission;

class GroupController extends BaseAdminController
{
    use PlatformPermission;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '分组';

    protected $model;

    public function __construct(FileGroup $model)
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

        $table->disableExport();

        $table->column('id', '分组ID');
        $this->platformAuth($table);
        $table->column('name', '名称')->editable();

        $table->column('created_at', '创建时间');

        $table->actions(function ($actions) {
            $actions->disableView();
        });

        return $table;
    }

    public function form()
    {
        $form = new Form($this->model);
        $this->platformAuth($form);
        $form->text("name","分组描述");
        $form->saving(function (Form $form) {
            if ($form->isCreating()) $form->model()->id = app("snowFlake")->id;
        });
        return $form;
    }

}
