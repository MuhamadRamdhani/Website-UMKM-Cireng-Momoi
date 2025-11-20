<style>
    .footer_custom {
        background-color: rgb(255, 255, 255);
        border-top: 1px solid #ddd; /* Garis di atas */
        padding: 40px 0;
        font-family: Arial, sans-serif;
    }
    .footer_bottom {
        background-color: rgb(255, 254, 254);
        padding: 10px 0;
        color: #fff;
    }
    .footer_custom h5 {
        font-weight: bold;
    }
    .footer_custom a {
        display: block;
        color: #000;
        margin-bottom: 5px;
        text-decoration: none;
    }
    .footer_custom a:hover {
        text-decoration: underline;
    }
    .footer_logo img {
        max-width: 120px;
    }
</style>

<footer>
    <div class="footer_custom">
        <!-- Ganti 'container' dengan 'container-fluid px-0' agar full-width -->
        <div class="container-fluid px-0">
            <div class="row text-start">
                <!-- Logo dan tagline -->
                <div class="col-md-3 footer_logo">
                    <img src="" alt="">
                    <p class="mt-2"></p>
                </div>

                <!-- Cireng MoMoii -->
                <div class="col-md-3">
                    <h5>Cireng MoMoii</h5>
                    <a href="#">Tentang Kami</a>
                    <a href="#">Outlet</a>
                    <a href="#">Menu Cireng</a>
                </div>

                <!-- Help Center -->
                <div class="col-md-3">
                    <h5>Help Center</h5>
                    <a href="#">FAQ</a>
                    <a href="#">Syarat & Ketentuan</a>
                    <a href="#">Kebijakan Privasi</a>
                </div>

                <!-- Contact -->
                <div class="col-md-3">
                    <h5>Kontak Kami</h5>
                    <a href="tel:085761464821">0857-6146-4821</a>
                    <a href="mailto:info@cirengmomoi.com">info@cirengmomoi.com</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer_bottom text-center">
        <p>&copy; <script>document.write(new Date().getFullYear());</script> Cireng MoMoii. All rights reserved.</p>
    </div>
</footer>