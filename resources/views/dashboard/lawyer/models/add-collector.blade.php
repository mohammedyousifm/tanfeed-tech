<!-- Modal لإضافة محصل جديد -->
<div id="addCollectorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6 relative">
        <h3 class="text-xl font-bold text-[#CF9411] mb-4">إضافة محصل جديد</h3>

        <form method="POST" action="{{ route('lawyer.collectors.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">اسم المحصل</label>
                <input type="text" name="name" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">كلمة المرور</label>
                <input type="password" name="password" required minlength="6"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeCollectorModal()"
                    class="btn bg-[#CF9411] text-white f-12 hover-up">إلغاء</button>
                <button type="submit" class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 hover-up">حفظ</button>
            </div>
        </form>
    </div>
</div>
