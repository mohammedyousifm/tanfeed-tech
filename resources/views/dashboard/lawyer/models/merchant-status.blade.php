<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-strong w-full max-w-md mx-4 p-6 relative">
        <h3 class="text-xl font-bold text-[#CF9411] mb-4">تغيير حالة التاجر</h3>

        <form id="statusForm" method="POST" action="">
            @csrf
            @method('PATCH')

            <input type="hidden" name="merchant_id" id="merchantId" />

            <!-- Status Select -->
            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-semibold">اختر الحالة الجديدة</label>
                <select name="status" id="statusSelect"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                    <option value="active">تفعيل</option>
                    <option value="suspended">تعليق</option>
                    <option value="pending">قيد المراجعة</option>
                </select>
            </div>

            <!-- Modal Actions -->
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeStatusModal()" class="btn bg-[#CF9411] text-white f-12 hover-up">
                    إلغاء
                </button>
                <button type="submit" class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 hover-up">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>