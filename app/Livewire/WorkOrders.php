<?php

namespace App\Livewire;

use App\Models\Category;
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
    public $users = [];
    public $categories = [];

    public $workOrdersCategory = [];

    public function mount() : void
    {
        $this->series = $this->getSeries();
        $this->users = $this->getUsers();
        $this->categories = $this->getCategories();
        $this->getUsers();
        $this->workOrdersCategory = $this->getWorkOrdersByCategory();
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

    public function getUsersNames()
    {
        return User::pluck('name');
    }

    public function getCategories()
    {
        return Category::pluck('name');
    }

    public function getWorkOrders()
    {
        return WorkOrder::orderBy('created_at', 'desc')
            ->when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.work-orders', [
            'workOrders' => $this->getWorkOrders(),
        ]);
    }

    public function getWorkOrdersByCategory()
    {
        $array = [];

        foreach (Category::all() as $category) {
            $totalCategory = [];
            foreach (User::all() as $user) {
                $totalCategory[] = $user->workOrders()
                    ->when($this->month, fn($query) => $query->where('created_at', 'like', '%' . $this->month . '%'))
                    ->where('category_id', $category->id)
                    ->sum('total');
            }
            $array[] = [
                'name' => $category->name,
                'group' => 'workOrder',
                'data' => $totalCategory,
            ];
        }

        return $array;
    }

    public function updatedMonth()
    {
        $this->series = $this->getSeries();
        $this->series = $this->getSeries();
        $this->users = $this->getUsers();
        $this->categories = $this->getCategories();
        $this->getUsers();
        $this->workOrdersCategory = $this->getWorkOrdersByCategory();
    }
}
