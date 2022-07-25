<?php

namespace App\Http\Livewire\Public;

use App\Models\ContactUs;
use App\View\Components\HomeGuest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactUsPage extends Component
{
    public $countryKey = "966";

    public $contactUsModel = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'subject' => '',
        'message' => ''
    ];

    protected $rules = [
        'contactUsModel.name' => 'required|string|max:50',
        'contactUsModel.email' => 'required|email',
        'contactUsModel.phone' => 'nullable|numeric',
        'contactUsModel.subject' => 'required|string|max:50',
        'contactUsModel.message' => 'required|string|max:500',
    ];

    protected $validationAttributes = [
        'contactUsModel.name' => 'name',
        'contactUsModel.email' => 'email',
        'contactUsModel.phone' => 'phone',
        'contactUsModel.subject' => 'subject',
        'contactUsModel.message' => 'message',
    ];

    public function submit()
    {
        $this->validate();
        $this->contactUsModel['phone'] = $this->countryKey.$this->contactUsModel['phone'];
        ContactUs::create($this->contactUsModel);
        $this->reset('contactUsModel', 'countryKey');
        session()->flash(
            'contactusSent',
            ' تم الإرسال، سيتم الرد عليك عبر البريد الإلكتروني أو رقم الهاتف الذ وفرته لنا.'
        );
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.public.contact-us')->layout(HomeGuest::class);
    }
}
