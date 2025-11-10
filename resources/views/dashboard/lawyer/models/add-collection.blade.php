<div id="addCollectionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-strong w-full max-w-lg mx-4 p-6 relative">
        <h3 class="text-xl font-bold text-[#CF9411] mb-4">إضافة تحصيل جديد</h3>

        <form action="{{ route('lawyer.collections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
            <input type="hidden" id="service_requested" value="{{ $complaint->service_requested }}">


            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-semibold">تاريخ التحصيل</label>
                <input type="date" name="collection_date" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-semibold">المبلغ</label>
                <input type="number" name="amount" required step="0.01"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green"
                    placeholder="اكتب المبلغ المحصل">
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-semibold">إيصال التحويل من العميل</label>
                <input type="file" name="collection_receipt"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-semibold">نسبة تنفيذ تك</label>
                <input type="number" step="0.01" name="tanfeed_fee" id="tanfeed_fee"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green"
                    placeholder="المبلغ المخصص لتنفيذ تك" readonly>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" id="closeCollectionModalBtn"
                    class="btn bg-[#CF9411] text-white f-12 hover-up">إلغاء</button>
                <button type="submit"
                    class="btn  prevent-double bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 hover-up">حفظ
                    التحصيل</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountInput = document.querySelector('input[name="amount"]');
        const tanfeedFeeInput = document.getElementById('tanfeed_fee');
        const serviceRequested = parseFloat(document.getElementById('service_requested').value) || 0;

        amountInput.addEventListener('input', function () {
            const amount = parseFloat(amountInput.value) || 0;
            const fee = (amount * serviceRequested) / 100;
            tanfeedFeeInput.value = fee.toFixed(0);
        });
    });
</script>