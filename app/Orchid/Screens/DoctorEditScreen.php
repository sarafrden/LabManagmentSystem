<?php

namespace App\Orchid\Screens;

use App\Models\Doctor;
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

class DoctorEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new Doctor';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog Doctors';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Doctor $Doctor
     *
     * @return array
     */
    public function query(Doctor $Doctor): array
    {
        $this->exists = $Doctor->exists;

        if ($this->exists) {
            $this->name = 'Edit Doctor';
        }

        return [
            'Doctor' => $Doctor
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
            Button::make('Create Doctor')
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
                Input::make('Doctor.name')
                    ->title('Name'),

                Input::make('Doctor.specialization')
                    ->title('Specialization'),

                Cropper::make('Doctor.img')
                    ->title('Large web banner image, generally in the front and center')
                    ->width(500)
                    ->height(500)
                    ->targetRelativeUrl(),


            ])
        ];
    }

    /**
     * @param Doctor    $Doctor
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Doctor $Doctor, Request $request)
    {
        $Doctor->fill($request->get('Doctor'))->save();

        Alert::info('You have successfully created an Doctor.');

        return redirect()->route('platform.Doctor.list');
    }

    /**
     * @param Doctor $Doctor
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Doctor $Doctor)
    {
        $Doctor->delete();

        Alert::info('You have successfully deleted the Doctor.');

        return redirect()->route('platform.Doctor.list');
    }
}
