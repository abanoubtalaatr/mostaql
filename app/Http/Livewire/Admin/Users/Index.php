<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $user_type, $status, $username, $email, $page_title,$first_name,$last_name, $mobile;
    protected $queryString = ['status', 'email', 'email', 'first_name', 'user_type', 'mobile'];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->page_title = __('site.users');
    }

    public function getRecords()
    {
        return User::query()
            ->when(!empty($this->status), function ($query) {
                return $this->status == 'active' ? $query->whereIsActive(1) : $query->whereIsActive(0);
            })->when(!empty($this->user_type), function ($query) {
                return $query->whereUserType($this->user_type);
            })->when(!empty($this->username), function ($query) {
                return $query->where('first_name', 'LIKE', '%' . $this->first_name . '%');
            })->when(!empty($this->mobile), function ($query) {
                return $query->where('mobile', 'LIKE', '%' . $this->mobile . '%');
            })->when(!empty($this->email), function ($query) {
                return $query->where('email', 'LIKE', '%' . $this->email . '%');
            })->paginate();
    }

    public function getAllWithoutFilter()
    {
        return User::paginate();
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
    }

    public function render()
    {
        $records = $this->getRecords();

        return view('livewire.admin.users.index', compact('records'))->layout('layouts.admin');
    }
}
