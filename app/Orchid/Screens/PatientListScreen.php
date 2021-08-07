<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\PatientListLayout;
use App\Models\Patient;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class PatientListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Patients List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Patients';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Patients' => Patient::filters()->defaultSort('id')->paginate()
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
                ->route('platform.Patient.edit'),

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
            PatientListLayout::class
        ];
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
