<div id="modal-enviar-propuesta" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h2>Enviar Propuesta</h2>
            <button onclick="closeModal('modal-enviar-propuesta')" class="modal-close">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <form action="" method="POST" class="modal-body" id="form-enviar-propuesta">
            @csrf

            <div class="trabajo-info-box">
                <h4 id="modal-trabajo-titulo"></h4>
                <p class="muted" id="modal-trabajo-cliente"></p>
                <p class="presupuesto-info" id="modal-trabajo-presupuesto"></p>
            </div>

            <div class="form-group">
                <label for="carta_presentacion">Carta de Presentación *</label>
                <textarea id="carta_presentacion" name="carta_presentacion" class="form-control" rows="6" required
                          minlength="50" maxlength="1000"
                          placeholder="Explica por qué eres el candidato ideal para este proyecto. Incluye tu experiencia relevante, propuesta de valor y disponibilidad. Mínimo 50 caracteres."></textarea>
                <small class="form-hint" id="char-count">0 / 50 caracteres mínimo</small>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tipo_tarifa">Tipo de Tarifa *</label>
                    <select id="tipo_tarifa" name="tipo_tarifa" class="form-control" required>
                        <option value="fijo">Precio Fijo</option>
                        <option value="por_hora">Por Hora</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tarifa_propuesta" id="label-tarifa">Tu Tarifa ($) *</label>
                    <input type="number" id="tarifa_propuesta" name="tarifa_propuesta" class="form-control"
                           min="0" step="0.01" required placeholder="1500">
                </div>
            </div>

            <div class="form-group">
                <label for="tiempo_estimado">Tiempo Estimado (días)</label>
                <input type="number" id="tiempo_estimado" name="tiempo_estimado" class="form-control"
                       min="1" placeholder="30">
                <small class="form-hint">¿Cuántos días necesitas para completar el proyecto?</small>
            </div>

            <div class="alert-info">
                <i class="ri-information-line"></i>
                <p>Tu propuesta será enviada al cliente. Asegúrate de revisar todos los detalles antes de enviar.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modal-enviar-propuesta')">
                    Cancelar
                </button>
                <button type="submit" class="btn-primary">
                    <i class="ri-send-plane-line"></i> Enviar Propuesta
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Contador de caracteres
document.getElementById('carta_presentacion')?.addEventListener('input', function() {
    const count = this.value.length;
    const charCount = document.getElementById('char-count');
    charCount.textContent = `${count} / 50 caracteres mínimo`;

    if (count >= 50) {
        charCount.style.color = 'var(--success)';
    } else {
        charCount.style.color = 'var(--muted)';
    }
});

// Cambiar label según tipo de tarifa
document.getElementById('tipo_tarifa')?.addEventListener('change', function() {
    const label = document.getElementById('label-tarifa');
    if (this.value === 'por_hora') {
        label.textContent = 'Tarifa por Hora ($) *';
    } else {
        label.textContent = 'Tu Tarifa ($) *';
    }
});

// Función para abrir modal con datos del trabajo
function openPropuestaModal(trabajoId, titulo, cliente, presupuesto, presupuestoTipo) {
    // Actualizar información del trabajo
    document.getElementById('modal-trabajo-titulo').textContent = titulo;
    document.getElementById('modal-trabajo-cliente').textContent = 'Cliente: ' + cliente;
    document.getElementById('modal-trabajo-presupuesto').textContent = 'Presupuesto: $' + presupuesto + (presupuestoTipo === 'por_hora' ? '/hora' : '');

    // Actualizar action del form
    const form = document.getElementById('form-enviar-propuesta');
    form.action = `/workspace-freelancer/trabajos/${trabajoId}/propuesta`;

    // Resetear formulario
    form.reset();
    document.getElementById('char-count').textContent = '0 / 50 caracteres mínimo';
    document.getElementById('char-count').style.color = 'var(--muted)';

    // Abrir modal
    document.getElementById('modal-enviar-propuesta').classList.add('active');
}
</script>
