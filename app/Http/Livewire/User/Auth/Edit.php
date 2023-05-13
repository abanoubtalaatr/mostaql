<?php

namespace App\Http\Livewire\User\Auth;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\City;
use App\Models\Country;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use function app;
use function view;

class Edit extends Component
{
    use ValidationTrait;
    use WithFileUploads;

    public $form = [];
    public $cities = [];
    public $skills = [];

    public function mount()
    {
        $this->form = auth()->user()->toArray();
        $this->cities = City::where('country_id', $this->form['country_id'])->get();
        $this->skills = Skill::all();

        $this->form['skills'] = auth()->user()->skills->pluck('id');
    }

    public function store()
    {
        $this->validate();

        $user = User::find(auth()->id());

        $user->skills()->sync($this->form['skills']);

        if ($this->form['avatar'] && !is_string($this->form['avatar'])) {
            $this->form['avatar'] = $this->form['avatar']->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->form['avatar']->extension(), 'public');
            $user->update(['avatar' => $this->form['avatar']]);
        }
        if ($this->form['minimized_picture'] && !is_string($this->form['minimized_picture'])) {
            $this->form['minimized_picture'] = $this->form['minimized_picture']->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->form['minimized_picture']->extension(), 'public');
            $user->update(['minimized_picture' => $this->form['minimized_picture']]);
        }

        $user->update([
            'user_type' => $this->form['user_type'],
            'email' => $this->form['email'],
            'first_name' => $this->form['first_name'],
            'last_name' => $this->form['last_name'],
            'mobile' => $this->form['mobile'],
            'city_id' => $this->form['city_id'],
            'country_id' => $this->form['country_id'],
            'address' => $this->form['address'],
            'job_title' => $this->form['job_title'],
            'description' => $this->form['description'],
        ]);
        session()->flash('success', 'تم تعديل ملفك الشخصي بنجاح.');

    }


    public function getRules()
    {

        return [
            'form.user_type' => ['required', Rule::in(['freelancer', 'owner', 'owner_freelancer'])],
            'form.email' => [
                'required',
                'max:200',
                'unique:users,email,' . auth()->id(),
            ],
            'form.first_name' => ['required', 'max:100'],
            'form.last_name' => ['required', 'max:100'],
            'form.mobile' => 'required|starts_with:5|integer|digits:9',
            'form.city_id' => ['required', 'exists:cities,id'],
            'form.country_id' => ['required', 'exists:countries,id'],
            'form.avatar' => ['nullable'],
            'form.skills' => ['sometimes', 'array'],
            'form.minimized_picture' => 'nullable',
            'form.address' => ['required', 'string'],
            'form.job_title' => ['required', 'string'],
            'form.description' => ['required', 'string', 'min:4']
        ];

    }

    public function getCities()
    {
        $this->cities = City::where('country_id', $this->form['country_id'])->get();
    }

    public function render()
    {
        $countries = Country::all();
        return view('livewire.user.edit', compact('countries'));
    }
}
