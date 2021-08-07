<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\NewsListLayout;
use App\Models\News;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class NewsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'News List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All News';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'News' => News::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('plus')
                ->route('platform.News.edit'),

            Button::make('Export file')
                ->method('export')
                ->icon('cloud-download')
                ->rawClick()
                ->novalidate(),

            Button::make('Import file')
                ->method('export')
                ->icon('cloud-upload')
                ->rawClick()
                ->novalidate(),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            NewsListLayout::class
        ];
    }

    /**
     * @param News $News
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(News $News)
    {
        $News->delete();

        Alert::info('You have successfully deleted the News.');

        return redirect()->route('platform.News.list');
    }
}
