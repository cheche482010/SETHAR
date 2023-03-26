<div class="modal fade" id="modal_registro">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Registro de planta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <form action="" enctype="multipart/form-data">
                <div class='w-100 d-flex flex-column justify-content-around'>
                <div class='w-100 d-flex flex-row justify-content-around'>
                    <div>
                        <label for='nombre_comun'>Nombre comun</label>
                        <input class='form-control' id='nombre_comun' placeholder='Nombre comun de la planta'>
                    </div>  
                    <div>
                        <label for='nombre_cientifico'>Nombre cientifico</label>
                        <input class='form-control' id='nombre_cientifico' placeholder='Nombre cientifico de la planta'>
                    </div>
                    <div>
                    <label for='familia_cientifica'>Familia cientifica</label>
                        <input class='form-control' id='familia_cientifica' placeholder='Familia cientifica de la planta'>
                    </div>  
                </div>
                <div class='w-100 d-flex flex-row justify-content-around'>
                <div>
                        <label for='forma'>Forma</label>
                        <input class='form-control' id='forma' placeholder='Forma de la planta'>
                    </div>  
                    <div>
                        <label for='descripcion'>Descripcion de la planta</label>
                        <input class='form-control' id='descripcion' placeholder='Descripcion de la planta'>
                    </div>
                    <div>
                    <label for='tamanio'>Tamaño</label>
                        <input class='form-control' id='tamanio' placeholder='Tamaño de la planta'>
                    </div>  
                </div>
                <div class='w-100 d-flex flex-row justify-content-around'>
                <div>
                        <label for='textura'>Textura</label>
                        <input class='form-control' id='textura' placeholder='Textura de la planta'>
                    </div>  
                    <div>
                        <label for='color'>Color</label>
                        <input class='form-control' id='color' placeholder='Color de la planta'>
                    </div>
                    <div>
                    <label for='hojas'>Hojas</label>
                        <input class='form-control' id='hojas' placeholder='Como son las hojas de la planta'>
                    </div>  
                </div>
                <div class='w-100 d-flex flex-row justify-content-around'>
                <div>
                        <label for='tronco'>Tronco</label>
                        <input class='form-control' id='tronco' placeholder='Como es el tronco de la planta si posee'>
                    </div>  
                    <div>
                        <label for='flores'>Flores</label>
                        <input class='form-control' id='flores' placeholder='Como son las flores de la planta si posee'>
                    </div>
                    <div>
                    <label for='habitat'>Cual es el habitat de la planta</label>
                        <select id='habitat' class='form-control'>
                        <option value='1'>Bosque tropical</option>
                        <option value='2'>Pradera</option>
                        <option value='3'>Desierto</option>
                        <option value='4'>Barranco</option>
                        <option value='5'>Manglar</option>
                        <option value='6'>Arrecife</option>
                        </select>
                    </div>  
                </div>
                </div>
                </form>
            </div>
            <div class="modal-footer ">
            <button type="button" id='guardar' class="btn btn-info">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->