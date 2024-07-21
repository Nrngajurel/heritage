<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class EventTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),

            Footer::make()
                ->includeViewOnTop('components.datatable.footer-top'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Event::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')

            /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (Event $model) => strtolower(e($model->name)))

            ->addColumn('form_start_date_formatted', fn (Event $model) => Carbon::parse($model->form_start_date)->format('d M Y H:i:s'))
            ->addColumn('form_end_date_formatted', fn (Event $model) => Carbon::parse($model->form_end_date)->format('d M Y H:i:s'))
            ->addColumn('voting_start_date_formatted', fn (Event $model) => Carbon::parse($model->voting_start_date)->format('d M Y H:i:s'))
            ->addColumn('voting_end_date_formatted', fn (Event $model) => Carbon::parse($model->voting_end_date)->format('d M Y H:i:s'))
            ->addColumn('description')
            ->addColumn('created_at_formatted', fn (Event $model) => Carbon::parse($model->created_at)->format('d M Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Form Start date', 'form_start_date_formatted', 'form_start_date')
                ->sortable(),

            Column::make('Form End date', 'form_end_date_formatted', 'form_end_date')
                ->sortable(),
            Column::make('Voting Start date', 'voting_start_date_formatted', 'voting_start_date')
                ->sortable(),

            Column::make('Voting End date', 'voting_end_date_formatted', 'voting_end_date')
                ->sortable(),

            // Column::make('Description', 'description')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }
    #[\Livewire\Attributes\On('confirmDelete')]
    public function confirmDelete($rowId): void
    {
        $event = Event::find($rowId);

        if ($event) {
            $event->delete();
            $this->dispatch('pg:toast', ['type' => 'success', 'message' => 'Event deleted successfully']);
        }
    }

    public function actions(\App\Models\Event $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
