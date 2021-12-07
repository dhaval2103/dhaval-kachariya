<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $id = $data->id;
                return '<button type="button" class="btn btn-secondary edituser" data-id="' . $data->id . '" data-toggle="modal" data-target="#usereditmodal" data-whatever="@mdo" ><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" id="deletedata" data-id="' . $data->id . '"><i class="fas fa-trash"></i></button>
                <button type="button" class="btn btn-info ids" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" data-id="' . $data->id . '"><i class="fas fa-plus"></i></button>
                <button type="button" class="btn btn-light view" data-id="' . $data->id . '" data-toggle="modal" data-target="#viewmodal" data-whatever="@mdo" ><i class="fas fa-eye"></i></button>
                <a href="' . route("admin.userblog", $id) . '"><b>Blog</b></a>';
            })
            ->editColumn('<input type="checkbox" class="check-input allselect"  name="allselect[]">', function ($data) {
                return '<input type="checkbox" class="check-input multicheck"  name="multicheck[]"  data-id="' . $data->id . '">';
            })
            ->editcolumn('Role', function ($data) {

                $user = User::find($data->id);
                return $user->roles->pluck('name');
            })
            ->rawColumns(['action', '<input type="checkbox" class="check-input allselect"  name="allselect[]">', 'Role'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('userdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bflrtip')
            ->orderBy(1)
            ->pageLength(5)
            ->lengthMenu([5, 10, 20, 30, 50])
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('<input type="checkbox" class="check-input allselect"  name="allselect[]">')->searchable(false)->orderable(false)
                ->width(50)
                ->addClass('text-center'),
            Column::make('no')->data('DT_RowIndex')->searchable(false)->orderable(false)
                ->width(50)
                ->addClass('text-center'),
            Column::make('name'),
            Column::make('email'),
            Column::make('Role'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
