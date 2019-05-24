<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

// 扩展 Form 的 select、textarea 组件
Encore\Admin\Form::extend('myselect', App\Admin\Extensions\MySelect::class);
Encore\Admin\Form::extend('mytextarea', App\Admin\Extensions\MyTextarea::class);

// 扩展 Grid 的 popover 组件
Encore\Admin\Grid\Column::extend('popover', App\Admin\Extensions\Popover::class);

// 自定义视图
app('view')->prependNamespace('admin', resource_path('views/admin/views'));
// 引入图表插件
//Admin::js('/js/chartjs/Chart.bundle.min.js');

