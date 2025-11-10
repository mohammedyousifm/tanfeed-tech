//  ===========================================
//      📎 Attachments Script (jQuery Version)
//      -------------------------------------------
//      - Allows user to dynamically add or remove
//        attachment input fields.
//      - Each attachment row includes:
//          • Attachment name input
//          • File upload input
//          • Remove button
//    ===========================================

    $(document).ready(function () {
        const $attachmentsContainer = $('#attachmentsContainer');
        const $addAttachmentBtn = $('#addAttachment');

        // ✅ Add new attachment row
        $addAttachmentBtn.on('click', function () {
            const newItem = `
                <div class="attachment-item flex items-center gap-4 bg-gray-50 p-4 rounded-md">
                    <div class="flex-1">
                        <label class="form-label f-12 text-sm font-semibold">اسم المرفق</label>
                        <input type="text" name="attachment_names[]" class="form-input f-11 w-full" placeholder="مثلاً: هوية العميل">
                    </div>
                    <div class="flex-1">
                        <label class="form-label f-12 text-sm font-semibold">اختر الملف</label>
                        <input type="file" name="attachment_files[]" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="form-input f-11 w-full">
                    </div>
                    <button type="button" class="remove-attachment text-red-500 hover:text-red-700 mt-6">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `;
            $attachmentsContainer.append(newItem);
        });

        // 🗑️ Remove an attachment row
        $attachmentsContainer.on('click', '.remove-attachment', function () {
            $(this).closest('.attachment-item').remove();
        });
    });

//      ===============================================================
//      🧾 jQuery Form Validation Script (for Complaint Form)
//      ---------------------------------------------------------------
//      ✅ Features:
//      - Validates National ID (Saudi format: starts with 1 or 2, 10 digits)
//      - Validates Phone numbers (start with 05, 10 digits)
//      - Shows/Hides Manager Section based on Activity Type
//      - Dynamically calculates Remaining Amount
//      - Prevents form submission if any field has validation errors
//    ===============================================================

//     $(document).ready(function () {

//         // 🧩 Select Elements
//         const $nationalIdInput = $('#client_national_id');
//         const $nationalError = $('#national-id-error');
//         const $activityType = $('#activity_type');
//         const $managerSection = $('#managerSection');
//         const $amountRequested = $('#amount_requested');
//         const $amountPaid = $('#amount_paid');
//         const $amountRemaining = $('#amount_remaining');
//         const $form = $('#complaintsubmiteForm');

//         const phoneInputs = [
//             { input: $('#phone_number1'), error: $('#phone1-error'), required: true },
//             { input: $('#phone_number2'), error: $('#phone2-error'), required: false }
//         ];

//         // 🧑‍💼 Show/Hide Manager Section based on Activity Type
//         $activityType.on('change', function () {
//             if ($(this).val() === 'شركة') {
//                 $managerSection.removeClass('hidden');
//             } else {
//                 $managerSection.addClass('hidden');
//             }
//         });

//         // 🪪 National ID Validation
//         $nationalIdInput.on('input', function () {
//             const value = $(this).val().trim();
//             let valid = true;

//             if (!/^\d*$/.test(value)) {
//                 $nationalError.text("❌ رقم الهوية يجب أن يحتوي على أرقام فقط.").removeClass('hidden');
//                 $(this).addClass('border-red-500');
//                 valid = false;
//             } else if (value.length > 0 && !/^(1|2)\d{9}$/.test(value)) {
//                 $nationalError.text("❌ رقم الهوية يجب أن يكون مكونًا من 10 أرقام ويبدأ بـ 1 أو 2 (هوية سعودية).").removeClass('hidden');
//                 $(this).addClass('border-red-500');
//                 valid = false;
//             } else {
//                 $nationalError.text("").addClass('hidden');
//                 $(this).removeClass('border-red-500');
//             }

//             return valid;
//         });

//         // 📱 Phone Number Validation
//         phoneInputs.forEach(({ input, error, required }) => {
//             input.on('input', function () {
//                 const value = $(this).val().trim();
//                 let valid = true;

//                 if (!/^\d*$/.test(value)) {
//                     error.text("❌ رقم الجوال يجب أن يحتوي على أرقام فقط.").removeClass('hidden');
//                     $(this).addClass('border-red-500');
//                     valid = false;
//                 } else if (value.length > 0 && !/^05\d{8}$/.test(value)) {
//                     error.text("❌ رقم الجوال يجب أن يبدأ بـ 05 ويكون مكونًا من 10 أرقام.").removeClass('hidden');
//                     $(this).addClass('border-red-500');
//                     valid = false;
//                 } else {
//                     error.text("").addClass('hidden');
//                     $(this).removeClass('border-red-500');
//                 }

//                 return valid;
//             });
//         });

//         // 💰 Calculate Remaining Amount
//         function calculateRemaining() {
//             const requested = parseFloat($amountRequested.val()) || 0;
//             const paid = parseFloat($amountPaid.val()) || 0;
//             $amountRemaining.val((requested - paid).toFixed(0));
//         }

//         $amountRequested.on('input', calculateRemaining);
//         $amountPaid.on('input', calculateRemaining);


//       // 🚫 Prevent form submission if any validation error
// // 🚫 Prevent form submission if any validation error
// $form.on('submit', function (e) {
//     let errorMessages = [];

//     // Trigger validation manually
//     $nationalIdInput.trigger('input');
//     phoneInputs.forEach(({ input }) => input.trigger('input'));

//     // 🧾 Collect only visible, non-empty errors
//     $('.text-red-500, .text-red-600').each(function () {
//         const msg = $(this).text().trim();
//         const isVisible = $(this).is(':visible');

//         if (isVisible && msg && msg.length > 2) {
//             errorMessages.push(msg);
//         }
//     });

//     // Also check for any invalid inputs with red borders and add readable field names
//     $('.border-red-500').each(function () {
//         const $label = $(this).closest('div').find('label').first();
//         const labelText = $label.text().trim().replace('*', '');
//         if (labelText && !errorMessages.includes(`⚠️ ${labelText} غير صالح`)) {
//             errorMessages.push(`⚠️ ${labelText} غير صالح`);
//         }
//     });

//     // 🚨 If errors exist
//     if (errorMessages.length > 0) {
//         e.preventDefault();

//         const errorList = errorMessages.map((msg, i) => `${i + 1}. ${msg}`).join('\n');
//         alert("⚠️ يرجى تصحيح الأخطاء التالية قبل إرسال النموذج:\n\n" + errorList);
//         return false;
//     }

//     return true;
// });


//     });


