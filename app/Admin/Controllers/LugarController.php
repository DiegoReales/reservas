<?php

namespace App\Admin\Controllers;

use App\Models\EventoEstado;
use App\Http\Controllers\Controller;
use App\Models\Lugar;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class LugarController extends Controller
{
    use HasResourceActions;

    private $title = "Lugares";

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->title)
            ->description(trans('admin.list'))
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
            ->header($this->title)
            ->description(trans('admin.create'))
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
            ->header($this->title)
            ->description(trans('admin.edit'))
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
            ->header($this->title)
            ->description(trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lugar);

        $grid->id('ID');
        $grid->nombre('Nombre');
        $grid->direccion('Dirección');
        $grid->telefono('Teléfono');
        $grid->created_at(trans('admin.created_at'))->display(function() { return $this->created_at->toDateTimeString(); });
        $grid->updated_at(trans('admin.updated_at'))->display(function() { return $this->created_at->toDateTimeString(); });

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
        $show = new Show(Lugar::findOrFail($id));

        $show->id('ID');
        $show->nombre('Nombre');
        $show->direccion('Dirección');
        $show->telefono('Teléfono');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Lugar);

        $form->text('nombre', 'Nombre')->rules('required|max:100');
        $form->text('direccion', 'Dirección')->rules('required|max:100');
        $form->text('telefono', 'Teléfono')->rules('required|max:20');

        return $form;
    }
}
