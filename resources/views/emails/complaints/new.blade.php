@component('mail::message')
{{-- Title --}}
# إشعار بطلب جديد من عميل

مرحبًا,

تم استلام **طلب جديد** من أحد العملاء عبر النظام.
فيما يلي تفاصيل الطلب:


### 🔹 معلومات التاجر
- **رقم التاجر:** {{ $complaint->user->client_number  }}
- **الاسم:** {{ $complaint->user->name }}
- **البريد الالكتروني:** {{ $complaint->user->email  }}



---

### 🔹 معلومات العميل
- **الاسم:** {{ $complaint->client_name }}
- **الرقم الوطني:** {{ $complaint->client_national_id ?? '—' }}
- **الاسم التجاري:** {{ $complaint->commercial_name ?? '—' }}
- **رقم السجل التجاري:** {{ $complaint->commercial_record_number ?? '—' }}

---

### 🔹 تفاصيل العقد
- **رقم العقد:** {{ $complaint->contract_number ?? '—' }}
- **الخدمة المطلوبة:** {{ $complaint->service_requested ?? '—' }}
- **المبلغ المطلوب:** {{ number_format($complaint->amount_requested ?? 0, 2) }} ريال
- **المبلغ المدفوع:** {{ number_format($complaint->amount_paid ?? 0, 2) }} ريال
- **المتبقي:** {{ number_format($complaint->amount_remaining ?? 0, 2) }} ريال

@if($complaint->contract_attachments)
    - **مرفق العقد:**
    [اضغط هنا لعرض المرفق]({{ asset('storage/' . $complaint->contract_attachments) }})
@endif

---


مع تحيات فريق **تنفيذ تك**.

@endcomponent