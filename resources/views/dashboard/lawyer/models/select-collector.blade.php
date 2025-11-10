<!-- Modal لاختيار المحصلين -->
<div id="collectorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6 relative">
        <h3 class="font-bold  text-[#CF9411] mb-4">تعيين المحصلين</h3>
        <form id="collectorForm" method="POST" action="">
            @csrf
            @method('PATCH')

            <input type="hidden" name="complaint_id" id="collectorComplaintId">

            <div class="mb-4">
                <label class="block mb-2 font-semibold text-gray-700">اختر المحصلين</label>
                <select name="collector_id" id="collectorSelect"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                    @foreach (\App\Models\User::where('role', 'collector')->get() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeCollectorModal()"
                    class="btn f-12 bg-[#CF9411] text-white hover-up">إلغاء</button>
                <button type="submit" class="btn bg-[#1B7A75] hover:bg-[#16615C] text-white  f-12 hover-up">حفظ</button>
            </div>
        </form>
    </div>
</div>

<script>
    // فتح المودال
    function openCollectorModal(id) {
        document.getElementById('collectorModal').classList.remove('hidden');
        document.getElementById('collectorModal').classList.add('flex');
        document.getElementById('collectorComplaintId').value = id;
        document.getElementById('collectorForm').action = `/lawyer/complaints/${id}/collectors`;
    }

    // إغلاق المودال
    function closeCollectorModal() {
        document.getElementById('collectorModal').classList.add('hidden');
        document.getElementById('collectorModal').classList.remove('flex');
    }
</script>