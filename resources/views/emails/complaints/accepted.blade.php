@component('mail::message')
# تم قبول طلبك رقم {{ $complaint->serial_number }}

عزيزي {{ $complaint->user->name }},

يسعدنا إبلاغك بأن طلبك رقم **{{ $complaint->serial_number }}** قد تم **قبوله** بنجاح،
وسيبدأ فريقنا في متابعة الإجراءات القانونية الخاصة بك في أقرب وقت ممكن.

@component('mail::button', ['url' => route('complaints.show', $complaint->id)])
عرض الطلب
@endcomponent

> <span style="color:#CF9411;">تنفيذ تك</span> تساعدك في تحصيل فواتيرك المعدومة عبر نظام ذكي لإدارة القضايا القانونية
بكفاءة عالية واحترافية.

تحياتنا،
فريق <span style="color:#1B7A75;">تنفيذ تك</span>
@endcomponent