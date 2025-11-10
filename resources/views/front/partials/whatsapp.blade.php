<!-- WhatsApp Floating Button -->
<section class="p-4">
    <a id="whatsapp-float" href="https://wa.me/966539392084" target="_blank" rel="noopener"
        aria-label="راسلنا على واتساب">
        <i class="fab fa-whatsapp"></i>
    </a>
</section>




<style>
    #whatsapp-float {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 9999;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 18px;
        color: #fff;
        letter-spacing: 0.3px;
        transition: all 0.25s ease;
    }

    #whatsapp-float i {
        font-size: 50px;
        animation: pulse 2s infinite;
        color: #20b85d;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }


    /* Hide text on mobile */
    /*@media (max-width: 480px) {*/
    /*    #whatsapp-float {*/
    /*        padding: 12px;*/
    /*        border-radius: 50%;*/
    /*        gap: 0;*/
    /*    }*/

    /*    #whatsapp-float .wa-text {*/
    /*        display: none;*/
    /*    }*/

    /*    #whatsapp-float i {*/
    /*        font-size: 24px;*/
    /*    }*/
    /*}*/
</style>