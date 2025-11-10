<!-- المودال -->
<div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4 p-6 relative">
        <h3 class="text-xl font-bold text-[#1B7A75] mb-4">إرشادات رفع ملف Excel</h3>

        <p class="text-sm text-gray-600 mb-3">
            تأكد أن ملف Excel يحتوي على الصف الأول كعناوين الأعمدة التالية:
        </p>

        <ul class="list-disc list-inside text-gray-700 text-sm mb-4 space-y-1">
            <li>client_name</li>
            <li>client_city</li>
            <li>client_national_id</li>
            <li>phone_number1</li>
            <li>phone_number2</li>
            <li>activity_type</li>
            <li>manager_name</li>
            <li>manager_id</li>
            <li>commercial_name</li>
            <li>commercial_record_number</li>
            <li>contract_number</li>
            <li>amount_requested</li>
            <li>amount_paid</li>
            <li>amount_remaining</li>
            <li>service_requested</li>
            <li>complaint_notes</li>
            <li>contract_attachments</li>
        </ul>

        <div class="bg-gray-50 border rounded-md p-3 text-xs text-gray-600 mb-4">
            <strong>مثال على صف في الملف:</strong><br>
            محمد يوسف | الخرطوم | 123456789 | 0912345678 | ... الخ
        </div>

        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeImportModal()"
                class="px-4 py-2 rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 text-sm">
                إلغاء
            </button>
            <button type="button" onclick="triggerFileUpload()"
                class="px-4 py-2 rounded-md text-white bg-[#1B7A75] hover:bg-[#16615C] text-sm">
                فهمت، متابعة الرفع
            </button>
        </div>
    </div>
</div>

<script>
    function openImportModal() {
        document.getElementById('importModal').classList.remove('hidden');
        document.getElementById('importModal').classList.add('flex');
    }

    function closeImportModal() {
        document.getElementById('importModal').classList.add('hidden');
        document.getElementById('importModal').classList.remove('flex');
    }

    function triggerFileUpload() {
        closeImportModal();
        document.getElementById('excelFile').click();
    }
</script>