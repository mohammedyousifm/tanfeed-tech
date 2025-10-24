@component('mail::message')
{{-- Title --}}
# اشعار بخصوص الطلب رقم: #{{ $complaint->serial_number }}

مرحبًا,

تم قبول طلبك من قبل المحامي وسوف يتم البدء في العمل

### 🔹تفاصيل الطلب

- **رقم الطلب:** #{{ $complaint->serial_number  }}
- **رقم العقد:** {{ $complaint->contract_number ?? '—' }}
- **الخدمة المطلوبة:** {{ $complaint->service_requested ?? '—' }}
- **المبلغ المطلوب:** {{ number_format($complaint->amount_requested ?? 0, 2) }} ريال
- **المبلغ المدفوع:** {{ number_format($complaint->amount_paid ?? 0, 2) }} ريال
- **المتبقي:** {{ number_format($complaint->amount_remaining ?? 0, 2) }} ريال


مع تحيات فريق **تنفيذ تك**.

@endcomponent