<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-strong w-full max-w-md mx-4 p-6 relative">
        <h3 class="text-xl font-bold text-[#CF9411] mb-4">تغيير حالة الطلب</h3>

        <form id="statusForm" method="POST" action="">
            @csrf
            @method('PATCH')

            <input type="hidden" name="complaint_id" id="complaintId">

            {{-- الحالة الحالية --}}
            <div id="currentStatusContainer" class="mb-3 hidden">
                <p class="text-sm text-gray-600">
                    <span class="font-semibold text-gray-800">الحالة الحالية:</span>
                    <span id="currentStatusLabel" class="text-[#1B7A75] font-medium"></span>
                </p>
            </div>

            {{-- 🔽 اختيار الحالة الجديدة --}}
            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-semibold">اختر الحالة الجديدة</label>
                <select name="status" id="statusSelect"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                    <option value="accepted">قبول</option>
                    <option value="suspended">تعليق</option>
                    <option value="pending">قيد المراجعة</option>
                    <option value="in_progress">قيد التنفيذ</option>
                    <option value="completed">مكتمل</option>
                    <option value="cancelled">ملغي</option>
                </select>
            </div>

            {{-- 🟡 سبب التعليق --}}
            <div id="suspendedReasonContainer" class="hidden mt-3">
                <label for="suspended_reason" class="block mb-1 text-gray-700 font-semibold">
                    سبب تعليق عقد العميل
                </label>
                <textarea name="suspended_reason" id="suspended_reason" rows="3"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green text-sm"
                    placeholder="اكتب سبب التعليق هنا..."></textarea>
            </div>

            {{-- 🔘 الأزرار --}}
            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeStatusModal()"
                    class="btn bg-[#CF9411] text-white f-12 hover-up">إلغاء</button>
                <button type="submit" class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 hover-up">حفظ</button>
            </div>
        </form>
    </div>
</div>