<?php

namespace App\Http\Controllers;

use app3s\util\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Division;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{

    public function applyFilters($query)
    {
        if (isset($_GET['setor'])) {
            $divisionId = intval($_GET['setor']);
            $query = $query->where('orders.division_id', $divisionId);
        }
        if (isset($_GET['demanda'])) {
            $query = $query->where('provider_user_id', auth()->user()->id);
        }
        if (isset($_GET['solicitacao'])) {
            $query = $query->where('customer_user_id', auth()->user()->id);
        }
        if (isset($_GET['tecnico'])) {
            $query = $query->where('provider_user_id', intval($_GET['tecnico']));
        }
        if (isset($_GET['requisitante'])) {
            $query = $query->where('customer_user_id', intval($_GET['requisitante']));
        }
        if (isset($_GET['data_abertura1'])) {
            $data1 = date("Y-m-d", strtotime($_GET['data_abertura1']));
            $query = $query->where('created_at', '>=', $data1);
        }
        if (isset($_GET['data_abertura2'])) {
            $data2 = date("Y-m-d", strtotime($_GET['data_abertura2']));
            $query = $query->where('created_at', '<=', $data2);
        }
        if (isset($_GET['campus'])) {
            $campusArr = explode(",", $_GET['campus']);
            $query = $query->whereIn('campus', $campusArr);
        }
        if (isset($_GET['setores_responsaveis'])) {
            $divisions = explode(",", $_GET['setores_responsaveis']);
            $query = $query->whereIn('orders.division_id', $divisions);
        }
        if (isset($_GET['setores_requisitantes'])) {
            $divisionsSig = explode(",", $_GET['setores_requisitantes']);
            $query = $query->whereIn('division_sig_id', $divisionsSig);
        }

        return $query;
    }

    public function isWeekend($data)
    {
        $week = intval(date('w', strtotime($data)));
        return ($week == 6 || $week == 0);
    }

    public function outOfHours($data)
    {
        $hora = intval(date('H', strtotime($data)));
        return ($hora >= 17 || $hora < 8 || $hora == 11);
    }
    public function getDatetimeBySla($dataAbertura, $tempoSla)
    {
        if ($dataAbertura == null) {
            return "Indefinido";
        }
        while ($this->isWeekend($dataAbertura)) {
            $dataAbertura = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($dataAbertura)));
        }
        while ($this->outOfHours($dataAbertura)) {
            $dataAbertura = date("Y-m-d H:00:00", strtotime('+1 hour', strtotime($dataAbertura)));
        }
        $timeEstimado = strtotime($dataAbertura);
        $tempoSla++;
        for ($i = 0; $i < $tempoSla; $i++) {
            $timeEstimado = strtotime('+' . $i . ' hour', strtotime($dataAbertura));
            $horaEstimada = date("Y-m-d H:i:s", $timeEstimado);
            while ($this->isWeekend($horaEstimada)) {
                $horaEstimada = date("Y-m-d 08:00:00", strtotime('+1 day', strtotime($horaEstimada)));
                $i = $i + 24;
                $tempoSla += 24;
            }

            while ($this->outOfHours($horaEstimada)) {
                $horaEstimada = date("Y-m-d H:i:s", strtotime('+1 hour', strtotime($horaEstimada)));
                $i++;
                $tempoSla++;
            }
        }
        $horaEstimada = date('Y-m-d H:i:s', $timeEstimado);
        return $horaEstimada;
    }

    public function isLate($order)
    {
        if ($order->sla < 1) {
            return false;
        }
        $horaEstimada = $this->getDatetimeBySla($order->created_at, $order->sla);
        $timeHoje = time();
        $timeSolucaoEstimada = strtotime($horaEstimada);
        return $timeHoje > $timeSolucaoEstimada;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $keyword = $request->get('search');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     $orders = Order::where('service_id', 'LIKE', "%$keyword%")
        //         ->orWhere('description', 'LIKE', "%$keyword%")
        //         ->orWhere('attachment', 'LIKE', "%$keyword%")
        //         ->orWhere('campus', 'LIKE', "%$keyword%")
        //         ->orWhere('division_id', 'LIKE', "%$keyword%")
        //         ->orWhere('service_id', 'LIKE', "%$keyword%")
        //         ->orWhere('client_user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('tag', 'LIKE', "%$keyword%")
        //         ->orWhere('phone_number', 'LIKE', "%$keyword%")
        //         ->orWhere('division', 'LIKE', "%$keyword%")
        //         ->orWhere('status', 'LIKE', "%$keyword%")
        //         ->orWhere('solution', 'LIKE', "%$keyword%")
        //         ->orWhere('rating', 'LIKE', "%$keyword%")
        //         ->orWhere('email', 'LIKE', "%$keyword%")
        //         ->orWhere('service_at', 'LIKE', "%$keyword%")
        //         ->orWhere('finished_at', 'LIKE', "%$keyword%")
        //         ->orWhere('confirmed_at', 'LIKE', "%$keyword%")
        //         ->orWhere('provider_user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('assigned_user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('place', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $orders = Order::latest()->paginate($perPage);
        // }

        $queryPendding = Order::with('service')
            ->whereIn(
                'status',
                [
                    'opened',
                    'pending it resource',
                    'pending customer response',
                    'in progress',
                    'reserved'
                ]
            )->orderByDesc('orders.id')->limit(300);

        $queryFinished = Order::with('service')
            ->whereIn(
                'status',
                [
                    'closed',
                    'committed',
                    'canceled'
                ]
            )
            ->orderByDesc('orders.id')->limit(300);
        $queryPendding = $this->applyFilters($queryPendding);
        $queryFinished = $this->applyFilters($queryFinished);
        if (request()->session()->get('role') == 'customer') {
            $queryPendding = $queryPendding->where('customer_user_id', auth()->user()->id);
            $queryFinished = $queryFinished->where('customer_user_id', auth()->user()->id);
        }

        $ordersPendding = $queryPendding->get();
        $ordersFinished = $queryFinished->get();
        $ordersLate = [];
        $ordersNotLate = [];
        $data = [];
        foreach ($ordersPendding as $order) {
            if (auth()->user() != 'customer' && $this->isLate($order)) {
                $ordersLate[] = $order;
            } else {
                $ordersNotLate[] = $order;
            }
        }



        $data['userDivision'] = Division::where('id', auth()->user()->division_id)->first();
        $data['providers'] = User::whereIn('role', ['administrator', 'provider'])->get();
        $data['allUsers'] = User::get();
        $data['divisionCustomers'] = Order::select('division_sig', 'division_sig_id')->distinct()->limit(100)->get();
        $data['divisions'] = Division::select('id', 'name')->get();
        $data['ordersFinished'] = $ordersFinished;
        $data['ordersLate'] = $ordersLate;
        $data['ordersNotLate'] = $ordersNotLate;

        return view('orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        $ordersNotCommited = Order::where('customer_user_id', auth()->user()->id)->where('status', 'closed')->get();
        $services = [];
        if (session()->get('role') == 'customer') {
            $filterServices = ['customer'];
        } else if (
            session()->get('role') == 'administrator' ||
            session()->get('role') == 'provider'
        ) {
            $filterServices = ['customer', 'provider'];
        }
        $services = Service::whereIn('role', $filterServices)->get();
        $data = [
            'ordersNotCommited' => $ordersNotCommited,
            'services' => $services
        ];

        return view('orders.create', $data);
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
        $allowedExtensions = [
            'image/jpeg', 'image/png', 'application/pdf',
            'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls',
            'xlt', 'xls', 'xml', 'xml', 'xlam', 'xla',
            'xlw', 'xlr', 'doc', 'docm', 'docx', 'docx',
            'dot', 'dotm', 'dotx', 'odt', 'pdf', 'rtf',
            'txt', 'wps', 'xml', 'zip', 'rar', 'ovpn',
            'xml', 'xps', 'jpg', 'gif', 'png', 'pdf',
            'jpeg'
        ];

        $request->validate([
            'description' => ['required', 'max:255'],
            'campus' => ['required', 'max:100'],
            'email' => ['required', 'max:100'],
            'service_id' => ['required', 'max:100'],
            'attachment' => ['nullable', 'mimetypes:' . implode(',', $allowedExtensions)],
            'tag' => ['nullable', 'max:12'],
            'phone_number' => ['nullable', 'max:12'],
            'place' => ['nullable', 'max:12'],
        ]);
        $fileName = "";
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            if (!Storage::exists('public/uploads')) {
                Storage::makeDirectory('public/uploads');
            }
            $fileName = $attachment->getClientOriginalName();
            if (Storage::exists('public/uploads/' . $attachment->getClientOriginalName())) {
                $fileName = uniqid() . '_' . $fileName;
            }
            $path = $attachment->storeAs('public/uploads/', $fileName);
            if (!$path) {
                return redirect()->back()->withErrors(['attachment' => 'Erro ao salvar o arquivo.']);
            }
        }

        $service = Service::find($request->service_id);
        DB::beginTransaction();
        try {
            $data =
                [
                    'division_id' =>  $service->division->id,
                    'service_id' => $service->id,
                    'division_sig_id' => auth()->user()->division_sig_id,
                    'division_sig' => auth()->user()->division_sig,
                    'customer_user_id' => auth()->user()->id,
                    'description' => $request->description,
                    'campus' => $request->campus,
                    'tag' => $request->tag,
                    'phone_number' => $request->phone_number,
                    'status' => 'opened',
                    'email' => $request->email,
                    'attachment' => $fileName,
                    'place' => $request->place
                ];
            $order = Order::create($data);
            DB::table('order_status_logs')->insert([
                'order_id' => $order->id,
                'status' => 'opened',
                'message' => "Ocorrência liberada para que qualquer técnico possa atender.",
                'user_id' => auth()->user()->id
            ]);

            DB::commit();


            $mail = new Mail();

            $assunto = "[3S] - Chamado Nº " . $order->id;
            $corpo =  '<p>Prezado(a) ' . auth()->user()->name . ' ,</p>';
            $corpo .= '<p>Sua solicitação foi realizada com sucesso, solicitação
			<a href="https://3s.unilab.edu.br/?page=ocorrencia&selecionar='
                . $order->id . '">Nº' . $order->id . '</a></p>';
            $corpo .= '<ul>
							<li>Serviço Solicitado: ' . $service->name . '</li>
							<li>Descrição do Problema: ' . $request->description . '</li>
							<li>Setor Responsável: ' . $service->division->name .
                ' - ' . $service->division->description . '</li>
					</ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';

            $mail->enviarEmail(auth()->user()->email, auth()->user()->nome, $assunto, $corpo);
            // echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=">';
            return redirect('?page=ocorrencia&selecionar=' . $order->id)->with('flash_message', 'Order added!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['flash_message' => 'Falha ao inserir dados.']);
        }
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
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
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
        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
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

        $order = Order::findOrFail($id);
        $order->update($requestData);

        return redirect('orders')->with('flash_message', 'Order updated!');
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
        Order::destroy($id);

        return redirect('orders')->with('flash_message', 'Order deleted!');
    }
}
