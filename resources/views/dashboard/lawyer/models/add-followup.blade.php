<div id="addFollowUpModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4 p-6 relative">
        <h3 class="text-xl font-bold text-[#CF9411] mb-4">إضافة متابعة جديدة</h3>

        <form action="{{ route('lawyer.followups.store') }}" method="POST">
            @csrf
            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">رقم الاتصال 📱</label>
                    <input type="text" name="call_number" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">وسيلة المتابعة</label>
                    <input type="text" name="method" class="w-full border-gray-300 rounded-md shadow-sm"
                        placeholder="اتصال هاتفي، زيارة ...">
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700">تاريخ الاتصال</label>
                    <input type="date" name="call_date" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">وقت الاتصال</label>
                    <input type="time" name="call_time" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700">اسم المتصل عليه</label>
                    <input type="text" name="called_person_name" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">صفته</label>
                    <input type="text" name="called_person_role" class="w-full border-gray-300 rounded-md shadow-sm"
                        placeholder="مثلاً: صاحب المنشأة، المحاسب...">
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">هل تم تحديد موعد سداد؟</label>
                    <select name="payment_commitment" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">اختر</option>
                        <option value="1">✅ نعم</option>
                        <option value="0">❎ لا</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">تاريخ الموعد</label>
                    <input type="date" name="payment_date" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <div class="mt-4">
                <label class="block mb-1 font-semibold text-gray-700">تعليق على المكالمة</label>
                <textarea name="note" rows="4" class="w-full border-gray-300 rounded-md shadow-sm"
                    placeholder="اكتب تفاصيل المكالمة..."></textarea>
            </div>

            <p class="mt-3 text-gray-600 text-sm">بواسطة: <strong>{{ Auth::user()->name }}</strong></p>

            <div class="flex justify-end gap-3 mt-5">
                <button type="button" id="closeModalBtn"
                    class="btn bg-[#CF9411] text-white f-12 hover-up">إلغاء</button>
                <button type="submit" class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 hover-up">حفظ
                    المتابعة</button>
            </div>
        </form>
    </div>
</div>