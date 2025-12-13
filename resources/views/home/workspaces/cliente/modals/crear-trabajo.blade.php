<div id="modal-crear-trabajo" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h2>Publicar Nuevo Trabajo</h2>
            <button onclick="closeModal('modal-crear-trabajo')" class="modal-close">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <form action="{{ route('trabajos.crear') }}" method="POST" class="modal-body">
            @csrf

            <div class="form-group">
                <label for="titulo">Título del Trabajo *</label>
                <input type="text" id="titulo" name="titulo" class="form-control" required maxlength="200"
                       placeholder="Ej: Desarrollador Laravel para proyecto ecommerce">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción *</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="5" required
                          placeholder="Describe el trabajo en detalle, requisitos, entregables, etc."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="categoria_id">Categoría *</label>
                    <select id="categoria_id" name="categoria_id" class="form-control" required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="modalidad">Modalidad *</label>
                    <select id="modalidad" name="modalidad" class="form-control" required>
                        <option value="remoto">Remoto</option>
                        <option value="presencial">Presencial</option>
                        <option value="hibrido">Híbrido</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tipo_presupuesto">Tipo de Presupuesto *</label>
                    <select id="tipo_presupuesto" name="tipo_presupuesto" class="form-control" required>
                        <option value="fijo">Precio Fijo</option>
                        <option value="por_hora">Por Hora</option>
                        <option value="rango">Rango de Precio</option>
                    </select>
                </div>

                <div class="form-group" id="presupuesto-fijo">
                    <label for="presupuesto_min">Presupuesto ($) *</label>
                    <input type="number" id="presupuesto_min" name="presupuesto_min" class="form-control"
                           min="0" step="0.01" placeholder="1000">
                </div>

                <div class="form-group" id="presupuesto-max" style="display:none;">
                    <label for="presupuesto_max">Presupuesto Máximo ($)</label>
                    <input type="number" id="presupuesto_max" name="presupuesto_max" class="form-control"
                           min="0" step="0.01" placeholder="5000">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="duracion_estimada">Duración Estimada (días)</label>
                    <input type="number" id="duracion_estimada" name="duracion_estimada" class="form-control"
                           min="1" placeholder="30">
                </div>

                <div class="form-group">
                    <label for="nivel_experiencia">Nivel de Experiencia</label>
                    <select id="nivel_experiencia" name="nivel_experiencia" class="form-control">
                        <option value="">Cualquier nivel</option>
                        <option value="principiante">Principiante</option>
                        <option value="intermedio">Intermedio</option>
                        <option value="avanzado">Avanzado</option>
                        <option value="experto">Experto</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="habilidades">Habilidades Requeridas</label>
                <select id="habilidades" name="habilidades[]" class="form-control" multiple size="6">
                    @foreach($habilidades as $habilidad)
                        <option value="{{ $habilidad->id }}">{{ $habilidad->nombre }}</option>
                    @endforeach
                </select>
                <small class="form-hint">Mantén presionado Ctrl (Cmd en Mac) para seleccionar múltiples</small>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modal-crear-trabajo')">
                    Cancelar
                </button>
                <button type="submit" class="btn-primary">
                    <i class="ri-send-plane-line"></i> Publicar Trabajo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Mostrar/ocultar campos de presupuesto según tipo
document.getElementById('tipo_presupuesto')?.addEventListener('change', function() {
    const presupuestoMax = document.getElementById('presupuesto-max');
    const labelMin = document.querySelector('label[for="presupuesto_min"]');

    if (this.value === 'rango') {
        presupuestoMax.style.display = 'block';
        labelMin.textContent = 'Presupuesto Mínimo ($) *';
    } else if (this.value === 'por_hora') {
        presupuestoMax.style.display = 'none';
        labelMin.textContent = 'Tarifa por Hora ($) *';
    } else {
        presupuestoMax.style.display = 'none';
        labelMin.textContent = 'Presupuesto ($) *';
    }
});
</script>
