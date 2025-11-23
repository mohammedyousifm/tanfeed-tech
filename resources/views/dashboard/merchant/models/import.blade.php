<!-- المودال -->
<div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4"
        style="display: flex; flex-direction: column; max-height: 90vh;">
        <!-- Header - Fixed -->
        <div class="p-6 border-b border-gray-200" style="flex-shrink: 0;">
            <h3 class="text-xl font-bold text-[#1B7A75]">إرشادات رفع ملف Excel</h3>
        </div>

        <!-- Scrollable Content -->
        <div class="p-6" style="flex: 1; overflow-y: auto;">
            <p class="text-sm text-gray-600 mb-3">
                تأكد أن ملف Excel يحتوي على الصف الأول كعناوين الأعمدة التالية:
            </p>
            <ul class="list-disc list-inside text-gray-700 text-sm mb-4 space-y-1">
                <li>اسم العميل</li>
                <li>مدينة العميل</li>
                <li>رقم هوية العميل</li>
                <li>رقم الهاتف 1</li>
                <li>رقم الهاتف 2</li>
                <li>نوع النشاط</li>
                <li>اسم المدير</li>
                <li>رقم المدير</li>
                <li>الاسم التجاري</li>
                <li>رقم السجل التجاري</li>
                <li>رقم العقد</li>
                <li>المبلغ المطلوب</li>
                <li>المبلغ المدفوع</li>
                <li>المبلغ المتبقي</li>
                <li>ملاحظات البلاغ</li>
            </ul>

            <div class="bg-gray-50 border rounded-md p-3 text-xs text-gray-600 mb-4">
                <strong>مثال على صف في الملف:</strong><br>
                عبدالله الدوسري | الرياض | 1023456789 | 0551234567 | 0569876543 | مقاولات عامة |
                فهد العتيبي | 1045678901 | مؤسسة الدوسري للمقاولات | 1010552233 | 2024/345 |
                75000 | 15000 | 6000 | لا يوجد
            </div>
        </div>

        <!-- Footer - Fixed -->
        <div class="border-t border-gray-200 p-6 flex justify-end gap-3" style="flex-shrink: 0;">
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