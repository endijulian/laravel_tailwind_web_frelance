<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\AdvantageService;
use App\Models\AdvantageUser;
use App\Models\Order;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\ThumbnailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services   = Service::orderBy('created_at', 'desc')->get();

        return view('pages.Landing.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public function explore()
    {
        $services   = Service::orderBy('created_at', 'desc')->get();

        return view('pages.Landing.explore', compact('services'));
    }

    public function detail($id)
    {
        $service            = Service::where('id', $id)->first();
        $thumbnail          = ThumbnailService::where('service_id', $id)->get();
        $advantage_service  = AdvantageService::where('service_id', $id)->get();
        $advantage_user     = AdvantageUser::where('service_id', $id)->get();
        $tagline            = Tagline::where('service_id', $id)->get();

        return view('pages.Landing.detail', compact(
            'service',
            'thumbnail',
            'advantage_service',
            'advantage_user',
            'tagline')
        );
    }

    public function boking($id)
    {
        $service    = Service::where('id', $id)->first();
        $user_buyer = Auth::user()->id;

        if($service->users_id == $user_buyer){
            toast()->warning('Sorry, members cannot book their own service');
            return back();
        }

        $order                  = new Order;
        $order->buyer_id        = $user_buyer;
        $order->frelancer_id    = $service->users_id    ;
        $order->service_id      = $service->id;
        $order->file            = null;
        $order->note            = null;
        $order->expired         = Date('y-m-d', strtotime('+3 days'));
        $order->order_status_id = 4;
        $order->save();

        $order_detail   = Order::where('id', $order->id)->first();

        return redirect()->route('detail.boking.landing', $order->id);
    }

    public function detail_boking($id)
    {
        $order  = Order::where('id', $id)->first();

        return view('pages.landing.boking');
    }
}
