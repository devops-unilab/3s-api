<?php

namespace App\Policies;

use App\Enums\OrderStatus;
use Illuminate\Auth\Access\Response;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): Response
    {
        return Response::deny('Não é possível editar uma ocorrência');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): Response
    {
        return Response::deny('Não é possível apagar uma ocorrência');
    }

    public function open(User $user, Order $order): Response
    {
        if ($order->customer->id === $user->id && $order->status === 'closed') {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function cancel(User $user, Order $order): Response
    {
        if ($order->customer->id === $user->id && $order->status === 'opened') {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function editTag(User $user, Order $order): Response
    {
        if (
            ($order->customer->id === $user->id
                || $order->provider && $order->provider->id === $user->id)
            && $order->status === 'in progress'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function editSolution(User $user, Order $order): Response
    {
        if (
            ($order->provider && $order->provider->id === $user->id)
            && $order->status === 'in progress'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function editService(User $user, Order $order): Response
    {
        $role = request()->session()->get('role');
        if (
            ($order->provider && $order->provider->id === $user->id)
            && $order->status === 'in progress'
            && $role != 'cutomer'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }

    public function inProgress(User $user, Order $order): Response
    {

        if (
            ($order->provider && $order->provider->id === $user->id || $order->provider === null)
            &&
            ($order->status === OrderStatus::opened()->value
                || $order->status === OrderStatus::pendingCustomerResponse()->value
                || $order->status === OrderStatus::pendingItResource()->value)
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function close(User $user, Order $order): Response
    {
        if (
            $order->provider && $order->provider->id === $user->id
            && $order->status === 'in progress' && $order->solution != null
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function commit(User $user, Order $order): Response
    {
        if (
            $order->customer->id === $user->id && $order->status === 'closed'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function reserve(User $user, Order $order): Response
    {
        if (
            $order->provider && $order->provider->id === $user->id
            && $order->status === 'in progress'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function pendingCustomer(User $user, Order $order): Response
    {
        if (
            $order->provider && $order->provider->id === $user->id
            && $order->status === 'in progress'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function pendingResource(User $user, Order $order): Response
    {
        if (
            $order->provider && $order->provider->id === $user->id
            && $order->status === 'in progress'
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
    public function requestHelp(User $user, Order $order): Response
    {
        if (
            $order->customer->id === $user->id
            && $order->status === 'opened' && $order->isLate
            && !request()->session()->get('helpRequested')
        ) {
            return Response::allow();
        }
        return Response::deny('Esta ocorrência não pode ser cancelada.');
    }
}
