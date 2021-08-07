<?php

namespace App\Orchid\Screens;

use App\Models\News;
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

class NewsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new News';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog News';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param News $News
     *
     * @return array
     */
    public function query(News $News): array
    {
        $this->exists = $News->exists;

        if ($this->exists) {
            $this->name = 'Edit News';
        }

        return [
            'News' => $News
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
            Button::make('Create News')
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
                Input::make('News.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this News.'),

                Cropper::make('News.img')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(500)
                    ->height(500)
                    ->targetRelativeUrl(),

                Quill::make('News.content')
                    ->title('Content')
                    ->rows(5)
                    ->maxlength(700),
            ])
        ];
    }

    /**
     * @param News    $News
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(News $News, Request $request)
    {
        $News->fill($request->get('News'))->save();

        Alert::info('You have successfully created an News.');

        return redirect()->route('platform.News.list');
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
