@component('mail::message')
# {{ __('Dear Admin') }}

## {{ __('New Request Submission details') }} 

- **{{__('Name')}}:** {{ $orderForm->name }}
- **{{__('Phone')}}:** {{ $orderForm->phone }}
- **{{__('Address')}}:** {{ $orderForm->address }}

**{{__('Message')}}:**
<p>
{{ $orderForm->message }}
</p>
@endcomponent
