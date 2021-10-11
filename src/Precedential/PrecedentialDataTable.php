<?php

/**
 * Precedential DataTable
 *
 * @package     Spiffy
 * @subpackage  DataTable
 * @category    Precedential
 * @author      Trioangle Product Team
 * @version     1.8
 * @link        http://trioangle.com
 */

namespace App\DataTables;

use App\Models\Precedential;
use Yajra\DataTables\Services\DataTable;

class PrecedentialDataTable extends DataTable
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
            ->of($query)
            ->addColumn('action', function ($precedential) {
                $edit = '<a href="'.url(ADMIN_URL.'/edit_precedential/'.$precedential->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                $delete = '<a data-href="'.url(ADMIN_URL.'/delete_precedential/'.$precedential->id).'" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>';

                return $edit.$delete;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Country $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Precedential $model)
    {
        return $model->all();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->addAction()
                    ->minifiedAjax()
                    ->dom('lBfr<"table-responsive"t>ip')
                    ->orderBy(0,'DESC')
                    ->buttons(
                        ['csv', 'excel', 'print', 'reset']
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
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            //insert Fileds
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'precedential_' . date('YmdHis');
    }
}
