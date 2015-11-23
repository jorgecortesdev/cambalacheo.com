<div class="modal fade" id="removeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Remover</h4>
            </div>
            {!! Form::open(['url' => 'panel/articles/update_status', 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('article_id', '') !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Por favor indicanos la razón por la cual deseas remover este artículo de nuestro sistema?</p>
                        <br>
                        <div class="form-group">
                            {!! Form::label('reasons', 'Razón', ['class' => 'col-xs-2 control-label']) !!}
                            <div class="col-xs-10">
                                {!! Form::select(
                                    'status',
                                    ['' => '-- Seleccionar --'] + $reasons,
                                    null,
                                    ['class' => 'form-control'])
                                !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
