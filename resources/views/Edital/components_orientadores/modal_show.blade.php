<div class="modal " id="modal_show{{ $orientador->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Informações do Professor</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Nome </label>
                    <div class="textoinfomodal"> {{ $orientador->name }} </div>
                </div>

                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Edital</label>
                    <div class="textoinfomodal"> {{ $pivo->titulo }}</div>
                </div>

                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Data de início</label>
                    <div class="textoinfomodal"> {{ date('d/m/Y', strtotime($pivo->data_inicio)) }} </div>
                </div>

                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Data de fim</label>
                    <div class="textoinfomodal"> {{ date('d/m/Y', strtotime($pivo->data_fim)) }} </div>
                </div>



                </div>
                <div class="modal-footer border-0">
                </div>
            </div>
        </div>
    </div>
</div>
