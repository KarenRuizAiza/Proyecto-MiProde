<div id="loader-wrapper" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999; justify-content: center; align-items: center;">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="sr-only">Cargando...</span>
    </div>
</div>

<script>
    function showLoader() {
        document.getElementById('loader-wrapper').style.display = 'flex';
    }
</script>