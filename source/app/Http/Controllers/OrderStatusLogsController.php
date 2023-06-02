<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\OrderStatusLog;
use Illuminate\Http\Request;

class OrderStatusLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orderstatuslogs = OrderStatusLog::where('id', 'LIKE', "%$keyword%")
                ->orWhere('order_id', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->orWhere('updated_at', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $orderstatuslogs = OrderStatusLog::latest()->paginate($perPage);
        }

        return view('order-status-logs.index', compact('orderstatuslogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('order-status-logs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        OrderStatusLog::create($requestData);

        return redirect('order-status-logs')->with('flash_message', 'OrderStatusLog added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $orderstatuslog = OrderStatusLog::findOrFail($id);

        return view('order-status-logs.show', compact('orderstatuslog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $orderstatuslog = OrderStatusLog::findOrFail($id);

        return view('order-status-logs.edit', compact('orderstatuslog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $orderstatuslog = OrderStatusLog::findOrFail($id);
        $orderstatuslog->update($requestData);

        return redirect('order-status-logs')->with('flash_message', 'OrderStatusLog updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        OrderStatusLog::destroy($id);

        return redirect('order-status-logs')->with('flash_message', 'OrderStatusLog deleted!');
    }
}
