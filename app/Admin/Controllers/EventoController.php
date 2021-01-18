<?php

namespace App\Admin\Controllers;

use App\Models\Evento;
use App\Models\EventoEstado;
use App\Models\Eventos;
use App\Http\Controllers\Controller;
use App\Models\Lugar;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EventoController extends Controller
{
    use HasResourceActions;

    private $title = "Eventos";

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
            ->description(trans('admin.detail'))
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
        $grid = new Grid(new Evento);

        $grid->id('ID');
        $grid->nombre('Nombre');
        $grid->lugar()->nombre('Lugar');
        $grid->max_cupos('Cupos')->display(function () {
            return "{$this->max_cupos} ({$this->max_cupos_reserva})";
        });
        $grid->column('fechahora_ini', 'Fecha Hora Rango')
            ->display(function () { return $this->fechahora_rango; });
        $grid->created_at(trans('admin.created_at'))
            ->display(function() { return $this->created_at->toDateTimeString(); });
        $grid->estado()->nombre('Estado');

        $grid->filter(function (Grid\Filter $filter) {
            $lugares = Lugar::orderBy('nombre')->pluck('nombre', 'id');
            $estados = EventoEstado::orderBy('nombre')->pluck('nombre', 'id');
            $filter->disableIdFilter();
            $filter->like('nombre', 'Nombre');
            $filter->in('lugar_id', 'Lugar')->multipleSelect($lugares);
            $filter->in('estado_id', 'Estado')->multipleSelect($estados);
            $filter->between('fechahora_ini', 'Inicio')->datetime();
            $filter->between('fechahora_fin', 'Fin')->datetime();
        });

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
        $show = new Show(Evento::findOrFail($id));

        $show->id('ID');
        $show->nombre('nombre');
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
        $form = new Form(new Evento);

        $lugares = Lugar::orderBy('nombre')->pluck('nombre', 'id');
        $form->text('nombre', 'Nombre')->rules('required');
        $form->textarea('descripcion', 'Descripción')->rules('nullable');
        $form->select('lugar_id', 'Lugares')->options($lugares)->rules('required');
        $form->datetimeRange('fechahora_ini', 'fechahora_fin', 'Inicio - Fin')->rules('required|date');
        $form->number('max_cupos', 'Cupos Maximos')->rules('required|gte:max_cupos_reserva');
        $form->number('max_cupos_reserva', 'Cupos Max. Reserva')->rules('required|lte:max_cupos');

        return $form;
    }
}
