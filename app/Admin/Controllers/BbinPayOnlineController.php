<?php

namespace App\Admin\Controllers;

use App\BbinPayOnline;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BbinPayOnlineController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('线上充值')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->description('充值记录')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description('充值记录')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新增')
            ->description('充值记录')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BbinPayOnline);

        $grid->id('编号');
        $grid->order_no('订单号');
        $grid->account('会员帐号');
        $grid->currency('会员币别');
        $grid->level('会员支付层级');
        $grid->time('时间');
        $grid->pay_way('支付方式');
        $grid->amount('收入金额');
        $grid->real_amount('实际存款金额');
        $grid->status('状态')->display(function ($status) {
            return $status ? '成功' : '未处理';
        });
        $grid->platform('支付平台');
        $grid->remark('金流');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');
        $grid->model()->orderBy('id', 'desc');

        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disableTools();
        $grid->disableExport();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BbinPayOnline::findOrFail($id));

        $show->id('Id');
        $show->bankname('银行名称');
        $show->bankcode('银行代码');
        $show->account('户名');
        $show->card_number('卡号');
        $show->branch('开户行');
        $show->count('收款次数');
        $show->money('收款总额');
        $show->status('状态');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BbinPayOnline);

        $form->text('bankname', '银行名称');
        $form->text('bankcode', '银行代码');
        $form->text('account', '户名');
        $form->text('card_number', '卡号');
        $form->text('branch', '开户行');
        $form->number('count', '收款次数');
        $form->decimal('money', '收款总额')->default(0.00);
        $form->switch('status', '状态');

        return $form;
    }
}
