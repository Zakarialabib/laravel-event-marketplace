<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Models\OrderForms;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Mail\OrderFormMail;
use Illuminate\Support\Facades\Mail;

class OrderForm extends Component
{
    use LivewireAlert;

    public $name;

    public $phone;

    public $address;

    public $type;

    public $status;

    public $subject;

    public $message;

    public $item;

    protected $rules = [
        'name'    => 'required',
        'phone'   => 'required',
        'address' => 'required',
        'message' => 'nullable',
    ];

    public function mount($item, $type): void
    {
        $this->item = $item;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.front.order-form');
    }

    public function save(): void
    {
        $this->validate();

        $orderType = $this->type == 'race' ? OrderType::PRODUCT : OrderType::REGISTRATION;

        $order = OrderForms::create([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'type'    => $orderType,
            'status'  => OrderStatus::PENDING,
            'subject' => $this->name.__(' has sent a request for ').$this->item->name,
            'message' => $this->message,
        ]);

        $this->alert('success', __('Your order has been sent successfully!'));

        Mail::to(settings('company_email_address'))->send(new OrderFormMail($order));

        $this->reset(['name', 'phone', 'address', 'message']);
    }
}
