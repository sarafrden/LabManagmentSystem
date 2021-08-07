<?php

namespace App\Orchid\Screens;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
// use App\Orchid\Screens\Select;

class PatientEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new Patient';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog Patients';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Patient $Patient
     *
     * @return array
     */
    public function query(Patient $Patient): array
    {
        $this->exists = $Patient->exists;

        if ($this->exists) {
            $this->name = 'Edit Patient';
        }

        return [
            'Patient' => $Patient
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
            Button::make('Create Patient')
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
                Input::make('Patient.name')
                    ->title('Name'),

                Input::make('Patient.phone')
                    ->title('Phone')
                    ->type('number'),

                Input::make('Patient.address')
                    ->title('Address')
                    ->type('text'),

                Select::make('Patient.status')
                    ->options([
                        'Pending'   => 'Pending',
                        'Hold' => 'Hold',
                        'Completed' => 'Completed',
                        ])
                    ->title('Select Status'),
            ])
        ];
    }

    /**
     * @param Patient    $Patient
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Patient $Patient, Request $request)
    {
        $Patient->fill($request->get('Patient'))->save();

        Alert::info('You have successfully created an Patient.');

        return redirect()->route('platform.Patient.list');
    }

    /**
     * @param Patient $Patient
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Patient $Patient)
    {
        $Patient->delete();

        Alert::info('You have successfully deleted the Patient.');

        return redirect()->route('platform.Patient.list');
    }
}
