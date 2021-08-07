<?php

namespace App\Orchid\Layouts;

use App\Models\Banner;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
// use App\Orchid\Layouts\component;

class BannerListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'Banners';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            TD::make('img', 'Picture')
            ->render(function (Banner $Banner) {
                return view('imgs', $Banner);
            }),
            TD::make('created_at', 'Created')
            ->sort()
            ->render(function (Banner $Banner) {
                return $Banner->created_at->toDateTimeString();
            }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Banner $Banner) {
                    return $Banner->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Banner $Banner) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.Banner.edit', $Banner)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the Banner is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $Banner->id,
                                ]),
                        ]);
                }),
        ];
    }
}
