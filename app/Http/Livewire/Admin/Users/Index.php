<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $user_type, $status, $username, $email, $page_title, $first_name, $last_name, $mobile;
    protected $queryString = ['status', 'email', 'email', 'first_name', 'user_type', 'mobile'];
    public $showPopup = false;
    public $currentUser, $de_active_reason, $de_active_from, $de_active_to;


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


    public function togglePopup()
    {
        $this->showPopup = !$this->showPopup;
    }

    public function toggleStatus(User $user)
    {
        $this->showPopup = !$this->showPopup;
        $this->currentUser = $user;
    }

    public function updateUser()
    {
        $this->currentUser->update([
            'is_active' => !$this->currentUser->is_active,
            'de_active_reason' => $this->de_active_reason,
            'de_active_from' => $this->de_active_from,
            'de_active_to' => $this->de_active_to,
        ]);
        $this->de_active_reason = null;
        $this->de_active_to = null;
        $this->de_active_from = null;
        $this->showPopup = false;
    }

    public function activeUser(User $user)
    {
        $user->update([
            'is_active' => 1,
            'de_active_reason' => null,
            'de_active_from' => null,
            'de_active_to' => null,
        ]);
    }

    public function render()
    {
        $records = $this->getRecords();

        return view('livewire.admin.users.index', compact('records'))->layout('layouts.admin');
    }
}
