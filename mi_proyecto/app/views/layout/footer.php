    <footer class="text-center py-4 mt-5">

        <p class="mb-1">
            &copy; <?php echo date("Y"); ?> PawFinder. Todos los derechos reservados.
        </p>

        <small>
            Plataforma web para la adopción responsable de mascotas.
        </small>    

    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DEBUG: mostrar tamaños de .pet-card-img en pantalla (temporal) -->
    <script>
        (function() {
            try {
                var imgs = Array.from(document.querySelectorAll('.page-wrapper .pet-card-img, .pet-card-img'));
                if (!imgs.length) return;
                var biggest = imgs[0];
                imgs.forEach(function(i) { if (i.getBoundingClientRect().width > biggest.getBoundingClientRect().width) biggest = i; });
                imgs.forEach(function(i){ i.style.outline = '2px dashed rgba(255,0,0,0.35)'; i.style.boxSizing = 'border-box'; });
                biggest.style.outline = '4px solid rgba(255,0,0,0.85)';

                var panel = document.createElement('div');
                panel.style.position = 'fixed';
                panel.style.right = '12px';
                panel.style.top = '12px';
                panel.style.zIndex = 99999;
                panel.style.background = 'rgba(0,0,0,0.75)';
                panel.style.color = '#fff';
                panel.style.padding = '8px 10px';
                panel.style.fontSize = '13px';
                panel.style.borderRadius = '6px';
                panel.style.maxWidth = '260px';
                panel.innerHTML = '<strong>Debug: .pet-card-img</strong><br>';
                imgs.forEach(function(i, idx){ var r = i.getBoundingClientRect(); panel.innerHTML += 'img['+idx+']: '+Math.round(r.width)+' x '+Math.round(r.height)+'<br>'; });
                panel.innerHTML += '<br><small>Este script es temporal. Dime el ancho mayor mostrado.</small>';
                document.body.appendChild(panel);
            } catch (e) {
                console.error('Debug script error', e);
            }
        })();
    </script>

</body>

</html>