<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\BannerListLayout;
use App\Models\Banner;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class BannerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Banners List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Banners';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Banners' => Banner::filters()->defaultSort('id')->paginate()
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
                ->route('platform.Banner.edit'),

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
            BannerListLayout::class
        ];
    }

    /**
     * @param Banner $Banner
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Banner $Banner)
    {
        $Banner->delete();

        Alert::info('You have successfully deleted the Banner.');

        return redirect()->route('platform.Banner.list');
    }
}
