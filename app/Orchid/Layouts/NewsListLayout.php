<?php

namespace App\Orchid\Layouts;

use App\Models\News;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
// use App\Orchid\Layouts\component;

class NewsListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'News';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Title')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (News $News) {
                    return Link::make($News->title)
                        ->route('platform.News.edit', $News);
                }),
            TD::make('img', 'Image')
                ->render(function (News $News) {
                    return view('imgs', $News);
                }),
            TD::make('content', 'Content')
                ->render(function (News $News) {
                    return
                        $News->content;
                }),
            TD::make('created_at', 'Created')
            ->sort()
            ->render(function (News $News) {
                return $News->created_at->toDateTimeString();
            }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (News $News) {
                    return $News->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (News $News) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.News.edit', $News)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the News is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $News->id,
                                ]),
                        ]);
                }),
        ];
    }
}
