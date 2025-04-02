<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WorkOrders extends Component
{

    public $search = '';
    public $month = '';
    public $series = [];

    public function mount() : void
    {
        $this->series = $this->getSeries();
        $this->getUsers();
//        dd($this->getMonths());
        //        dd($this->series);
    }

    public function getUsers()
    {
        return User::pluck('id');
    }

    public function getSeries()
    {
        $user1 = WorkOrder::when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))
            ->where('user_id', 1)->count();
        $user2 = WorkOrder::when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))
            ->where('user_id', 2)->count();
        $user3 = WorkOrder::when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))
            ->where('user_id', 3)->count();

        $user1_name = WorkOrder::where('user_id', 1)->first()->user->name;
        $user2_name = WorkOrder::where('user_id', 2)->first()->user->name;
        $user3_name = WorkOrder::where('user_id', 3)->first()->user->name;

        /*$this->series = [
            ['name' => $user1_name, 'data' => $user1],
            ['name' => $user2_name, 'data' => $user2],
            ['name' => $user3_name, 'data' => $user3],
        ];*/

        $total_orders = WorkOrder::when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))->count();

        $user1 = $user1 !== 0 ? $user1 * 100 / $total_orders : $user1;
        $user2 = $user2 !== 0 ? $user2 * 100 / $total_orders : $user2;
        $user3 = $user3 !== 0 ? $user3 * 100 / $total_orders : $user3;

        return [
            $user1,
            $user2,
            $user3,
        ];
    }

    public function render()
    {
        return view('livewire.work-orders', [
            'workOrders' => $this->getWorkOrders(),
        ]);
    }

    public function getWorkOrders()
    {
        return WorkOrder::orderBy('created_at', 'desc')
            ->when($this->search, fn($query) => $query->where('client', 'like', '%' . $this->search . '%'))
            ->when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))
            ->paginate(10);
    }

    public function updatedMonth()
    {
        $this->series = $this->getSeries();
//        dd($this->series);
    }
}
