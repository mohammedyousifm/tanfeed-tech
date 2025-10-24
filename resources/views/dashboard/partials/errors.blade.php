<!-- ✅ Global Success / Error Alerts -->
@if (session('success') || session('error'))
    <div class="fixed top-5 left-1/2 transform -translate-x-1/2 z-[999999] w-auto max-w-[90%]">
        @if (session('success'))
            <div style="background-color: #1d9942" id="success-alert"
                class="mb-2 bg-green-500 text-white font-medium px-6 py-3 rounded-xl shadow-lg animate-fade-in">
                <strong>✔ تم بنجاح:</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="error-alert" class="mb-2 bg-red-500 text-white font-medium px-6 py-3 rounded-xl shadow-lg animate-fade-in">
                <strong>❌ فشل:</strong> {{ session('error') }}
            </div>
        @endif
    </div>
@endif

<!-- ✅ Fade Animation -->
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }

    .animate-fade-out {
        animation: fadeOut 0.5s ease-in forwards;
    }
</style>

<!-- ✅ Auto-dismiss -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alerts = document.querySelectorAll('#success-alert, #error-alert');
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.classList.add('animate-fade-out');
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000); // auto-hide after 4s
    });
</script>