<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Repositories\BannerRepository;
use App\Core\Helpers\Utilities;
use App\Models\Banner;

class BannerController extends Controller
{
    private $BannerRepository;
    public function __construct()
    {
        $this->BannerRepository = new BannerRepository(new Banner());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'take' => 'integer',
            'skip' => 'integer',
        ]);
        if($request->has('where')) {
            $where = json_decode($request->where, true);
        } else {
            $where = null;
        }

        return $this->BannerRepository->index($request->take, $request->skip, $where);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'img' => 'mimes:jpeg,bmp,png,jpg,svg|required'
        ]);
        if ($request->hasFile('img'))
        $data['img'] = Utilities::upload($data['img'], 'Banners');

        return $this->BannerRepository->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->BannerRepository->show($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'img' => 'mimes:jpeg,bmp,png,jpg,svg',
        ]);
        if ($request->hasFile('img'))
        $data['img'] = Utilities::upload($data['img'], 'Banners');
        return $this->BannerRepository->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->BannerRepository->destroy($id);
    }

}
