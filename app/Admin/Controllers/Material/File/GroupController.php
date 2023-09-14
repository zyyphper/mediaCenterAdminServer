<?php


namespace App\Admin\Controllers\Material\File;


use App\Libraries\Base\BaseAdminController;
use App\Models\Material\FileGroup;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Table;

class GroupController extends BaseAdminController
{
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
     * @return Grid
     * @throws \Exception
     */
    protected function table()
    {
        $table = new Table($this->model);
        $table->model()->latest();

        $table->disableExport();

        $table->column('id', '分组ID');
        if ($this->isRootPlatform()) {
            $table->platform()->name("平台");
        }
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
        $form->text("name","分组描述");
        $form->saving(function (Form $form) {
            if ($form->isCreating()) $form->model()->id = app("snowFlake")->id;
            $form->model()->platform_id = Admin::user()->platform_id;
        });
        return $form;
    }

}
