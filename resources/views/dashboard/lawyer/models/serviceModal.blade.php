<div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6">

        <h3 class="text-lg font-bold mb-4 text-[#1B7A75]">تعديل الخدمة المطلوبة</h3>

        <form id="serviceForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="service_requested" class="form-label">اختر الخدمة</label>
                <select id="service_requested" name="service_requested" class="form-input w-full px-3 py-2 rounded-md"
                    required>
                    <option value="">اختر الخدمة</option>
                    <option value="8%">تحصيل قبل المحكمة</option>
                    <option value="10%">تحصيل بسندات تنفيذ</option>
                    <option value="15%">إجراء قضائي أعلى من 500 ألف</option>
                    <option value="20%">إجراء قضائي أقل من 500 ألف</option>
                    <option value="25%">تحصيل الديون المتعثرة</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeServiceModal()"
                    class="btn f-12 bg-[#CF9411] text-white hover-up">إلغاء</button>

                <button type="submit"
                    class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white  f-12 hover-up">تحديث</button>
            </div>

        </form>
    </div>
</div>

<script>
    function openServiceModal(id) {
        const modal = document.getElementById('serviceModal');
        const form = document.getElementById('serviceForm');

        form.action = `/lawyer/complaints/${id}/update-service`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeServiceModal() {
        const modal = document.getElementById('serviceModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>