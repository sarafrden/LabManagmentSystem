<?php

namespace App\Orchid\Screens;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class BannerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new Banner';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Blog Banners';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Banner $Banner
     *
     * @return array
     */
    public function query(Banner $Banner): array
    {
        $this->exists = $Banner->exists;

        if ($this->exists) {
            $this->name = 'Edit Banner';
        }

        return [
            'Banner' => $Banner
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
            Button::make('Create Banner')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Cropper::make('Banner.img')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(500)
                    ->height(500)
                    ->targetRelativeUrl(),
            ])
        ];
    }

    /**
     * @param Banner    $Banner
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Banner $Banner, Request $request)
    {
        $Banner->fill($request->get('Banner'))->save();

        Alert::info('You have successfully created an Banner.');

        return redirect()->route('platform.Banner.list');
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
