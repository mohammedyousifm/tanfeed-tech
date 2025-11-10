<div id="phonestatusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-strong w-full max-w-md mx-4 p-6 relative">
        <h3 class="font-bold text-[#CF9411] mb-4">تغيير حالة الهاتف</h3>
        <form id="phonestatusForm" method="POST" action="">
            @csrf
            @method('PATCH')

            <input type="hidden" name="complaint_id" id="complaintId">

            <div class="mb-4">
                <label class="block mb-1 f-13 text-gray-700 font-semibold">اختر الحالة الجديدة</label>
                <select name="status" id="statusSelect"
                    class="w-full f-13 border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                    <option value="available">متاح</option>
                    <option value="not_available">غير متاح</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closephoneStatusModal()"
                    class="btn f-12 bg-[#CF9411] text-white hover-up">إلغاء</button>
                <button type="submit" class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white  f-12 hover-up">حفظ</button>
            </div>
        </form>
    </div>
</div>
<script>
    // فتح النافذة
    function openPhonestatusModal(id, currentStatus) {
        document.getElementById('phonestatusModal').classList.remove('hidden');
        document.getElementById('phonestatusModal').classList.add('flex');
        document.getElementById('complaintId').value = id;
        document.getElementById('statusSelect').value = currentStatus;
        document.getElementById('phonestatusForm').action = `/lawyer/phone-status/${id}/status`;

    }

    // إغلاق النافذة
    function closephoneStatusModal() {
        document.getElementById('phonestatusModal').classList.add('hidden');
        document.getElementById('phonestatusModal').classList.remove('flex');
    }
</script>