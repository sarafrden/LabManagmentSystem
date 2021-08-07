<?php

namespace App\Orchid\Layouts;

use App\Models\Patient;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
// use App\Orchid\Layouts\component;

class PatientListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'Patients';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Patient $Patient) {
                    return Link::make($Patient->name)
                        ->route('platform.Patient.edit', $Patient);
                }),

            TD::make('phone', 'Phone')
                ->filter(TD::FILTER_TEXT)
                ->render(function ($patient) {
                return ModalToggle::make($patient->phone)
                    ->modal('oneAsyncModal')
                    ->modalTitle('Phone')
                    ->method('saveUser')
                    ->asyncParameters([
                        'id' => $patient->id,
                    ]);
            }),
            TD::make('address', 'Address')
                ->filter(TD::FILTER_TEXT),
            TD::make('status', 'Status')
                ->render(function (Patient $Patient) {
                    return
                    view('status', $Patient);
                }),
            TD::make('created_at', 'Created')
            ->sort()
            ->render(function (Patient $Patient) {
                return $Patient->created_at->toDateTimeString();
            }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Patient $Patient) {
                    return $Patient->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Patient $Patient) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.Patient.edit', $Patient)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the Patient is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $Patient->id,
                                ]),
                        ]);
                }),
        ];
    }
}
