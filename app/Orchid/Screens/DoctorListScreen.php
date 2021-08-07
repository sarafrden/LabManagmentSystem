<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\DoctorListLayout;
use App\Models\Doctor;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class DoctorListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Doctors List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Doctors';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Doctors' => Doctor::filters()->defaultSort('id')->paginate()
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
                ->route('platform.Doctor.edit'),

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
            DoctorListLayout::class
        ];
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
