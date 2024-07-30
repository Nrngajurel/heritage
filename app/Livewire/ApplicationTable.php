<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ApplicationTable extends PowerGridComponent
{
    use WithExport;

    public string $sortField = 'applications.created_at';
    public string $sortDirection = 'desc';


    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            Header::make()->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Application::query()->join('competitions', 'competitions.id', '=', 'applications.competition_id')
            ->join('events', 'events.id', '=', 'applications.event_id')
            ->select('applications.*', 'competitions.name as competition_name', 'events.name as event_name');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('competition_id')
            ->add('competition_name')
            ->add('event_id')
            ->add('event_name')
            ->add('first_name')
            ->add('last_name')
            ->add('address')
            ->add('country')
            ->add('email')
            ->add('phone')
            ->add('meta')
            ->add('status')
            ->add('created_at')
            ->add('created_at_formatted', fn (Application $model) => Carbon::parse($model->created_at)->format('d M Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),
            Column::make('SN', 'id')
                ->index(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::make('Event', 'event_name'),
            Column::make('Competition', 'competition_name'),
            Column::make('First name', 'first_name')
                ->sortable()
                ->searchable(),

            Column::make('Last name', 'last_name')
                ->sortable()
                ->searchable(),

            Column::make('Country', 'country')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),


            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('status')
                ->dataSource(collect([
                    [
                        'id' => 'pending',
                        'label' => 'Pending',
                    ],
                    [
                        'id' => 'approved',
                        'label' => 'Approved',
                    ],
                    [
                        'id' => 'rejected',
                        'label' => 'Rejected',
                    ],
                ]))->optionLabel('label')->optionValue('id'),
        ];
    }



    public function actions(Application $row): array
    {
        return [
            Button::add('view')
                ->slot('View')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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
