@component('mail::message')
# تسجيل مستخدم جديد 🎉

تم تسجيل مستخدم جديد في المنصة.

**الاسم:** {{ $user->name }}
**البريد الإلكتروني:** {{ $user->email }}


@if(isset($user->created_at))
    **تاريخ التسجيل:** {{ $user->created_at->translatedFormat('l j F Y - h:i A') }}
@endif

@component('mail::button', ['url' => route('lawyer.merchant.show', $user->id)])
عرض المستخدم في لوحة الإدارة
@endcomponent

شكرًا لكم،
{{ config('app.name') }}
@endcomponent