<?php

namespace App\Admin\Controllers;

use App\Models\EventoEstado;
use App\Http\Controllers\Controller;
use App\Models\IdentificacionTipo;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class IdentificacionTipoController extends Controller
{
    use HasResourceActions;

    private $title = "Evento Estados";

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
        $grid = new Grid(new IdentificacionTipo);

        $grid->id('ID');
        $grid->nombre('Nombre');
        $grid->abreviatura('Abreviatura');
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

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
        $show = new Show(IdentificacionTipo::findOrFail($id));

        $show->id('ID');
        $show->nombre('Nombre');
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
        $form = new Form(new IdentificacionTipo);

        $form->display('ID');
        $form->text('nombre', 'Nombre')->rules('required|max:50');
        $form->text('abreviatura', 'Abreviatura')->rules('nullable');
        $form->display(trans('admin.created_at'));
        $form->display(trans('admin.updated_at'));

        return $form;
    }
}
