<?php

namespace App\Livewire;

use App\Models\WorkOrder;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WorkOrders extends Component
{

    public $search = '';
    public $series = [];

    public function mount(): void
    {
        $this->series = $this->getSeries();
//        dd($this->series);
    }

    public function getSeries()
    {
        $user1 = WorkOrder::where('user_id', 1)->count();
        $user2 = WorkOrder::where('user_id', 2)->count();
        $user3 = WorkOrder::where('user_id', 3)->count();

        $user1_name = WorkOrder::where('user_id', 1)->first()->user->name;
        $user2_name = WorkOrder::where('user_id', 2)->first()->user->name;
        $user3_name = WorkOrder::where('user_id', 3)->first()->user->name;

        /*$this->series = [
            ['name' => $user1_name, 'data' => $user1],
            ['name' => $user2_name, 'data' => $user2],
            ['name' => $user3_name, 'data' => $user3],
        ];*/

        $total_orders = WorkOrder::count();

        $user1 = $user1 * 100 / $total_orders;
        $user2 = $user2 * 100 / $total_orders;
        $user3 = $user3 * 100 / $total_orders;

        return [
            $user1,
            $user2,
            $user3,
        ];

        /*return [
            ['name' => $user1_name, 'data' => $user1],
            ['name' => $user2_name, 'data' => $user2],
            ['name' => $user3_name, 'data' => $user3],
        ];*/
    }

//    #[Layout('components.layouts.app.sidebar')]
    public function render()
    {
        return view('livewire.work-orders', [
            'workOrders' => $this->getWorkOrders(),
        ]);
    }

    public function getWorkOrders()
    {
        return WorkOrder::orderBy('created_at', 'desc')
            ->when($this->search, fn ($query) => $query->where('client', 'like', '%' . $this->search . '%'))
            ->paginate(10);
    }
}
