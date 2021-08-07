<?php

namespace App\Orchid\Layouts;

use App\Models\Doctor;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
// use App\Orchid\Layouts\component;

class DoctorListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'Doctors';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Doctor $Doctor) {
                    return Link::make($Doctor->name)
                        ->route('platform.Doctor.edit', $Doctor);
                }),
            TD::make('specialization', 'Specialization')
                ->filter(TD::FILTER_TEXT),
            TD::make('img', 'Picture')
                ->render(function (Doctor $Doctor) {
                    return view('imgs', $Doctor);
                }),
            TD::make('created_at', 'Created')
            ->sort()
            ->render(function (Doctor $Doctor) {
                return $Doctor->created_at->toDateTimeString();
            }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Doctor $Doctor) {
                    return $Doctor->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Doctor $Doctor) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.Doctor.edit', $Doctor)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the Doctor is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $Doctor->id,
                                ]),
                        ]);
                }),
        ];
    }
}
